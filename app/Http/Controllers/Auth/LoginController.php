<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Session;
use DB;
use Lang;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->redirectTo = url()->previous();
        $this->middleware('guest')->except('logout');
        Session::put('auth_attempt', $request->auth_attempt);
    }

    public function showLoginForm()
    {
        if(!session()->has('url.intended'))
        {
            session(['url.intended' => url()->previous()]);
        }
        return view('auth.login');
    }

    protected function authenticated(Request $request)
    {
        Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember ? true : false);

        $userId = DB::table('users')
            ->select('id')
            ->where('email', $request->email)
            ->first();

        $userFavouritesCount = DB::table('apartament_favourites')
            ->select('id')
            ->where('user_id', '=', $userId->id)
            ->get();

        $userFavouritesCount = $userFavouritesCount->count();

        $userFavourites = DB::table('apartament_favourites')
            ->select('apartaments.id', 'apartament_descriptions.apartament_name', 'apartament_address', 'apartament_address_2', 'apartament_descriptions.apartament_link')
            ->distinct('apartaments.id')
            ->join('apartament_descriptions','apartament_favourites.apartament_id', '=', 'apartament_descriptions.apartament_id')
            ->join('apartaments','apartament_favourites.apartament_id', '=', 'apartaments.id')
            ->where('user_id', '=', $userId->id)
            ->orderBy('apartament_favourites.created_at', 'desc')
            ->limit(3)
            ->get();

        $userFavouritesAll = DB::table('apartament_favourites')
            ->select('apartaments.id', 'apartament_descriptions.apartament_name', 'apartament_address', 'apartament_address_2', 'apartament_descriptions.apartament_link')
            ->distinct('apartaments.id')
            ->join('apartament_descriptions','apartament_favourites.apartament_id', '=', 'apartament_descriptions.apartament_id')
            ->join('apartaments','apartament_favourites.apartament_id', '=', 'apartaments.id')
            ->where('user_id', '=', $userId->id)
            ->orderBy('apartament_favourites.created_at', 'desc')
            ->get();

        session(['userFavouritesCount' => $userFavouritesCount]);

        session(['userFavourites' => $userFavourites]);

        session(['userFavouritesAll' => $userFavouritesAll]);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/'.Lang::locale());
    }


    public function logViaFb(Request $request){

        //check if there is a user with this id
        $userdata = DB::table('users')
            ->where('facebook_id', $request->input("userID"))
            ->first();

        if($userdata != null){

            Auth::loginUsingId($userdata->id);

            $request = new \Illuminate\Http\Request();

            $request->replace(['email' => $userdata->email]);

            $this->authenticated($request);

            return response()->json(['response' => 'true']);

        }

        //nie ma takiego usera
        else{
            return response()->json(['response' => 'false']);
        }

    }
}

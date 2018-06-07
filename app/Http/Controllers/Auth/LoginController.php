<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Session;
use DB;

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
            ->select('apartaments.id', 'apartament_descriptions.apartament_name', 'apartament_address', 'apartament_address_2')
            ->distinct('apartaments.id')
            ->join('apartament_descriptions','apartament_favourites.apartament_id', '=', 'apartament_descriptions.apartament_id')
            ->join('apartaments','apartament_favourites.apartament_id', '=', 'apartaments.id')
            ->where('user_id', '=', $userId->id)
            ->orderBy('apartament_favourites.created_at', 'desc')
            ->limit(3)
            ->get();

        session(['userFavouritesCount' => $userFavouritesCount]);

        session(['userFavourites' => $userFavourites]);
    }
}

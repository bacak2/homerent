@extends ('includes.reservations')

@section('reservation.content')
<div class="container flex-box">
    <div id="Rtitle"><h4><b>2. {{ __('messages.your data') }}</b></h4></div>
    <div id="Rpath"><span class="active">{{ __('messages.offer') }} - {{ __('messages.your data') }}</span> - {{ __('messages.payment') }} - {{ __('messages.confirmation') }}</div>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-7 col-sm-12 pr-lg-5 form-full-width">
            {!! Form::open(array('url' => 'foo/bar')) !!}
            <div class="form-group row">
                {{ Form::label('title', __('messages.Title'), array('class' => 'col-sm-3 col-form-label')) }}
                <div class="col-sm-9">
                    {!! Form::select('title', array('M' => __('messages.Mr'), 'F' => __('messages.Mrs'))) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('address', __('messages.Name and surname'), array('class' => 'col-sm-3 col-form-label')) !!}
                <div class="col-sm-9">
                    {!! Form::text('address') !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('address', __('messages.Country'), array('class' => 'col-sm-3 col-form-label')) !!}
                <div class="col-sm-9">
                    {!! Form::select('address') !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('address', __('messages.Address'), array('class' => 'col-sm-3 col-form-label')) !!}
                <div class="col-sm-9">
                    {!! Form::text('address') !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('address', __('messages.Postcode'), array('class' => 'col-sm-3 col-form-label')) !!}
                <div class="col-sm-9">
                    {!! Form::text('address', '', array('class' => 'not-full-with')) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('address', __('messages.Place'), array('class' => 'col-sm-3 col-form-label')) !!}
                <div class="col-sm-9">
                    {!! Form::text('address') !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-1  offset-sm-3">
                    {!! Form::checkbox('name', 'value') !!}
                </div>
                {!! Form::label('name', __('messages.Place'), array('class' => 'col-sm-3')) !!}
            </div>
            <div class="form-group row">
                {!! Form::label('address', __('messages.Cellphone number'), array('class' => 'col-sm-3 col-form-label')) !!}
                <div class="col-sm-9">
                    {!! Form::text('address') !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('address', 'E-mail', array('class' => 'col-sm-3 col-form-label')) !!}
                <div class="col-sm-9">
                    {!! Form::text('address') !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('address', __('messages.Password'), array('class' => 'col-sm-3 col-form-label')) !!}
                <div class="col-sm-9">
                    {!! Form::password('address') !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('address', __('messages.Repeat password'), array('class' => 'col-sm-3 col-form-label')) !!}
                <div class="col-sm-9">
                    {!! Form::password('address') !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="col-lg-4 mobile-none mt-3">
            <div class="reservation-item p-3">
                <div class="row ">
                    <div class="col-4">
                        <div class="apartament " style="background-image: url('{{ asset("images/apartaments/$apartament->id/1.jpg") }}'); background-size: cover; margin-bottom: 0px; width: 100px; height: 60px;">
                        </div>
                    </div>
                    <div class="col-8">
                                <div class="txt-blue"><b>{{ $apartament->descriptions[0]->apartament_name}}</b></div>
                                <div class="mb-2">{{ $apartament->apartament_address }}</div>
                                <hr class="desktop-none">
                    </div>
                </div>
                <div class="mb-3 pb-3" style="border-bottom: dashed;">
                        <div class="row"><div class="col-4">{{ __('messages.arrival') }}:</div><div class="col-8"><b>sob, 26 kwiecień 2014 (po 15:00)</b></div></div>
                        <div class="row"><div class="col-4">{{ __('messages.departure') }}:</div><div class="col-8"><b>sob, 26 kwiecień 2014 (po 15:00)</b></div></div>
                        <div class="row"><div class="col-4">{{ ucfirst(__('messages.number of nights')) }}:</div><div class="col-8">2</div></div>
                        <div class="row"><div class="col-4">{{ __('messages.Number of') }} {{ __('messages.people')}}:</div><div class="col-8">2</div></div>
                        <div class="res-description txt-blue mt-3">
                            {{ __('messages.change') }}
                        </div>
                </div>
                <div>
                    <div class="row mb-3"><div class="col-7">{{ __('messages.Payment for stay') }}:</div><div class="col-5"><span class="pull-right">200,00 PLN</span></div></div>
                    <div class="row mb-3"><div class="col-7">{{ __('messages.Final cleaning') }}:</div><div class="col-5"><span class="pull-right">50,00 PLN</span></div></div>
                    <div class="row mb-3"><div class="col-7">{{ __('messages.Additional services') }}:</div><div class="col-5"><span class="pull-right">50,00 PLN</span></div></div>
                    <div class="row mb-3"><div class="col-7">{{ __('messages.Payment for service') }}:</div><div class="col-5"><span class="pull-right">50,00 PLN</span></div></div>
                    <div class="row mb-3"><div class="col-7"><b>{{ __('messages.fprice') }}</b></div><div class="col-5"><span class="pull-right"><b>50,00 PLN</b></span></div></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-gray">
    <div class="container py-3">
        <div class="row">
            <div class="col-lg-3 col-sm-12">
                <a href="{{ url()->previous() }}" class="pointer-back" style="background-image: url('{{ asset("images/reservations/btn-back.png") }}')">
                    <div  class="btn" >
                    {{ __('messages.Return') }}
                    </div>
                </a>
            </div>
            <div class="col-lg-3 offset-lg-6 col-sm-12">
                <a href="{{ url()->previous() }}" class="btn ml-2 pointer">{{ __('messages.next') }}</a>
            </div>
        </div>
    </div>
</div>

@endsection()
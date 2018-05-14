@extends('template.layout.layout')

@section('title')
    Configuration | booming
@endsection

@section('content')

    <!--inner heading start-->
    <div class="inner-heading">
        <div class="container">
            <h1>Paramètres de mon compte</h1>
        </div>
    </div>
    <!--inner heading end-->

    <!--pricing start-->
    <div class="inner-wrap pricingWrp">
        <div class="container">
            <div class="row">

                <div class="col-sm-3">
                    @include('template.user.partials.user_information')
                </div>
                <div class="col-sm-9">

                    @include('template.partials.flash')

                    {!! Form::open(['route' => 'user.account.setting.save']) !!}

                    <div class="row">
                        <div class="col-sm-12">

                            <div class="input-wrap">
                                {!! Form::text('name', $user->name, ['class' => 'form-control g-color-black g-brd-left-none g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-pl-0 g-pr-15 g-py-13', 'placeholder' => 'Nom']) !!}

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>


                        </div>
                        {{--<div class="col-sm-6">--}}

                            {{--<div class="input-wrap">--}}

                                {{--{!! Form::text('lastname', $user->lastname, ['class' => 'form-control g-color-black g-brd-left-none g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-pl-0 g-pr-15 g-py-13', 'placeholder' => 'Prénom(s)']) !!}--}}

                                {{--@if ($errors->has('lastname'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('lastname') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}


                        {{--</div>--}}

                        <div class="col-sm-6">

                            <div class="input-wrap">

                                {!! Form::email('email', $user->email, ['class' => 'form-control g-color-black g-brd-left-none g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-pl-0 g-pr-15 g-py-13', 'placeholder' => 'Adresse E-mail']) !!}

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>


                        </div>
                        <div class="col-sm-6">

                            <div class="input-wrap">

                                {!! Form::text('mobile', $user->mobile, ['class' => 'form-control g-color-black g-brd-left-none g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-pl-0 g-pr-15 g-py-13', 'placeholder' => 'Numéro téléphone']) !!}

                                @if ($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

                    </div>

                    {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary pull-right']) !!}
                    {!! Form::close() !!}

                    <div class="row">
                        <div class="col-sm-12">
                            <hr>
                            <a class="pull-right" href="{{ url('/password/reset') }}">Mot de passe oublié ? </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection


@section('js')
    <script>
        $(function(){
            $('body').removeClass('stop-scrolling');
        })
    </script>
@endsection
@extends('template.layout.layout')

@section('title')
    Connexion | booming
@endsection

@section('css')
    <style>
        .social-button{
            display: block;
            width: 100%;
            background-color: #435498;
            border-radius: 5px;
            padding: 10px;
            color: #fff;
            text-align: center;
        }
        .social-button:hover{
            color: #fff;
            text-decoration: none;
            background-color: #8C99C2;
        }
        .social-button .icon-social{
            display: inline-block;
            margin: 0 10px;
            font-size: 20px;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')



    <!--inner heading start-->
    <div class="inner-heading">
        <div class="container">
            <h1>Connectez-vous à votre compte</h1>
        </div>
    </div>
    <!--inner heading end-->

    <!--login start-->
    <div class="inner-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-1 col-md-4 col-sm-6">
                    <div class="login">
                        <div class="contctxt text-center">Connectez-vous sur Booming.africa</div>
                        <p class="text-center">
                            <strong>
                                Entrez en contact avec les meilleurs commerce près de chez vous.
                            </strong>
                        </p>

                        {{--<div>--}}
                            {{--<a class="button social-button" href="{{ route('facebook.login') }}">--}}

                                {{--<div class="icon-social">--}}
                                    {{--<i class="fa fa-facebook-square"></i>--}}
                                {{--</div>--}}

                                {{--<span class="text"><span class="text-normal">avec</span> <strong>Facebook</strong></span>--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    </div>
                </div>
                <div class="col-sm-6 col-md-6">
                    <div class="login">
                        @include('template.partials.flash')
                        <div class="contctxt">Connexion</div>
                        <div class="formint conForm">
                            {!! Form::open(['route' => 'login']) !!}
                                <div class="input-wrap">
                                    {!! Form::text('mobile', null, ['class' => 'form-control', 'placeholder' => 'Numéro de téléphone', 'autofocus']) !!}

                                    @if ($errors->has('mobile'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="input-wrap">
                                    {!! Form::password('password', ['class' => 'form-control g-color-black g-brd-left-none g-brd-white g-bg-transparent g-color-white g-placeholder-white g-pl-0 g-pr-15 g-py-13', 'placeholder' => 'Mot de Passe']) !!}

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="sub-btn">
                                    {!! Form::submit('Connexion', ['class' => 'sbutn']) !!}
                                </div>
                                <div class="newuser"><a href="{{ url('/password/reset') }}"> Mot de passe oublié? </a></div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-2"></div>
            </div>
        </div>
    </div>
    <!--login end-->

@endsection


@section('js')
    <script>
        $(function(){
            $('body').removeClass('stop-scrolling');
        })
    </script>
@endsection
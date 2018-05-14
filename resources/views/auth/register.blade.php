@extends('template.layout.layout')

@section('title')
    Créez un compte | booming
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
            <h1>Réjoingnez Booming.africa aujourd'hui</h1>
        </div>
    </div>
    <!--inner heading end-->

    <!--login start-->
    <div class="inner-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-1 col-md-4 col-sm-6">
                    <div class="login">
                        <div class="contctxt text-center">Inscrivez-vous sur Booming.africa</div>
                        <p class="text-center">
                            <strong>
                                Entrez en contact avec les meilleurs commerces près de chez vous
                            </strong>
                        </p>
                        <p class="text-center">
                            <small>
                                En vous inscrivant, vous acceptez les <a href="{{ route('route.page', 'condition-general-d-utilisation') }}" target="_blank">conditions d'utilisation</a> ainsi que la <a href="{{ route('route.page', 'politique-de-confidentialite') }}" target="_blank">politique de confidentialité</a> de Booming.africa.
                            </small>
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
                <div class="col-md-6 col-sm-6">
                    <div class="login">
                        <div class="contctxt">Ou Renseignez le formulaire d'inscription</div>
                        <div class="formint conForm">
                            {!! Form::open(['route' => 'register']) !!}
                                <div class="input-wrap">
                                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nom & Prénom(s)']) !!}

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="input-wrap">
                                    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Adresse E-mail']) !!}

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="input-wrap">
                                    <div class="alert alert-info">
                                        Le numéro mobile doit contenir l'indicatif de votre pays. ex: +225
                                    </div>
                                    {!! Form::text('mobile', null, ['class' => 'form-control', 'placeholder' => 'Numéro téléphone']) !!}

                                    @if ($errors->has('mobile'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="input-wrap">
                                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Mot de Passe']) !!}

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="input-wrap">
                                    {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirmation du Mot de Passe']) !!}
                                </div>
                                <div class="sub-btn">
                                    {!! Form::submit('Créer mon compte', ['class' => 'sbutn']) !!}
                                </div>
                                <div class="newuser"><i class="fa fa-user" aria-hidden="true"></i> Déjà un compte ? <a href="/login">Connectez-vous !</a></div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
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
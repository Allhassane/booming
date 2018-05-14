@extends('template.layout.layout')

@section('title')
    Réinitialisation du mot de passe | booming
@endsection

@section('content')

    <!--inner heading start-->
    <div class="inner-heading">
        <div class="container">
            <h1>Réinitialiser le mot de passe</h1>
        </div>
    </div>
    <!--inner heading end-->

    <!--login start-->
    <div class="inner-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-2"></div>
                <div class="col-md-6 col-sm-8">
                    <div class="login">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="formint conForm">
                            <form class="form-horizontal" method="POST" action="{{ route('password.mobile.request') }}">
                                {{ csrf_field() }}

                                <input type="hidden" name="token" value="{{ $data->token }}">

                                <div class="input-wrap">
                                    <label for="mobile" class="">Numéro de Télphone</label>

                                    <input id="mobile" type="text" class="form-control" name="mobile" value="{{ $data->mobile or old('mobile') }}" required autofocus>

                                    @if ($errors->has('mobile'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="input-wrap">
                                    <label for="password">Mot de passe</label>

                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="input-wrap">
                                    <label for="password-confirm">Confirmation du mot de passe</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="sub-btn">
                                    {!! Form::submit('Réinitialiser mon mot de passe', ['class' => 'sbutn']) !!}
                                </div>
                                <div class="newuser"><a href="/register"> Connexion </a></div>

                            </form>

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
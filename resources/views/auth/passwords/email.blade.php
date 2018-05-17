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
                            @include('template.partials.flash')
                            <form class="form-horizontal" method="POST" action="{{ route('password.mobile') }}">
                                {{ csrf_field() }}

                            <div class="input-wrap">
                                <label for="mobile" class="control-label">Entrez votre numéro de téléphone</label>

                                <br>
                                {{--<div class="alert alert-info">--}}
                                    {{--Le numéro mobile doit commencer par l'indicatif du pays--}}
                                {{--</div>--}}

                                <input id="mobile" type="text" class="form-control" name="mobile" value="{{ old('mobile') }}" placeholder="Numéro de téléphone" required autofocus>

                                @if ($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="sub-btn">
                                {!! Form::submit('Envoyer', ['class' => 'sbutn']) !!}
                            </div>
                            <div class="newuser"><a href="/register"> Créer un compte </a></div>

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
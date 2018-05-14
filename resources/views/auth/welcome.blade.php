@extends('template.layout.layout')

@section('title')
    Vérification du numéro de téléphone
@endsection

@section('content')

    {{--<section class="u-bg-overlay g-bg-pos-top-center g-bg-img-hero g-bg-black-opacity-0_3--after g-py-100" style="background-image: url(/assets/img/img24.jpg);">--}}
        {{--<div class="container u-bg-overlay__inner">--}}
            {{--<div class="row justify-content-center text-center mb-5">--}}
                {{--<div class="col-lg-8">--}}
                    {{--<!-- Heading -->--}}
                    {{--<h1 class="g-color-white text-uppercase mb-4">Bienvenue sur Booming.com</h1>--}}
                    {{--<div class="d-inline-block g-width-35 g-height-2 g-bg-white mb-4"></div>--}}
                    {{--<p class="lead g-color-white">Votre inscription a bien été prise en compte, nous vous avons transmit un mail de confirmation de compte.</p>--}}
                    {{--<p class="lead g-color-white">Vueillez confirmer votre compte et vous pourez faire vos annonce sur booming.com</p>--}}
                    {{--<!-- End Heading -->--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</section>--}}

    <!--inner heading start-->
    <div class="inner-heading">
        <div class="container">
            <h1>Vérification du numéro de téléphone</h1>
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
                        <div class="contctxt">Bienvenue sur booming.ci</div>
                        <div class="formint conForm">
                            <p>Bienvenue sur booming.ci. votre compte a été créer avec succès nous vous avons envoyé un message sur votre numéro avec un code. veuillez entrer le code pour confirmer votre numéro de téléphone.</p>
                            <div class="row">
                                <div class="col-sm-12">
                                    @include('template.partials.flash')
                                    <form action="{{ route('confirm.code') }}" method="POST">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <input type="hidden" name="id" value="{{ $data->id }}">
                                            <input type="hidden" name="code" value="{{ $data->token }}">
                                            <input type="text" class="form-control" name="code" placeholder="Saisir le code contenu dans le message">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary pull-right" value="Envoyer le code">
                                        </div>
                                    </form>
                                </div>
                                <div class="col-sm-12">
                                    <a href="">Non je n'ai rien réçu, renvoyer le code</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-2"></div>
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
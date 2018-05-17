<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- meta -->

    <title>@yield('title')</title>

    {{--<meta name="description" content="{!! $setting->about !!}">--}}
    {{--<link rel="canonical" href="{{ route('home') }}">--}}
    {{--<meta property="og:title" content="{{ $setting->site_title }}">--}}
    {{--<meta property="og:description" content="{!! $setting->about !!}">--}}
    {{--<meta property="og:url" content="{{ route('home') }}">--}}
    {{--<meta property="og:image" content="{{ asset('template/images/' . $setting->facebook_img) }}">--}}
    {{--<meta name="twitter:description" content="{!! $setting->about !!}">--}}
    {{--<meta name="twitter:title" content="{{ $setting->site_title }}">--}}
    {{--<meta name="twitter:image" content="{{ asset('template/images/' . $setting->facebook_img) }}">--}}

    <meta property="og:image:width" content="1050">
    <meta property="og:image:height" content="500">

    <!-- Fav Icon -->
    <link rel="shortcut icon" href="/storage/{{ setting('site.logo') }}">

    <!-- Bootstrap -->
    <link href="/template/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.4/flexslider.min.css" />

    <link href="/template/css/style.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:400,300italic,300,400italic,500italic,500,700,700italic' rel='stylesheet' type='text/css'>

    <style>
        .fa-star, .fa-star-o{
            color: #07ad07;
        }
        .help-block{
            display: block;
            color: red;
            font-size: 12px;
        }
        .verified-email{
            background-color: #A30014;
            color: #fff;
        }
    </style>

    @yield('css')

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="">

@if(!Auth::guest() AND Auth::user()->verified == 0)
<!--top bar start-->
<div class="topbar-wrap verified-email">
    <div class="container">
        <!-- row start -->
        <div class="row">
            <!-- col-md-4 start -->
            <div class="col-sm-8">
                <div class="user-wrap">
                    Un mail de confirmation vous à été envoyé, veuillez confirmer votre compte.
                </div>
            </div>
            <div class="col-sm-4">
                <div class="user-wrap">
                    Je n'ai toujours pas recu le mail, <a style="color: #fff; text-decoration: underline" href="">renvoyer</a>
                </div>
            </div>
        </div>
        <!-- row end -->
    </div>
</div>
<!--top bar start end-->
@endif

<!--top bar start-->
<div class="topbar-wrap">
    <div class="container">
        <!-- row start -->
        <div class="row">
            <!-- col-md-4 start -->
            <div class="col-sm-8">
                <div class="user-wrap">
                    @if(Auth::guest())
                        <div class="login-btn"><a href="/login">Connexion</a></div>
                        <div class="register-btn"><a href="/register">Créer un compte</a></div>
                        <div class="clearfix"></div>
                    @else
                        <div class="register-btn"><a href="{{ route('user.account.annonce') }}">{{ Auth::user()->name }}</a> &nbsp;&nbsp;&nbsp;
                            <a href="/logout">(<i class="fa fa-lock"></i> Déconnexion )</a>

                            @if(Auth::user()->role_id == 2)
                                <div style="display: inline-block;"> | <a href="{{ route('user.account.annonce.list') }}"> <i class="fa fa-list"></i> Mes annonces</a></div>
                            @endif


                            @if(Auth::user()->role_id == 1 OR Auth::user()->role_id == 4)
                                <div style="display: inline-block;"> | <a href="/admin" target="_blank"> <i class="fa fa-user-secret"></i> Administration</a></div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
            <!-- col-md-4 end -->

            <!-- col-md-4 start -->
            <div class="col-sm-4">
                <ul class="social-wrap">
                    <li><a href="{{ route('contacts') }}" style="font-size: 16px;color:#000;margin: 0 10px;">Contactez-Nous !</a></li>

                    {{--@if(!empty($setting->facebook))--}}
                    {{--<li><a href="{{ $setting->facebook }}" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>--}}
                    {{--@endif--}}

                    {{--@if(!empty($setting->twitter))--}}
                    {{--<li><a href="{{ $setting->twitter }}" target="_blank"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>--}}
                    {{--@endif--}}

                    {{--@if(!empty($setting->google))--}}
                    {{--<li><a href="{{ $setting->google }}" target="_blank"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a></li>--}}
                    {{--@endif--}}

                    {{--@if(!empty($setting->linkedin))--}}
                    {{--<li><a href="{{ $setting->linkedin }}" target="_blank"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>--}}
                    {{--@endif--}}
                </ul>
            </div>
            <!-- col-md-4 end -->
        </div>
        <!-- row end -->
    </div>
</div>
<!--top bar start end-->

{{--<div id="alert-layout-success">--}}
    {{--<i class="fa fa-check-circle"></i> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem nulla.--}}
{{--</div>--}}

<!--header start-->
<div class="header-wrap">
    <div class="container">
        <!--row start-->
        <div class="row">
            <!--col-md-3 start-->
            <div class="col-sm-2">
                <div class="logo"><a href="/"><img src="/storage/{{ setting('site.logo') }}" style="width: 130px; height: 55px;" alt="logo booming"></a></div>
            </div>
            <div class="col-sm-8">
                <div class="navigationwrape">
                    <div class="navbar navbar-default" role="navigation">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                        </div>
                        @php($sousmenus = \App\Category::where('id', '<>', 6)->where('id', '<>', 5)->where('id', '<>', 4)->where('id', '<>', 3)->where('id', '<>', 2)->where('id', '<>', 1)->where('statut', 1)->OrderBy('id', 'DESC')->get())
                        <div class="navbar-collapse collapse">
                            <ul class="nav navbar-nav">
                                <li> <a href="{{ route('home') }}"> Accueil</a></li>
                                <li> <a href="{{ route('annonce.hotel') }}"> Hôtels</a></li>
                                <li> <a href="{{ route('annonce.resto') }}"> Restaurants</a></li>
                                <li> <a href="{{ route('annonce.maquis') }}"> Maquis</a></li>
                                <li> <a href="{{ route('annonce.bar') }}"> Vie Nocturne</a></li>
                                <li> <a href="{{ route('annonce.service') }}"> Services</a></li>
                                <li>
                                    <a href="{{ route('annonce.categorie') }}">
                                        Autres @if(count($sousmenus) > 0) <i class="fa fa-caret-down"></i>@endif
                                    </a>
                                    @if(count($sousmenus) > 0)
                                        <ul class="dropdown-menu">
                                            @foreach($sousmenus as $sousmenu)
                                            <li> <a href="{{ route('annonce.by.category', ['key' => $sousmenu->id]) }}"> {{ $sousmenu->libelle }} </a></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <!--Navegation start-->
            </div>
            <!--col-md-3 end-->
            <!--col-md-2 start-->
            <div class="col-md-2 col-sm-3">
                <div class="post-btn"><a href="{{ route('user.account.annonce') }}">Poster une annonce</a></div>
            </div>
            <!--col-md-2 end-->
        </div>
        <!--row end-->
    </div>
</div>
<!--header start end-->

@yield('content')

<!--footer start-->
<div class="footer-wrap">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h3>A propos</h3>
                <div class="footer-logo"><img src="/storage/{{ setting('site.logo') }}" alt=""></div>

                {!! setting('site.about') !!}

            </div>
            <div class="col-sm-4">
                <h3>SIGNATURE</h3>

                <p style="color: #B1B1B1;">
                    <a href="/">www.booming.africa</a> est un projet de AiDev (Association Interafricaine des Développeur de Logiciels) : <a href="http://www.aidev.ci">www.aidev.ci</a><br>Parteniare technique Techologies du Sud (<a href="http://www.tds.ci">www.tds.ci</a>)<br>Tous droits reservés
                </p>

                <div class="clearfix"></div>
            </div>
            <div class="col-sm-4">
                <h3>CONTACTS</h3>
                <div class="address">{{ setting('site.location') }}</div>
                <div class="info"><i class="fa fa-phone" aria-hidden="true"></i> <a href="">{{ setting('site.mobile_one') }}</a></div>
                @if(!empty(setting('site.mobile_two')))
                <div class="info"><i class="fa fa-fax" aria-hidden="true"></i> <a href="">{{ setting('site.mobile_two') }}</a></div>
                @endif
                <div class="info"><i class="fa fa-enveloppe" aria-hidden="true"></i> <a href="">{{ setting('site.email') }}</a></div>
            </div>
        </div>
        <div class="copyright">Copyright © 2018 booming.ci - All Rights Reserved.</div>
    </div>
</div>

<!--footer end-->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="/template/js/jquery-2.1.4.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/template/js/bootstrap.min.js"></script>

<!-- general script file -->
<script type="text/javascript" src="/template/js/script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.4/jquery.flexslider.min.js"></script>
<!-- home js -->
<script src="/assets/js/home.js"></script>

<script src="http://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

@yield('js')
</body>
</html>
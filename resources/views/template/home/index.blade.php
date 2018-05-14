@extends('template.layout.layout')


@section('title')
    {{ setting('site.title') }}
@stop


@section('content')

    @include('template.partials.popup')

    <!--slider start-->
    <div class="slider-wrap" style="background:url(/storage/{{ setting('site.pub_form') }}) no-repeat top; background-size:cover; padding:20px 0;">
        <div class="container">
            <div class="sliderTxt">
                <h1>Que recherchez vous ?</h1>
                <p style="text-align: center;">Cherchez parmis les {{ count($number) }} annonces de booming</p>
                {!! Form::open(['route' => 'index.search', 'method' => 'GET']) !!}
                    <div class="row form-wrap">
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="text" name="q" placeholder="Saisisez quelque chose ..." class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-btn">
                                <input type="submit" class="sbutn" value="Cherche">
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!--slider end-->

    @if(count($firsts) > 0)
    <div class="feature-wrap" style="padding-bottom: 0;">
        <div class="container">
            <div class="heading-title">{{ setting('site.recommandation') }}</div>
            <ul class="row feature-service">
                @foreach($firsts as $item)
                    @include('template.partials.item')
                @endforeach
            </ul>
            {{--<div class="view-btn"><a href="index.html#">View All Feature ads</a></div>--}}
        </div>
    </div>
    @endif

    @if(count($seconds) > 0)
    <div class="feature-wrap" style="padding: 0 !important;">
        <div class="container">
            <ul class="row feature-service">
                @foreach($seconds as $item)
                    @include('template.partials.item')
                @endforeach
            </ul>
            {{--<div class="view-btn"><a href="index.html#">View All Feature ads</a></div>--}}
        </div>
    </div>
    @endif

    @if(count($recents) > 0)
        <div class="feature-wrap">
            <div class="container">
                <div class="heading-title">{{ setting('site.recent') }}</div>
                <ul class="row feature-service">
                    @foreach($recents as $item)
                        @include('template.partials.item')
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                @if(!empty(setting('site.pub_content')))
                    <img src="/storage/{{ setting('site.pub_content') }}" style="width: 100%; margin: 0 0 30px 0" alt="">
                @endif
            </div>
        </div>
    </div>


    <!--Categories start-->
    <div class="categories-wrap">
        <div class="container">
            <div class="heading-title"><span>Catégories</span></div>
            <ul class="row categories-service">

                @foreach($categories as $category)
                <li class="col-sm-3 col-xs-6">
                    <div class="categorybox">
                        <div class="icon"><img src="/storage/{{ $category->icon }}" alt=""></div>
                        <h4>
                            <a href="{{ route('annonce.by.category', ['key' => $category->id]) }}">
                                {{ $category->libelle }}
                                    <br>
                                {{ $category->number_annonce }}
                            </a>
                        </h4>
                    </div>
                </li>
                @endforeach
            </ul>
            <p class="text-right"><a href="{{ route('annonce.categorie') }}"> <i class="fa fa-angle-double-right"></i> Plus de catégories</a></p>
        </div>
    </div>
    <!--Categories end-->

    @if(count($vues) > 0)
        <!--feature start-->
        <div class="feature-wrap">
            <div class="container">
                <div class="heading-title">{{ setting('site.vues') }}</div>
                <ul class="row feature-service">
                    @foreach($vues as $item)
                        @include('template.partials.item')
                    @endforeach
                </ul>
            </div>
        </div>
        <!--feature end-->
    @endif

    @include('template.partials.how')

@endsection
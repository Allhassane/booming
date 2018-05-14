@extends('template.layout.layout')

@section('title')
    Liste des annonces | booming
@endsection

@section('content')

    <!--inner heading start-->
    <div class="inner-heading">
        <div class="container">
            <h1>Rechecher parmis plus de {{ count($annonces).' '.$name }} disponibles</h1>
        </div>
    </div>
    <!--inner heading end-->

    <!--listing start-->
    <div class="inner-wrap listing">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 hidden-xs">
                    <div class="leftSidebar">
                        <h3>Recherche avancée</h3>
                        <div class="sidebarpad">

                            {!! Form::open(['route' => 'annonce.search', 'method' => 'GET']) !!}
                                <h4>Que recherchez-vous ?</h4>
                                <div class="input-wrap">
                                    <input type="text" name="name" placeholder="Hôtel, Restaurant, Maquis ..." class="form-control">
                                </div>
                                <h4>Catégories</h4>
                                <div class="input-wrap">
                                    <select name="categorie_id" class="form-control">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->libelle }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <h4>Ville / Commune</h4>
                                <div class="input-wrap">
                                    <input type="text" name="city" placeholder="ex. yopougon" class="form-control">
                                </div>
                                <div class="sub-btn">
                                    <input type="submit" class="sbutn" value="Rechercher">
                                </div>
                            {!! Form::close() !!}

                            <br><br>

                            @if(!empty(setting('site.pub_side')))
                                <div class="ad"><img src="/storage/{{ setting('site.pub_side') }}" style="margin-bottom: 15px;" alt=""></div>
                            @endif

                        </div>

                    </div>
                </div>
                <div class="col-sm-8">
                    {{--<div class="sortbybar">--}}
                        {{--<div class="sortbar">--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-md-6 col-sm-6 col-xs-8">--}}
                                    {{--<div class="input-group"> <span class="input-group-addon" id="basic-addon3">Sort By</span>--}}
                                        {{--<select class="form-control">--}}
                                            {{--<option>Most recent</option>--}}
                                            {{--<option>Price: Rs Low to High</option>--}}
                                            {{--<option>Price: Rs High to Low</option>--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-6 col-sm-6 col-xs-4">--}}
                                    {{--<div class="listingBar">--}}
                                        {{--<div class="listIcon"><a href="listing.html"><i class="fa fa-list" aria-hidden="true"></i></a></div>--}}
                                        {{--<div class="clearfix"></div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    @if(count($annonces) > 0)
                    <ul class="listService">

                        @php($i=1)
                        @foreach($annonces as $annonce)
                        <li>
                            <div class="listWrpService">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="listImg">
                                            <a href="{{ route('annonce.detail', $annonce->slug) }}">
                                                <img src="/assets/img/annonces/{{ $annonce->vignette }}" alt="{{ $annonce->name }}">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-md-8 col-sm-8 col-xs-8">
                                                <h3><a href="{{ route('annonce.detail', $annonce->slug) }}">{{ $annonce->name }}</a></h3>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-4">
                                                <div class="dollar">{{ $annonce->categorie->libelle }}</div>
                                            </div>
                                        </div>
                                        <div class="location">
                                            <i class="fa fa-map-marker" aria-hidden="true"></i> {{ $annonce->city }} |
                                            {{ $annonce->vues }} vues |

                                            @if($annonce->note == 0)
                                                @include('template.pages.annonces.note.0')
                                            @elseif($annonce->note == 1)
                                                @include('template.pages.annonces.note.1')
                                            @elseif($annonce->note == 2)
                                                @include('template.pages.annonces.note.2')
                                            @elseif($annonce->note == 3)
                                                @include('template.pages.annonces.note.3')
                                            @elseif($annonce->note == 4)
                                                @include('template.pages.annonces.note.4')
                                            @else
                                                @include('template.pages.annonces.note.5')
                                            @endif

                                        </div>
                                        <p>{{ substr(strip_tags($annonce->description), 0,120) }} <i>[...]</i></p>
                                    </div>
                                </div>
                            </div>
                        </li>
                            @if($i == 3)
                                @if(!empty(setting('site.pub_content')))
                                    <img src="/storage/{{ setting('site.pub_content') }}" style="width: 100%; margin-bottom: 15px;" alt="">
                                @endif
                            @endif

                            @php($i++)
                        @endforeach
                    </ul>
                    @else
                        @include('template.partials.empty')
                    @endif
                    <div class="pagiWrap">
                        <div class="row">
                            <div class="col-sm-12 text-right">
                                {{ $annonces->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--listing end-->

@endsection


@section('js')
    <script>
        $(function(){
            $('body').removeClass('stop-scrolling');
        })
    </script>
@endsection
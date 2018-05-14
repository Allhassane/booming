@extends('template.layout.layout')

@section('title')
    Archives | booming
@endsection

@section('content')


    <!--inner heading start-->
    <div class="inner-heading">
        <div class="container">
            <h1>Mes annonces archivées</h1>
        </div>
    </div>
    <!--inner heading end-->

    <!--ad post start-->
    <div class="inner-wrap listing">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    @include('template.user.partials.user_information')
                </div>
                <div class="col-sm-9">

                    <div id="NotificationSection"></div>

                    @if(count($datas) > 0)
                        <ul class="listService">
                            @foreach($datas as $data)
                                <li>
                                    <div class="listWrpService">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-3">
                                                <div class="listImg">
                                                    <img src="/assets/img/annonces/{{ $data->vignette }}" alt="">
                                                </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col-sm-12 col-xs-12">
                                                        <h3><a href="listing.html#">{{ $data->name }}</a></h3>
                                                    </div>
                                                    {{--<div class="col-md-4 col-sm-4 col-xs-4">--}}
                                                    {{--<div class="dollar">$799.00</div>--}}
                                                    {{--</div>--}}
                                                </div>
                                                <div class="location">
                                                    <i class="fa fa-map-marker" aria-hidden="true"></i> {{ $data->city }}
                                                    @if($data->verified == 1)
                                                        <span class="label label-success">Annonce en ligne</span>
                                                    @else
                                                        <span class="label label-warning">En cours de traitement</span>
                                                    @endif
                                                    Catégorie : <a href="">{{ $data->categorie->libelle }}</a>,
                                                    Par : <a href="">{{ $data->user->lastname }}</a>
                                                </div>

                                                <p>{{ substr(strip_tags($data->description), 0,144) }}</p>
                                                <div class="view-btn">
{{--                                                    <a href="{{ route('user.account.annonce.edit', ['id' => $data->id]) }}" class="" title="Modifier cette annonce">Modifier</a>--}}
                                                    <a href="{{ route('user.account.annonce.enable', $data->id) }}" class="EnableAnnonce" title="Activer cette annonce">Activer</a>
                                                    <a href="{{ route('user.account.annonce.delete', $data->id) }}" onclick="return confirm('Cette action est irréversible, continuer ?');" title="Supprimer l'annonce">Supprimer</a>
{{--                                                    <a href="{{ route('user.account.annonce.pricing', $data->slug) }}" class="toolt" title="Sponsoriser mon annonce">Sponsoriser</a>--}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        @include('template.partials.empty')
                    @endif
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
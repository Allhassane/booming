@extends('template.layout.layout')

@section('title')
    Mes annonces | booming
@endsection

@section('content')


    <!--inner heading start-->
    <div class="inner-heading">
        <div class="container">
            <h1>{{ $title }}</h1>
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
                                                        <h3><a href="{{ route('annonce.detail', $data->slug) }}">{{ $data->name }}</a></h3>
                                                    </div>
                                                    {{--<div class="col-md-4 col-sm-4 col-xs-12">--}}
                                                        {{--<div class="dollar">$799.00</div>--}}
                                                    {{--</div>--}}
                                                </div>
                                                <div class="location">
                                                    <i class="fa fa-map-marker" aria-hidden="true"></i> {{ $data->city }},
                                                    Status :
                                                    @if($data->verified == 1)
                                                        <span class="label label-success">Annonce en ligne</span>
                                                    @else
                                                        <span class="label label-warning">En cours de traitement</span>
                                                    @endif
                                                    Catégorie : <a href="">{{ $data->categorie->libelle }}</a>,
                                                    Par : <a href="">{{ $data->user->lastname }}</a>
                                                </div>

                                                <p>{{ substr(strip_tags($data->description), 0,144) }}</p>
                                                <div class="">
                                                    <a href="{{ route('user.account.annonce.edit', ['id' => $data->id]) }}" class="btn btn-warning btn-sm" title="Modifier cette annonce"><i class="fa fa-edit"></i> Modifier</a>
                                                    @if($data->statut == 1)
                                                    <a href="{{ route('user.account.annonce.disable', $data->id) }}" class="DisableAnnonce btn btn-info btn-sm" title="Archiver cette annonce"><i class="fa fa-archive"></i> Archiver</a>
                                                    @else
                                                        <a href="{{ route('user.account.annonce.enable', $data->id) }}" class="EnableAnnonce btn btn-info btn-sm" title="Activer cette annonce"><i class="fa fa-check-circle-o"></i> Activer</a>
                                                    @endif
                                                    <a href="{{ route('user.account.annonce.delete', $data->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Cette action est irréversible, continuer ?');" title="Supprimer l'annonce"><i class="fa fa-trash-o"></i> Supprimer</a>
                                                    {{--@if($data->promoted == 0)--}}
                                                        {{--<a href="{{ route('user.account.annonce.payment.mode', $data->id) }}" class="toolt btn btn-success btn-sm" title="Booster mon annonce">Booster</a>--}}
                                                    {{--@else--}}
                                                        {{--<span class="label label-success">Annonce sponsorisée</span>--}}
                                                    {{--@endif--}}
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
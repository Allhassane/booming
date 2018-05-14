@extends('template.layout.layout')

@section('title')
    Catégories d'annonce | booming
@endsection

@section('content')

    <!--Categories start-->
    <div class="categories-wrap">
        <div class="container">
            <div class="heading-title"><span>Catégories</span></div>
            <h4 class="row categories-service">

                @foreach($datas as $data)
                <li class="col-sm-3 col-xs-6">
                    <div class="categorybox">
                        <div class="icon"><img src="/storage/{{ $data->icon }}" alt=""></div>
                        <h4>
                            <a href="{{ route('annonce.by.category', ['key' => $data->id]) }}">
                                {{ $data->libelle }}<br>{{ $data->number_annonce }}
                            </a>
                        </h4>
                    </div>
                </li>
                @endforeach
            </h4>
        </div>
    </div>
    <!--Categories end-->

    @include('template.partials.how')

@endsection


@section('js')
    <script>
        $(function(){
            $('body').removeClass('stop-scrolling');
        })
    </script>
@endsection
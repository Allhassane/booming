@extends('template.layout.layout')

@section('title')
    {{ $data->title }} | Booming.africa
@endsection

@section('content')


    <!--inner heading start-->
    <div class="inner-heading">
        <div class="container">
            <h1>{{ $data->title }}</h1>
        </div>
    </div>
    <!--inner heading end-->

    <!--about start-->
    <div class="inner-wrap about">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">

                    {!! $data->content !!}

                </div>

            </div>
            @include('template.partials.how')
        </div>
    </div>
    <!--about end-->

@endsection


@section('js')
    <script>
        $(function(){
            $('body').removeClass('stop-scrolling');
        })
    </script>
@endsection
@extends('template.layout.layout')

@section('content')


    <!--inner heading start-->
    <div class="inner-heading">
        <div class="container">
            <h1>Booster une annonce</h1>
        </div>
    </div>
    <!--inner heading end-->

    <!--pricing start-->
    <div class="inner-wrap pricingWrp">
        <div class="container">
            <ul class="row">

                <li class="col-sm-3"></li>
                <li class="col-sm-3">
                    <div class="price-box">
                        <h3>Basic</h3>
                        <div class="price-tbl">500 F.CFA <span>/ 3 jours</span></div>
                        <ul class="price-service">
                            <li>Réferencé 2ème ligne</li>
                        </ul>
                        <div class="view-btn"><a href="{{ route('user.account.annonce.payment.mode', $data->id) }}">Souscrire</a></div>
                    </div>
                </li>
                <li class="col-sm-3">
                    <div class="price-box">
                        <h3>Premium</h3>
                        <div class="price-tbl">1000 F.CFA <span>/ 3 jours</span></div>
                        <ul class="price-service">
                            <li>Réferencé 1ère ligne</li>
                        </ul>
                        <div class="view-btn"><a href="pricing.html#">Souscrire</a></div>
                    </div>
                </li>
            </ul>
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
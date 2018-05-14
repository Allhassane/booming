@extends('template.layout.layout')

@section('title')
    Mode de paiement | booming
@endsection

@section('content')


    <!--inner heading start-->
    <div class="inner-heading">
        <div class="container">
            <h1>Choississez votre moyen de paiement</h1>
        </div>
    </div>
    <!--inner heading end-->

    <!--pricing start-->
    <div class="inner-wrap pricingWrp">
        <div class="container">

            <div class="row">
                <div class="col-xs-12 text-center">
                    <h3 style="color: #22cb12;"> <i class="fa fa-lock"></i> Paiement sécurisé</h3>
                </div>
            </div>

            <br>
            <ul class="row">

                <li class="col-sm-2"></li>
                <li class="col-sm-4">
                    <div class="price-box">
                        <h3>Carte bancaire / varte visa</h3>
                        <br>
                        <a href="{{ route('user.account.annonce.payment.mode.visa', $annonce->id) }}">
                            <img src="/assets/img/visa.png" style="width: 400px; height: 175px;" alt="">
                        </a>
                    </div>
                </li>
                <li class="col-sm-4">
                    <div class="price-box">
                        <h3>Mobile Money</h3>
                        <br>
                        <img src="/assets/img/mobile_money.jpg" style="width: 400px; height: 175px;" alt="">
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
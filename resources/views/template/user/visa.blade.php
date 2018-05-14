@extends('template.layout.layout')

@section('content')

    <!--inner heading start-->
    <div class="inner-heading">
        <div class="container">
            <h1>Paiement par visa carte / carte bancaire</h1>
        </div>
    </div>
    <!--inner heading end-->

    <!--pricing start-->
    <div class="inner-wrap pricingWrp">
        <div class="container">
            <div class="row">

                <div class="col-sm-2"></div>
                <div class="col-sm-6">

                    {{--@include('template.partials.flash')--}}
                    {{--{!! Form::open(array('route' => 'payment_submit', 'class' => 'formulaire')) !!}--}}
                    {{--<script--}}
                            {{--src="https://checkout.stripe.com/checkout.js" class="stripe-button"--}}
                            {{--data-key="pk_test_KY7ciouLyU7GImqJyXEzogft"--}}
                            {{--data-name="BOOMING"--}}
                            {{--data-description="Paiement par carte sécurisé"--}}
                            {{--data-image="https://stripe.com/img/documentation/checkout/marketplace.png"--}}
                            {{--data-locale="auto"--}}
                            {{--data-zip-code="true"--}}
                            {{--data-currency="eur">--}}
                    {{--</script>--}}
                    {{--{!! Form::open() !!}--}}

                    @if ((Session::has('success-message')))
                        <div class="alert alert-success col-md-12">{{
					Session::get('success-message') }}</div>
                    @endif @if ((Session::has('fail-message')))
                        <div class="alert alert-danger col-md-12">{{
					Session::get('fail-message') }}</div>
                    @endif

                    <form accept-charset="UTF-8" action="{{ route('advert.payment', $annonce->id) }}" class="require-validation"
                          data-cc-on-file="false"
                          data-stripe-publishable-key="pk_test_KY7ciouLyU7GImqJyXEzogft"
                          id="payment-form" method="post">
                        {{ csrf_field() }}

                        <input type="hidden" name="id_advert" value="{{ $annonce->id }}">

                        <div class='form-row'>
                            <div class='col-xs-6 form-group'>
                                <input id="prix_one" type='radio' name="price" value="305" checked>
                                <label for="prix_one" class='control-label'>1er resultat 2000 F.CFA</label>
                            </div>
                            <div class='col-xs-6 form-group required'>
                                <input id="prix_two" type='radio' name="price" value="153">
                                <label class='control-label' for="prix_two">2ème resultat 1000 F.CFA</label>
                            </div>
                        </div>

                        <div class='form-row'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Nom de la carte</label>
                                <input class='form-control' size='4' type='text'>
                            </div>
                        </div>
                        <div class='form-row'>
                            <div class='col-xs-12 form-group card required'>
                                <label class='control-label'>Numéro de la carte</label> <input
                                        autocomplete='off' class='form-control card-number' size='20'
                                        type='text'>
                            </div>
                        </div>
                        <div class='form-row'>
                            <div class='col-xs-4 form-group cvc required'>
                                <label class='control-label'>CVC</label> <input
                                        autocomplete='off' class='form-control card-cvc'
                                        placeholder='ex. 311' size='4' type='text'>
                            </div>
                            <div class='col-xs-4 form-group expiration required'>
                                <label class='control-label'>Expiration (mois)</label>
                                <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                            </div>
                            <div class='col-xs-4 form-group expiration required'>
                                <label class='control-label'>Expiration (Année)</label>
                                <input class='form-control card-expiry-year' placeholder='AAAA' size='4' type='text'>
                            </div>
                        </div>
                        <div class='form-row'>
                            <div class='col-md-12 form-group'>
                                <button class='form-control btn btn-primary submit-button'
                                        type='submit' style="margin-top: 10px;">Effectuer le paiement »</button>
                            </div>
                        </div>
                        <div class='form-row'>
                            <div class='col-md-12 error form-group hide'>
                                <div class='alert-danger alert'>Impossible de trouver les informations de paiement.</div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-xs-3">
                    <img src="/assets/img/paiement.png" alt="">
                </div>

            </div>
        </div>
    </div>

@endsection

@section('js')
    {{--<script src="https://js.stripe.com/v3/"></script>--}}
    <script src='https://js.stripe.com/v2/' type='text/javascript'></script>

    {{--<script src="https://code.jquery.com/jquery-1.12.3.min.js"--}}
            {{--integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ="--}}
            {{--crossorigin="anonymous"></script>--}}
    {{--<script--}}
            {{--src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"--}}
            {{--integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"--}}
            {{--crossorigin="anonymous"></script>--}}
    {{--<script>--}}
<script>
    $(function() {
        $('form.require-validation').bind('submit', function(e) {
            var $form         = $(e.target).closest('form'),
                inputSelector = ['input[type=email]', 'input[type=password]',
                    'input[type=text]', 'input[type=file]',
                    'textarea'].join(', '),
                $inputs       = $form.find('.required').find(inputSelector),
                $errorMessage = $form.find('div.error'),
                valid         = true;

            $errorMessage.addClass('hide');
            $('.has-error').removeClass('has-error');
            $inputs.each(function(i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('hide');
                    e.preventDefault(); // cancel on first error
                }
            });
        });
    });

    $(function() {
        var $form = $("#payment-form");

        $form.on('submit', function(e) {
            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeResponseHandler);
            }
        });

        function stripeResponseHandler(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                // token contains id, last4, and card type
                var token = response['id'];
                // insert the token into the form so it gets submitted to the server
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }
    })
</script>

@endsection
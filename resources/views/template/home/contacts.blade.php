@extends('template.layout.layout')

@section('title')
    Contactez - Nous ! | booming
@endsection

@section('content')

    <!--inner start-->
    <div class="inner-heading">
        <div class="container">
            <h1>Contactez-Nous !</h1>
        </div>
    </div>
    <!--inner end-->

    <div class="inner-wrap">
        <div class="container">
            <!--contact start-->
            <div class="contact-info">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="contactWrp">
                            <div class="contact-icon"> <i class="fa fa-map-marker" aria-hidden="true"></i> </div>
                            <h5>Situation</h5>
                            <p>{{ setting('site.location')  }}</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="contactWrp">
                            <div class="contact-icon"> <i class="fa fa-phone" aria-hidden="true"></i> </div>
                            <h5>Téléphone</h5>
                            <p>Tél : {{ setting('site.mobile_one') }}<br>
                                @if(!empty(setting('site.mobile_two')))
                                Cel : {{ setting('site.mobile_two') }}</p>
                                @endif
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="contactWrp">
                            <div class="contact-icon"> <i class="fa fa-envelope-o" aria-hidden="true"></i> </div>
                            <h5>E-mail</h5>
                            <p>{{ setting('site.email') }}
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="contactWrp">
                            <div class="contact-icon"> <i class="fa fa-globe" aria-hidden="true"></i> </div>
                            <h5>Site Internet</h5>
                            <p><a href="http://www.tds.ci" target="_blank">www.tds.ci</a> <br>
                                <a href="http://www.aidev.ci" target="_blank">www.aidev.ci</a> </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">

                    @include('template.partials.flash')

                    {!! Form::open(['route' => 'contacts.send']) !!}
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-wrap">
                                    <input type="text" name="name" placeholder="Nom & Prénom(s)" class="form-control">
                                    <div class="form-icon"><i class="fa fa-user" aria-hidden="true"></i></div>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-wrap">
                                    <input type="text" name="mobile" placeholder="Numéro de téléphone" class="form-control">
                                    <div class="form-icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
                                    @if ($errors->has('mobile'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="input-wrap">
                            <input type="text" name="email" placeholder="Adresse E-mail" class="form-control">
                            <div class="form-icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="input-wrap">
                            <textarea class="form-control" name="message" placeholder="Saisissez votre message ici ..."></textarea>
                            <div class="form-icon"><i class="fa fa-comment" aria-hidden="true"></i></div>
                            @if ($errors->has('message'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('message') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="contact-btn">
                            <button class="sub" type="submit" value="submit" name="submitted"> <i class="fa fa-paper-plane" aria-hidden="true"></i> Envoyer mon message</button>
                        </div>
                    {!! Form::close() !!}
                </div>
                <div class="col-sm-6">
                    <div class="mapWrp">
                        <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://www.openstreetmap.org/export/embed.html?bbox=-3.9938521385192876%2C5.393022247676012%2C-3.989995121955872%2C5.396349477206377&amp;layer=mapnik&amp;marker=5.39468319439329%2C-3.9919209480285645" style="border: 0 solid; width: 100%; height: 300px;"></iframe>
                    </div>
                </div>
            </div>
            <!--contact end-->
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
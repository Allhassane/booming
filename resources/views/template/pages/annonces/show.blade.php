@extends('template.layout.layout')

@section('title')
    {{  $data->name }} | booming
@endsection

@section('content')

    <!--inner heading start-->
    <div class="inner-heading">
        <div class="container">
            <h1>{{ $data->name }}</h1>
        </div>
    </div>
    <!--inner heading end-->

    <!--Detail page start-->
    <div class="inner-wrap about">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    @if(count($pictures) > 0)
                    <div id="main" role="main">
                        <div class="slider">
                            <div class="flexslider innerslider">
                                <ul class="slides">

                                    @foreach($pictures as $picture)
                                        <li data-thumb="/assets/img/annonces/{{ $picture->picture }}">
                                            <img style="width: 100%;" src="/assets/img/annonces/{{ $picture->picture }}" alt="{{ $data->name }}"/>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif

                    <h2>Description</h2>

                    {!! $data->description !!}

                    @if(count($data->service) > 0)
                    <!-- Your Tasks -->
                        <h2>Nos points forts</h2>

                        <ul class="featureLinks">
                            @foreach($data->service as $value)
                                <li>{{ $value }}</li>
                            @endforeach
                        </ul>
                        <!-- End Your Tasks -->

                    @endif

                        <div class="row">
                            <div class="col-sm-12">
                                <h2>Commentaires</h2>

                                <div class="fb-comments" data-href="{{ route('annonce.detail', $data->slug) }}" data-numposts="5"></div>
                            </div>
                        </div>

                </div>
                <div class="col-sm-4">
                    <div class="sidebarWrp">
                        <div class="userinfo">
                            <div class="icon"><i class="fa fa-user" aria-hidden="true"></i></div>
                            <h3>{{ $data->user->name }}</h3>
                            <p>Publié le {{ date('d-m-Y', strtotime($data->created_at)) }}</p>
                            <div class="readmore">
                                @if($data->note == 0)
                                    @include('template.pages.annonces.note.0')
                                @elseif($data->note == 1)
                                    @include('template.pages.annonces.note.1')
                                @elseif($data->note == 2)
                                    @include('template.pages.annonces.note.2')
                                @elseif($data->note == 3)
                                    @include('template.pages.annonces.note.3')
                                @elseif($data->note == 4)
                                    @include('template.pages.annonces.note.4')
                                @else
                                    @include('template.pages.annonces.note.5')
                                @endif
                            </div>
                            <br>
                            <p><i class="fa fa-map-marker"></i> {{ $data->city }}</p>
                            <p>( {{ $data->situation }} )</p>
                        </div>
                        <div class="innerprice">{{ $data->mobile }}</div>

                        @if(!empty($data->fixe))
                            <div class="phone">{{ $data->fixe }}</div>
                        @else
                            <div class="phone">{{ $data->user->mobile }}</div>
                        @endif

                        <hr class="">

                        <h3>Noter cette annonce</h3>

                        {!! Form::open(['route' => ['note.save', $data->id], 'class' => 'g-py-15 text-center', 'id' => 'NoteForm']) !!}

                        <div id="NoteGroup-0" class="note" style="color: #6DC820; cursor: pointer;">
                            <span class="note-1"><i class="fa fa-star-o fa-2x"></i></span>
                            <span class="note-2"><i class="fa fa-star-o fa-2x"></i></span>
                            <span class="note-3"><i class="fa fa-star-o fa-2x"></i></span>
                            <span class="note-4"><i class="fa fa-star-o fa-2x"></i></span>
                            <span class="note-5"><i class="fa fa-star-o fa-2x"></i></span>
                            0/5
                            {!! Form::hidden('note', null) !!}
                        </div>
                        <div id="NoteGroup-1" class="note" style="color: #6DC820; cursor: pointer;">
                            <span class="note-1"><i class="fa fa-star fa-2x"></i></span>
                            <span class="note-2"><i class="fa fa-star-o fa-2x"></i></span>
                            <span class="note-3"><i class="fa fa-star-o fa-2x"></i></span>
                            <span class="note-4"><i class="fa fa-star-o fa-2x"></i></span>
                            <span class="note-5"><i class="fa fa-star-o fa-2x"></i></span>
                            1/5
                        </div>
                        <div id="NoteGroup-2" class="note" style="color: #6DC820; cursor: pointer;">
                            <span class="note-1"><i class="fa fa-star fa-2x"></i></span>
                            <span class="note-2"><i class="fa fa-star fa-2x"></i></span>
                            <span class="note-3"><i class="fa fa-star-o fa-2x"></i></span>
                            <span class="note-4"><i class="fa fa-star-o fa-2x"></i></span>
                            <span class="note-5"><i class="fa fa-star-o fa-2x"></i></span>
                            2/5
                        </div>
                        <div id="NoteGroup-3" class="note" style="color: #6DC820; cursor: pointer;">
                            <span class="note-1"><i class="fa fa-star fa-2x"></i></span>
                            <span class="note-2"><i class="fa fa-star fa-2x"></i></span>
                            <span class="note-3"><i class="fa fa-star fa-2x"></i></span>
                            <span class="note-4"><i class="fa fa-star-o fa-2x"></i></span>
                            <span class="note-5"><i class="fa fa-star-o fa-2x"></i></span>
                            3/5
                        </div>
                        <div id="NoteGroup-4" class="note" style="color: #6DC820; cursor: pointer;">
                            <span class="note-1"><i class="fa fa-star fa-2x"></i></span>
                            <span class="note-2"><i class="fa fa-star fa-2x"></i></span>
                            <span class="note-3"><i class="fa fa-star fa-2x"></i></span>
                            <span class="note-4"><i class="fa fa-star fa-2x"></i></span>
                            <span class="note-5"><i class="fa fa-star-o fa-2x"></i></span>
                            4/5
                        </div>
                        <div id="NoteGroup-5" class="note" style="color: #6DC820; cursor: pointer;">
                            <span class="note-1"><i class="fa fa-star fa-2x"></i></span>
                            <span class="note-2"><i class="fa fa-star fa-2x"></i></span>
                            <span class="note-3"><i class="fa fa-star fa-2x"></i></span>
                            <span class="note-4"><i class="fa fa-star fa-2x"></i></span>
                            <span class="note-5"><i class="fa fa-star fa-2x"></i></span>
                            5/5
                        </div>

                        <div class="mb-4 note-input">
                            <div class="note-input-hidden"></div>
                            <br>
                            <div class="contact-btn">
                                <button class="sub" type="submit" value="submit"> <i class="fa fa-paper-plane" aria-hidden="true"></i> Enregistrer ma note</button>
                            </div>
                        </div>
                        {!! Form::close() !!}

                        <hr class="">

                        {!! Form::open(['route' => ['reservation.save', $data->id], 'id' => 'ReservationForm']) !!}
                            <div class="contactWrp">
                                <h3>Contacter l'annonceur</h3>

                                <div class="flash-reservation"></div>

                                <div class="input-wrap">
                                    @if(Auth::user())
                                        {!! Form::text('name', Auth::user()->name, ['class' => 'form-control', 'placeholder' => 'Nom & Prénom(s)']) !!}
                                    @else
                                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nom & Prénom(s)']) !!}
                                    @endif
                                    <div class="form-icon"><i class="fa fa-user" aria-hidden="true"></i></div>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="input-wrap">
                                    @if(Auth::user())
                                        {!! Form::text('mobile', Auth::user()->mobile, ['class' => 'form-control', 'placeholder' => 'Numéro de téléphone']) !!}
                                    @else
                                        {!! Form::text('mobile', null, ['class' => 'form-control', 'placeholder' => 'Numéro de téléphone']) !!}
                                    @endif
                                    <div class="form-icon"><i class="fa fa-phone" aria-hidden="true"></i></div>

                                    @if ($errors->has('mobile'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="input-wrap">
                                    @if(Auth::user())
                                        {!! Form::text('email', Auth::user()->email, ['class' => 'form-control', 'placeholder' => 'Adresse E-mail']) !!}
                                    @else
                                        {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Adresse E-mail']) !!}
                                    @endif
                                    <div class="form-icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                                    @if ($errors->has('mobile'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="input-wrap">
                                    {!! Form::textarea('message', null, ['class' => 'form-control', 'placeholder' => 'Message']) !!}
                                    <div class="form-icon"><i class="fa fa-comment" aria-hidden="true"></i></div>
                                    @if ($errors->has('message'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('message') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="contact-btn">
                                    <button class="sub" id="ReservationForm-submit" type="submit" value="submit" name="submitted"> <i class="fa fa-paper-plane" aria-hidden="true"></i> Envoyer</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                        {{--<div class="safety-tips">--}}
                            {{--<h3>Safety Tips</h3>--}}
                            {{--<ul class="featureLinks">--}}
                                {{--<li>Donec elementum pharetra</li>--}}
                                {{--<li>Quisque mattis eget </li>--}}
                                {{--<li>Aenean laoreet, urna non</li>--}}
                                {{--<li>Nullam convallis</li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Detail page end-->

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.11&appId=1550351121708138';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

@endsection

@section('js')

    <script>
        $(function(){
            $('body').removeClass('stop-scrolling');
        })

        $(window).load(function(){
            $('.flexslider').flexslider({
                animation: "slide",
                controlNav: "thumbnails",
                start: function(slider){
                    $('body').removeClass('loading');
                }
            });
        });


        $(function () {
            $('#CommentForm').on('submit', function (e) {
                e.preventDefault();

                var url = $(this).attr('action');
                var data = $('#CommentForm').serialize();

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: data,
                    success: function (response) {

                        $('#CommentForm')[0].reset();

                        if (response.avatar) {
                            $('#CommentBlock').append('<div class="media g-mb-20"><img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-20" src="/assets/img/users/'+ response.avatar +'" alt="'+ response.username +'"><div class="media-body g-brd-around g-brd-gray-light-v4 g-pa-20"><div class="d-sm-flex justify-content-sm-between align-items-sm-center g-mb-15 g-mb-10--sm"><h5 class="h4 g-font-weight-300 g-mr-10 g-mb-5 g-mb-0--sm">'+ response.username +'</h5></div><p>'+ response.comment +'</p></div></div>');
                        }else{
                            $('#CommentBlock').append('<div class="media g-mb-20"><img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-20" src="/assets/img/users/user.ico" alt="'+ response.username +'"><div class="media-body g-brd-around g-brd-gray-light-v4 g-pa-20"><div class="d-sm-flex justify-content-sm-between align-items-sm-center g-mb-15 g-mb-10--sm"><h5 class="h4 g-font-weight-300 g-mr-10 g-mb-5 g-mb-0--sm">'+ response.username +'</h5></div><p>'+ response.comment +'</p></div></div>');
                        }
                    },
                    errors: function () {
                        console.log('ca passe meme pas')
                    }
                });

            });
        })

    </script>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.12&appId=1915453065395718&autoLogAppEvents=1';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
@endsection
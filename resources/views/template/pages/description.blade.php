@section('contenu')
    <div class="col-md-offset-2 col-md-8">
        <section class="container">
            <div id="shortcode5" class="col-md-12">
                <div class="shortcode-html">
                    <div class="row">
                        <div class="col-md-6 align-self-center">
                            <a class="js-fancybox d-block u-bg-overlay g-bg-black-opacity-0_5--after g-mb-30 g-mb-0--md" data-fancybox-gallery="lightbox-gallery--05" href="/assets/img-temp/800x700/img1.jpg" title="Lightbox Gallery">
                                <img class="img-fluid" src="/assets/img/annonces/{{ $annonce->images[0]->name }}" alt="Image Description">

                                <span class="u-bg-overlay__inner g-font-size-18 g-color-white g-pos-abs g-left-20 g-bottom-20">
                           <?php

                                   ?>
                          </span>
                            </a>
                        </div>



                        <div class="col-md-3">
                            <a class="js-fancybox d-block u-bg-overlay g-bg-black-opacity-0_5--after g-mb-30" data-fancybox-gallery="lightbox-gallery--05" href="/assets/img-temp/500x450/img3.jpg" title="Lightbox Gallery">
                                <img class="img-fluid" src="/assets/img/annonces/1.jpg" alt="Image Description">

                                <span class="u-bg-overlay__inner g-color-white g-pos-abs g-left-20 g-bottom-20">
                            Consectetur adipiscing
                          </span>
                            </a>

                            <a class="js-fancybox d-block u-bg-overlay g-bg-black-opacity-0_5--after g-mb-30 g-mb-0--md" data-fancybox-gallery="lightbox-gallery--05" href="/assets/img-temp/500x450/img4.jpg" title="Lightbox Gallery">
                                <img class="img-fluid" src="/assets/img/annonces/1.jpg" alt="Image Description">

                                <span class="u-bg-overlay__inner g-absolute-centered g-color-white">
                            <span class="g-font-size-46">10+</span>
                          <br>view photos
                          </span>
                            </a>

                            <img class="g-hidden-xs-up" src="/assets/img-temp/600x450/img1.jpg" alt="Image Description" data-fancybox-gallery="lightbox-gallery--05">
                            <img class="g-hidden-xs-up" src="/assets/img-temp/600x450/img1.jpg" alt="Image Description" data-fancybox-gallery="lightbox-gallery--05">
                            <img class="g-hidden-xs-up" src="/assets/img-temp/600x450/img1.jpg" alt="Image Description" data-fancybox-gallery="lightbox-gallery--05">
                        </div >
                    </div>
                </div>
            </div>

        </section>

        <section class="container">
            <h1>
                {{ $annonce->name }}
            </h1>
            <div class="col-md-8">
            <div class="u-heading-v1-1 g-bg-main g-brd-gray-light-v2 g-mb-20">
                <h2 class="h3 u-heading-v1__title">Description</h2>
            </div>
            <div>
            {{ $annonce->description }}<br>
            </div>
            </div>
            <div class="col-md-4">
                @foreach($annonce->images as $item)
                    {{ $item->name }}
                @endforeach

            </div>
        </section>
        <section class="container">

            <div class="u-heading-v1-1 g-bg-main g-brd-gray-light-v2 g-mb-20">
                <h2 class="h3 u-heading-v1__title">Services proposés</h2>
            </div>
            ==
        </section>
        <section class="container">

            <div class="u-heading-v1-1 g-bg-main g-brd-gray-light-v2 g-mb-20">
                <h2 class="h3 u-heading-v1__title">Avis et commentaires</h2>
            </div>

            <div class="media g-mb-30">
                <img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-20" src="../../assets/img-temp/100x100/img7.jpg" alt="Image Description">
                <div class="media-body u-shadow-v22 g-bg-secondary g-pa-30">
                    <div class="g-mb-15">
                        <h5 class="d-flex justify-content-between align-items-center h5 g-color-gray-dark-v1 mb-0">
                            <span class="d-block g-mr-10">James Coolman</span>
                            <a class="u-tags-v1 g-font-size-12 g-brd-around g-brd-gray-light-v4 g-bg-primary--hover g-brd-primary--hover g-color-black-opacity-0_8 g-color-white--hover rounded g-py-6 g-px-15" href="#">Author</a>
                        </h5>
                        <span class="g-color-gray-dark-v4 g-font-size-12">2 days ago</span>
                    </div>

                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia
                        congue felis in faucibus ras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>

                    <ul class="list-inline d-sm-flex my-0">
                        <li class="list-inline-item g-mr-20">
                            <a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="#">
                                <i class="icon-like g-pos-rel g-top-1 g-mr-3"></i>
                                214
                            </a>
                        </li>
                        <li class="list-inline-item g-mr-20">
                            <a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="#">
                                <i class="icon-dislike g-pos-rel g-top-1 g-mr-3"></i>
                                18
                            </a>
                        </li>
                        <li class="list-inline-item ml-auto">
                            <a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="#">
                                <i class="icon-note g-pos-rel g-top-1 g-mr-3"></i>
                                Reply
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="media g-ml-40 g-mb-30">
                <img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15" src="../../assets/img-temp/100x100/img5.jpg" alt="Image Description">
                <div class="media-body u-shadow-v22 g-bg-secondary g-pa-30">
                    <div class="g-mb-15">
                        <h5 class="h5 g-color-gray-dark-v1 mb-0">Alberta Watson</h5>
                        <span class="g-color-gray-dark-v4 g-font-size-12">6 hours ago</span>
                    </div>

                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia
                        congue felis in faucibus ras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>

                    <ul class="list-inline d-sm-flex my-0">
                        <li class="list-inline-item g-mr-20">
                            <a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="#">
                                <i class="icon-like g-pos-rel g-top-1 g-mr-3"></i>
                                637
                            </a>
                        </li>
                        <li class="list-inline-item g-mr-20">
                            <a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="#">
                                <i class="icon-dislike g-pos-rel g-top-1 g-mr-3"></i>
                                49
                            </a>
                        </li>
                        <li class="list-inline-item ml-auto">
                            <a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="#">
                                <i class="icon-note g-pos-rel g-top-1 g-mr-3"></i>
                                Reply
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="media g-mb-30">
                <img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15" src="../../assets/img-temp/100x100/img17.jpg" alt="Image Description">
                <div class="media-body u-shadow-v22 g-bg-secondary g-pa-30">
                    <div class="g-mb-15">
                        <h5 class="h5 g-color-gray-dark-v1 mb-0">David Lee</h5>
                        <span class="g-color-gray-dark-v4 g-font-size-12">5 days ago</span>
                    </div>

                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia
                        congue felis in faucibus ras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>

                    <ul class="list-inline d-sm-flex my-0">
                        <li class="list-inline-item g-mr-20">
                            <a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="#">
                                <i class="icon-like g-pos-rel g-top-1 g-mr-3"></i>
                                178
                            </a>
                        </li>
                        <li class="list-inline-item g-mr-20">
                            <a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="#">
                                <i class="icon-dislike g-pos-rel g-top-1 g-mr-3"></i>
                                34
                            </a>
                        </li>
                        <li class="list-inline-item ml-auto">
                            <a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="#">
                                <i class="icon-note g-pos-rel g-top-1 g-mr-3"></i>
                                Reply
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </div>

@endsection
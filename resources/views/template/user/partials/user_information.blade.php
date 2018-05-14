    <!-- Side Bar -->
    <div class="sidebar">
        <!-- Categories -->
        <div class="widget">
            <h5 class="widget-title">Menu</h5>
            <ul class="categories">
                <li><a href="{{ route('user.account.annonce') }}"> <i class="fa fa-plus-square-o"></i> Ajouter Une Annonce</a></li>
                <li><a href="{{ route('user.account.annonce.list') }}"> <i class=" fa fa-list"></i> Liste de mes Annonces</a></li>
                <li><a href="{{ route('user.account.annonce.archive') }}"> <i class="fa fa-file-archive-o"></i> Archive</a></li>
                <li><a href="{{ route('user.account.setting') }}"> <i class="fa fa-cog"></i> Paramètres</a></li>
            </ul>
        </div>
    </div>





{{--<!-- Profile Sidebar -->--}}
{{--<div class="col-sm-3 g-mb-50 g-mb-0--lg">--}}

    {{--<!-- Sidebar Navigation -->--}}
    {{--<div class="list-group list-group-border-0 g-mb-40">--}}
        {{--<!-- Overall -->--}}
        {{--<a href="/" id="MonProfil" class="list-group-item justify-content-between active">--}}
            {{--<span><i class="fa fa-angle-right g-pos-rel g-top-1 g-mr-8"></i> Mon profil</span>--}}
            {{--<span class="u-label g-font-size-11 g-bg-white g-color-main g-rounded-20 g-px-10">2</span>--}}
        {{--</a>--}}
        {{--<!-- End Overall -->--}}

        {{--<!-- Profile -->--}}
        {{--<a id="AjouterUneAnnonce" href="{{ route('user.account.annonce') }}" class="list-group-item list-group-item-action justify-content-between">--}}
            {{--<span><i class="fa fa-plus-square-o g-pos-rel g-top-1 g-mr-8"></i> Ajouter une annonce</span>--}}
        {{--</a>--}}
        {{--<!-- End Profile -->--}}

        {{--<!-- Profile -->--}}
        {{--<a id="MesAnnonces" href="{{ route('user.account.annonce.list') }}" class="list-group-item list-group-item-action justify-content-between">--}}
            {{--<span><i class="fa fa-list g-pos-rel g-top-1 g-mr-8"></i> Mes annonces</span>--}}
        {{--</a>--}}
        {{--<!-- End Profile -->--}}

        {{--<!-- Profile -->--}}
        {{--<a id="Archive" href="{{ route('user.account.annonce.archive') }}" class="list-group-item list-group-item-action justify-content-between">--}}
            {{--<span><i class="fa fa-archive g-pos-rel g-top-1 g-mr-8"></i> Archives</span>--}}
        {{--</a>--}}
        {{--<!-- End Profile -->--}}

        {{--<!-- Profile -->--}}
        {{--<a id="Commentaires" href="/" class="list-group-item list-group-item-action justify-content-between">--}}
            {{--<span><i class="fa fa-comments g-pos-rel g-top-1 g-mr-8"></i> Commentaires</span>--}}
        {{--</a>--}}
        {{--<!-- End Profile -->--}}

        {{--<!-- Profile -->--}}
        {{--<a id="Parametres" href="{{ route('user.account.setting') }}" class="list-group-item list-group-item-action justify-content-between">--}}
            {{--<span><i class="fa fa-cog g-pos-rel g-top-1 g-mr-8"></i> Parametres</span>--}}
        {{--</a>--}}
        {{--<!-- End Profile -->--}}

        {{--<!-- Users Contacts -->--}}
        {{--<a href="/logout" class="list-group-item list-group-item-action justify-content-between">--}}
            {{--<span><i class="fa fa-lock g-pos-rel g-top-1 g-mr-8"></i> Deconnexion</span>--}}
        {{--</a>--}}

        {{--<!-- End Settings -->--}}
    {{--</div>--}}
    {{--<!-- End Sidebar Navigation -->--}}
{{--</div>--}}
{{--<!-- End Profile Sidebar -->--}}
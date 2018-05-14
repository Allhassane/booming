<div id="pop" class="bg">
    <div class="popup">
        <span class="btn_close"><i class="fa fa-close"></i></span>
        <div class="title">Inscription Gratuite</div>

        <div class="content">
            <p>Bienvenue sur Booming.africa le marché de l'Afrique émergente</p>
            <p>Vous êtes annonceur, vous avez des services de qualité à proposer à la population ! <a href="{{ route('register') }}">Inscrivez-vous ici</a></p>
        </div>

        <ul>
            <li>Inscrivez-vous avec votre numéro de téléphone</li>
            <li>Vous allez recevoir un code de confirmation par SMS</li>
            <li>Vous pourez publier vos annonces gratuitement</li>
            <li>Et bien plus encore. Alors <a href="{{ route('register') }}">Inscrivez-vous</a></li>
        </ul>
        <div class="text-center">
            <img src="/storage/{{ setting('site.logo') }}" alt="">
        </div>
    </div>
</div>
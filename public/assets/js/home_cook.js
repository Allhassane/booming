/**
 * Created by root on 13/11/17.
 */
$(function(){

    // cookies

    function creerCookie(nom, valeur){

        var date = new Date();
        date.setTime(date.getTime() + (365*24*60*60*1000));
        var exp = date.toGMTString();

        document.cookie = nom+'='+valeur+';expires='+exp+';path=/';
    }

    function lireCookie(nom){
        var nomEtEgal = nom + '=';

        var cookieTableau = document.cookie.split(';');

        for(var i=0; i<cookieTableau.length; i++){
            var cookie = cookieTableau[i];

            while(cookie.charAt(0)==' '){
                cookie = cookie.substring(1, cookie.length);
            }

            if (cookie.indexOf(nomEtEgal) == 0) {
                return cookie.substring(nomEtEgal.length, cookie.length);
            }
        }

        return null;
    }

    // cookies


    // archiver une annonce
    $('.DisableAnnonce').on('click', function(e){
        e.preventDefault();

        var url = $('.DisableAnnonce').attr('href');
        var data = $(this);

        $(this).html('<i class="fa fa-spinner fa-spin"></i>');

        $.ajax({
            url : url,
            type: 'GET',
            data: data,
            success: function (response) {

                if (response.success){

                    data.parent().parent().parent().parent().parent().fadeOut();
                    $('.DisableAnnonce').html('<i class="fa fa-close"></i>');
                    $('#NotificationSection').html('<div class="alert alert-success">Annonce archiée avec succès</div>');

                }
            },
            errors: function () {
                $('.DisableAnnonce').html('<i class="fa fa-close"></i>');
                $('#NotificationSection').html('<div class="alert alert-danger" >Une erreure est survenue veuillez vérifer votre connexion internet et réesayer</div>');

            }
        })

    });


    // de-archiver une annonce
    $('.EnableAnnonce').on('click', function(e){
        e.preventDefault();

        var url = $(this).attr('href');
        var data = $(this);

        $(this).html('<i class="fa fa-spinner fa-spin"></i>');

        $.ajax({
            url : url,
            type: 'GET',
            data: data,
            success: function (response) {

                if (response.success){

                    data.parent().parent().parent().parent().parent().fadeOut();
                    data.html('<i class="fa fa-check"></i>');
                    $('#NotificationSection').html('<div class="alert alert-success">'+ response.success +'</div>');

                }
            },
            errors: function () {
                data.html('<i class="fa fa-close"></i>');
                $('#NotificationSection').html('<div class="alert alert-danger">Une erreure est survenue veuillez vérifer votre connexion internet et réesayer</div>');

            }
        });
    });


    // supprimer une annonce

    $('#DeleteAnnonce').on('click', function(e){
        e.preventDefault();

        var url = $('#DeleteAnnonce').attr('href');
        var data = $(this);

        $('#DeleteAnnonce').html('<i class="fa fa-spinner fa-spin"></i>');

        $.ajax({
            url : url,
            type: 'GET',
            data: data,
            success: function (response) {

                if (response.success){

                    $('#DeleteAnnonce').html('<i class="fa fa-trash"></i>');
                    $('#NotificationSection').html('<div class="container" style="margin-top: 7em; margin-bottom: -6em;"><div class="row"><div class="col-sm-12"><div class="alert fade show g-bg-primary-opacity-0_1 g-color-primary rounded-0 g-mb-5" role="alert"><button type="button" class="close u-alert-close--light g-ml-10 g-mt-1" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><div class="media"><div class="media-body"><p class="m-0">'+ response.success +'</p><span class="g-font-size-12 g-color-gray">À l\'instant</span></div></div></div></div></div></div>');

                }
            },
            errors: function () {
                $('#DeleteAnnonce').html('<i class="fa fa-close"></i>');
                $('#NotificationSection').html('<div class="container" style="margin-top: 7em; margin-bottom: -6em;"><div class="row"><div class="col-sm-12"><div class="alert fade show g-bg-red-opacity-0_1 g-color-lightred rounded-0 g-mb-5" role="alert"><button type="button" class="close u-alert-close--light g-ml-10 g-mt-1" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><div class="media"><div class="media-body"><p class="m-0">Une erreure est survenue veuillez vérifer votre connexion internet et réesayer</p><span class="g-font-size-12 g-color-gray">À l\'instant</span></div></div></div></div></div></div>');

            }
        })

        $(this).fadeOut(1000)

    });



    // create cookie in form annonce
    $('#closeStrongPointTuto').on('click', function () {
        creerCookie('CloseStrongPointTuto', 'Fermer le tutoriel sur les points forts');
    });

    $('#closeTutoImage').on('click', function () {
        creerCookie('CloseImageTuto', 'Fermer le tutoriel sur les images');
    });

    if(lireCookie('CloseStrongPointTuto') != null){
        $('#TutoStrongPoint').hide();
    }

    if(lireCookie('CloseImageTuto') != null){
        $('#TutoImage').hide();
    }


    // delete strong point
    $('.DeleteStrongPoint').on('click', function (e) {
        e.preventDefault();

        var url = $(this).attr('href');
        var data = $(this);

        $.ajax({
            url: url,
            type: 'GET',
            data: data,
            success: function () {
                data.fadeOut(200);
            },
            errors: function () {
                console.log('ca passe meme pas')
            }
        });

    });

    // delete image

    $('.DeleteImage').on('click', function (e) {
        e.preventDefault();

        var url = $(this).attr('href');
        var data = $(this);

        $.ajax({
            url: url,
            type: 'GET',
            data: data,
            success: function (url) {
                data.parent().fadeOut(200);
            },
            errors: function () {
                console.log('ca passe meme pas')
            }
        });

        var currentLocation = window.location;
        location.reload();
    });

    $('.note-1').on('click', function(e){
        e.preventDefault();

        $('.note-input').fadeIn();

        $('#NoteGroup-0').css('display', 'none');
        $('#NoteGroup-1').css('display', 'block');
        $('#NoteGroup-2').css('display', 'none');
        $('#NoteGroup-3').css('display', 'none');
        $('#NoteGroup-4').css('display', 'none');
        $('#NoteGroup-5').css('display', 'none');
        $('.note-input-hidden').html('<input name="note" type="hidden" value="1">');
    });

    $('.note-2').on('click', function(e){
        e.preventDefault();

        $('.note-input').fadeIn();
        $('#NoteGroup-0').css('display', 'none');
        $('#NoteGroup-1').css('display', 'none');
        $('#NoteGroup-2').css('display', 'block');
        $('#NoteGroup-3').css('display', 'none');
        $('#NoteGroup-4').css('display', 'none');
        $('#NoteGroup-5').css('display', 'none');
        $('.note-input-hidden').html('<input name="note" type="hidden" value="2">');
    });

    $('.note-3').on('click', function(e){
        e.preventDefault();

        $('.note-input').fadeIn();
        $('#NoteGroup-0').css('display', 'none');
        $('#NoteGroup-1').css('display', 'none');
        $('#NoteGroup-2').css('display', 'none');
        $('#NoteGroup-3').css('display', 'block');
        $('#NoteGroup-4').css('display', 'none');
        $('#NoteGroup-5').css('display', 'none');
        $('.note-input-hidden').html('<input name="note" type="hidden" value="3">');
    });

    $('.note-4').on('click', function(e){
        e.preventDefault();

        $('.note-input').fadeIn();
        $('#NoteGroup-0').css('display', 'none');
        $('#NoteGroup-1').css('display', 'none');
        $('#NoteGroup-2').css('display', 'none');
        $('#NoteGroup-3').css('display', 'none');
        $('#NoteGroup-4').css('display', 'block');
        $('#NoteGroup-5').css('display', 'none');
        $('.note-input-hidden').html('<input name="note" type="hidden" value="4">');
    });

    $('.note-5').on('click', function(e){
        e.preventDefault();

        $('.note-input').fadeIn();
        $('#NoteGroup-0').css('display', 'none');
        $('#NoteGroup-1').css('display', 'none');
        $('#NoteGroup-2').css('display', 'none');
        $('#NoteGroup-3').css('display', 'none');
        $('#NoteGroup-4').css('display', 'none');
        $('#NoteGroup-5').css('display', 'block');
        $('.note-input-hidden').html('<input name="note" type="hidden" value="5">');
    });

    $('#NoteForm').on('submit', function (e) {
        e.preventDefault();

        var url = $('#NoteForm').attr('action');
        var data = $("#NoteForm").serialize();

        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function (response) {
                if(response.success) {
                    $('#NoteForm').html('<div class="alert alert-success">Merci pour la note attibuée à cette annonce :)</div>');
                }
            },
            errors: function () {
                console.log('ca passe meme pas')
            }
        });
    });

    $('#ReservationForm').on('submit', function (e) {
        e.preventDefault();

        var url = $('#ReservationForm').attr('action');
        var data = $("#ReservationForm").serialize();

        $('#ReservationForm-submit').html('<i class="fa fa-spinner fa-spin fa-2x"></i>');

        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function (response) {

                $('#ReservationForm-submit').html('Envoyer mon message');

                if(response.success) {
                    $('#ReservationForm')[0].reset();
                    $('.flash-reservation').html('<div class="alert alert-success">'+ response.success +'</div>');
                }else{
                    $('.flash-reservation').html('<div class="alert alert-danger">'+ response.error +'</div>');
                }
            },
            errors: function () {

                $('#ReservationForm-submit').html('Envoyer mon message');
                $('.flash-reservation').html('<div class="alert alert-danger">Une erreure est survenu, veuillez vérifier votre connxeion et réesayer</div>');
            }
        });
    });

    $('#ConnexionBlock-lin').on('click', function (e) {
        e.preventDefault();

        $('#ConnexionBlock').fadeIn(500);
    })

    $('#pop').css('display', 'block');
    $('body').addClass('stop-scrolling');

    $('.btn_close').on('click', function(){
        $('#pop').css('display', 'none');
        $('body').removeClass('stop-scrolling');

        // create cookie popup home
        creerCookie('ClosePopup', 'Fermer le popup de l\'accueil');
    });

    if(lireCookie('ClosePopup') != null){
        $('#pop').css('display', 'none');
        $('body').removeClass('stop-scrolling');
    }



});
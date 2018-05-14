<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();


Route::get('/', 'HomeController@index')->name('home');
Route::get('/contacts', 'HomeController@contacts')->name('contacts');
Route::post('/contacts/send', 'HomeController@contactSend')->name('contacts.send');

Route::group(['prefix' => 'annonces'], function(){
    Route::get('/hotels', 'AnnoncesController@AnnonceHotel')->name('annonce.hotel');
    Route::get('/restaurants', 'AnnoncesController@AnnonceResto')->name('annonce.resto');
    Route::get('/maquis', 'AnnoncesController@AnnonceMaqui')->name('annonce.maquis');
    Route::get('/bars', 'AnnoncesController@AnnonceBar')->name('annonce.bar');
    Route::get('/services', 'AnnoncesController@AnnonceService')->name('annonce.service');
    Route::get('/autres', 'AnnoncesController@AnnonceAutre')->name('annonce.autres');
    Route::get('/details/{slug}', 'AnnoncesController@showAnnonce')->name('annonce.detail');
    Route::get('/search', 'AnnoncesController@AnnonceSearch')->name('annonce.search');

    Route::get('/categories', 'AnnoncesController@CategorieAnnonce')->name('annonce.categorie');
    Route::get('/categories/annonces', 'AnnoncesController@AnnonceByCategory')->name('annonce.by.category');

    Route::post('/comment/{id}/save', 'AnnoncesController@CommentSave')->name('comment.save');
    Route::post('/note/{id}/save', 'AnnoncesController@NoteSave')->name('note.save');
    Route::post('/reservation/{id}/save', 'AnnoncesController@ReservationSave')->name('reservation.save');

});

Route::get('/search', 'HomeController@indexSearch')->name('index.search');

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');
Route::post('/password/reset', 'ConfigController@sendCode')->name('password.mobile');
Route::get('/confirm/code', 'ConfigController@checkedCode')->name('password.mobile.code');
Route::post('/confirm/code', 'ConfigController@checkedCodeConfirm')->name('password.mobile.code.comfirm');
Route::post('/confirm/code/new-password', 'ConfigController@newPassword')->name('password.mobile.request');


Route::get('/home', function (){
    return redirect('/');
});

Route::get('/register/welcome', 'Auth\RegisterController@welcome')->name('welcome');
Route::get('/register/verified', 'Auth\RegisterController@verified')->name('verified');
Route::post('/register/confirm', 'HomeController@confirmCode')->name('confirm.code');

Route::group(['prefix' => 'user/account', 'middleware' => 'auth'], function () {
    Route::get('/', 'UserController@UserAccount')->name('user.account');

    // crud annonce
    Route::group(['prefix' => 'annonce'], function(){
        Route::get('/', 'UserController@UserAnnonce')->name('user.account.annonce');

        //payment

        Route::get('/pricing/{slug}', 'UserController@UserAnnoncePricing')->name('user.account.annonce.pricing');
        Route::get('/pricing/{id}/payment_mode', 'UserController@UserAnnoncePaymentMode')->name('user.account.annonce.payment.mode');
        Route::get('/pricing/{id}/payment_mode/visa_catre', 'UserController@UserAnnoncePaymentModeVisa')->name('user.account.annonce.payment.mode.visa');

        Route::get('/edit', 'UserController@UserAnnonce')->name('user.account.annonce.edit');
        Route::post('/save', 'UserController@UserAnnonceSave')->name('user.account.annonce.save');
        Route::post('/{id}/update', 'UserController@UserAnnonceUpdate')->name('user.account.annonce.update');
        Route::get('/list', 'UserController@UserAnnonceList')->name('user.account.annonce.list');
        Route::get('/archive', 'UserController@UserAnnonceArchive')->name('user.account.annonce.archive');

        Route::get('/{id}/disable', 'UserController@UserAnnonceDisable')->name('user.account.annonce.disable');
        Route::get('/{id}/enable', 'UserController@UserAnnonceEnable')->name('user.account.annonce.enable');
        Route::get('/{id}/delete', 'UserController@UserAnnonceDelete')->name('user.account.annonce.delete');

        Route::get('/delete/strong-point', 'UserController@UserAnnonceStrongPointDelete')->name('user.account.annonce.strong.point.delete');
        Route::get('/delete/delete-picture', 'UserController@UserAnnonceImageDelete')->name('user.account.annonce.image.delete');
    });

    Route::group(['prefix' => 'setting'], function(){
        Route::get('/', 'UserController@UserSetting')->name('user.account.setting');
        Route::post('/save', 'UserController@UserSettingSave')->name('user.account.setting.save');

        Route::get('/home', 'Admin\SettingController@home')->name('setting.home');
        Route::get('/texte', 'Admin\SettingController@texte')->name('setting.text');
        Route::get('/contact', 'Admin\SettingController@contact')->name('setting.contact');
        Route::post('/home/logo-update', 'Admin\SettingController@logoUpdate')->name('logo.setting');
        Route::post('/home/bg-update', 'Admin\SettingController@bgUpdate')->name('bg.setting');
        Route::post ('/home/fb-update', 'Admin\SettingController@fbUpdate')->name('fb.setting');
        Route::post ('/home/cat-update', 'Admin\SettingController@categoryUpdate')->name('category.setting');
        Route::post ('/home/contact-update', 'Admin\SettingController@contactUpdate')->name('contact.setting');
    });



});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::group(['prefix' => 'page'], function (){
    Route::get('/{slug}', 'HomeController@page')->name('route.page');
});


/* facebook */
Route::get('login/facebook', 'Auth\LoginController@redirectToProvider')->name('facebook.login');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');
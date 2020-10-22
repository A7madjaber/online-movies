<?php


Route::prefix('dashboard')
    ->name('dashboard.')
    ->middleware(['auth','role:super_admin|Admin'])
    ->group(function (){

    //welcome route
Route::get('/home','WelcomeController@index')->name('home');


        ///////////////categories route
         Route::resource('categories','CategoryController')->except(['show']);

    ///////////////role route
         Route::resource('roles','RoleController')->except(['show']);

       ////////////////movie routes////////////////////
        Route::resource('movies','MovieController')->except(['show']);


        /////////////////////users routes
         Route::resource('users','UserController')->except(['show']);

         //////////////////settings/////////////
         Route::get('/settings/social_login','SettingsController@social_login')->name('settings.social_login');
         Route::get('/settings/social_links','SettingsController@social_links')->name('settings.social_links');
         Route::post('/settings','SettingsController@store')->name('settings.store');


});

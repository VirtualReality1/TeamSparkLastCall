<?php
Route::name('cookie.')->group(function () {
    Route::prefix('cookie')->group(function () {
        Route::get('/accept', 'CookieController@accept')->name('accept');
        Route::get('/decline', 'CookieController@decline')->name('decline');
    });
});


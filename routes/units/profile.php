<?php
Route::name('profiles.')->group(function () {
    Route::prefix('profiles')->group(function () {
        Route::get('/', 'ProfileController@index')->name('index');
        Route::post('/', 'ProfileController@store')->name('store');
        Route::get('/{user:username}', 'ProfileController@show')->name('show');
        Route::get('/{user}/edit', 'ProfileController@edit')->name('edit');
        Route::put('{user}/', 'ProfileController@update')->name('update');
        Route::post('{user}/avatar', 'ProfileController@updateAvatar')->name('avatar');
        Route::delete('/{user}', 'ProfileController@destroy')->name('destroy');
        Route::get('/{user}/showinvite', 'ProfileController@showInvite')->name('showInvite');
        Route::get('/{user}/invite/{project}', 'ProfileController@invite')->name('invite');
    });
});

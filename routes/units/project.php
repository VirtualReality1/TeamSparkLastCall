<?php
Route::name('projects.')->group(function () {
    Route::prefix('projects')->group(function () {
        Route::post('', 'ProjectController@store')->name('store');

        Route::get('create', 'ProjectController@create')->name('create');
        Route::get('{project}', 'ProjectController@show')->name('show');
        Route::get('{project}/join', 'ProjectController@join')->name('join');
        Route::get('{project}/edit', 'ProjectController@edit')->name('edit');
        Route::put('{project}', 'ProjectController@update')->name('update');

    });
});

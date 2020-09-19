<?php
Route::name('search.')->group(function () {
    Route::prefix('search')->group(function () {
        Route::get('user', 'SearchController@chooseProject')->name('user');
        Route::get('user/{project}', 'SearchController@user')->name('user.project');
        Route::get('project', 'SearchController@project')->name('project');
    });
});

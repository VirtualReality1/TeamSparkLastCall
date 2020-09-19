<?php

Auth::routes();

Route::get('/', 'StaticController@index')->name('index');
Route::get('/imprint', 'StaticController@imprint')->name('imprint');
Route::get('/privacy', 'StaticController@privacy')->name('privacy');
Route::get('/tos', 'StaticController@tos')->name('tos');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/projects', 'ProjectController@index')->name('projects.index');
require base_path('routes/units/cookie.php');

Route::middleware('auth')->group(function () {
    require base_path('routes/units/search.php');
    require base_path('routes/units/profile.php');
    require base_path('routes/units/project.php');
    Route::post('/feedback', 'FeedbackController@submit');
});


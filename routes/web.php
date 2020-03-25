<?php

use Illuminate\Support\Facades\Route;

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
Route::middleware([\App\Http\Middleware\IncludeSeriesForNavbar::class])->group(function () {
    Auth::routes();

    Route::get('/', 'HomeController@index')->name('home');

    Route::resource('series', 'SeriesController')->only(['show', 'index']);

    Route::resource('episode', 'EpisodesController')->only(['show', 'index']);;

    Route::group(['middleware' => 'auth'], function () {
        // Series
        Route::post('series/{series}/follow', 'SeriesController@follow')->name('series.follow');
        Route::post('series/{series}/unfollow', 'SeriesController@unfollow')->name('series.unfollow');
        // Episodes
        Route::post('episode/{episode}/react', 'EpisodesController@react')->name('episode.react');
        Route::post('episode/{episode}/remove-react', 'EpisodesController@removeReact')->name('episode.remove-react');;
    });

    Route::get('/search', 'SearchController@search')->name('search.index');
});

Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
    Route::get('/', 'AdminController@index');
    Route::resource('series', 'SeriesController');
    Route::resource('episode', 'EpisodesController');
});

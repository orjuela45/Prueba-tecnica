<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'actors'], function () {
    Route::get('/getActors', 'ActorsController@getActors');
    Route::get('/getActor/{id}', 'ActorsController@getActorById');
    Route::post('/create', 'ActorsController@createActor');
    Route::post('/update/{id}', 'ActorsController@updateActor');
    Route::get('/delete/{id}', 'ActorsController@deleteActor');
});

Route::group(['prefix' => 'movies'], function () {
    Route::get('/getMovies', 'MoviesController@getMovies');
    Route::get('/getMovie/{id}', 'MoviesController@getMovieById');
    Route::post('/create', 'MoviesController@createMovie');
    Route::post('/update/{id}', 'MoviesController@updateMovie');
    Route::get('/delete/{id}', 'MoviesController@deleteMovie');
});

Route::group(['prefix' => 'movie_actors'], function () {
    Route::get('/getMovies', 'MovieActorsController@getMoviesActors');
    Route::get('/getMovie/{id}', 'MovieActorsController@getMovieActorById');
    Route::post('/create', 'MovieActorsController@createMovieActor');
    Route::get('/delete/{id}', 'MovieActorsController@deleteMovieActor');
});

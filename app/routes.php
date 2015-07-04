<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::get('/logout', function() {
    Session::flush();
    return Redirect::guest("/");
});

Route::get('/', function() {
    return View::make("index");
  });

if (Session::get("user") == null) {
  Route::controller('/user', 'UserController');
} else {
  
  Route::get('/logout', function() {
    Session::flush();
    return Redirect::guest("/")->with("You have logged out");
  });
  
  Route::get('/', function() {
    return View::make("movies");
  });
  
  Route::controller('/movies', 'MovieController');
  Route::controller('/series', 'SerieController');
  Route::controller('/user', 'UserController');
  
}
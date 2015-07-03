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

if (Session::get("user") == null) {
  Route::controller('/', 'UserController');
} else {
  
  Route::get('/logout', function() {
    Session::flush();
    return Redirect::guest("/")->with("You have logged out");
  });
  
  Route::get('/', function() {
    return View::make("hello");
  });
  
}
<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', function () {
    return View::make('index');
});

Route::resource('Wartungsvertraege', 'WartungsvertragController');

//Route::controller('Produkte', 'ProdukteController');
Route::resource('Produkte', 'ProduktController');

/*Route::get('/home', function () {
    return view('home');
});*/

// Catch Exceptions -> führt zu Exception :(
/*App::missing(function($exception) {
    return View::make('index');
});*/

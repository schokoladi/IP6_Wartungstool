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

// API-Prefix -> /api/Produkte/...
Route::group(array('prefix' => 'api'), function() {

  // Hier wird von Deutsch auf Englisch weitergeleitet
  Route::resource('contracts', 'ContractController');

  // Produkte-Routing
  Route::resource('products', 'ProductController');

  Route::resource('manufacturers', 'ManufacturerController');

});

//Route::controller('Produkte', 'ProdukteController');

/*Route::get('/home', function () {
return view('home');
});*/

// Catch Exceptions -> führt zu Exception :(
/*App::missing(function($exception) {
return View::make('index');
});*/

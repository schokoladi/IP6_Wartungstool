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

  // Authenticate controller
  //Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
  Route::post('authenticate', 'AuthenticateController@authenticate');
  Route::get('authenticate/user', 'AuthenticateController@getAuthenticatedUser');

  // Hier wird von Deutsch auf Englisch weitergeleitet
  Route::resource('contracts', 'ContractController');

  // Produkte-Routing
  Route::resource('products', 'ProductController');
  Route::get('products/{manufacturerId}/{productName}', 'ProductController@reference');

  // Artikel-Routing
  Route::resource('articles', 'ArticleController');
  Route::get('articles/{productId}', 'ProductController@product');

  // Waehrungen-Routing
  Route::resource('stundenpools', 'PoolController');

  // Hersteller-Routing
  Route::get('manufacturers/exists/{manufacturer}', 'ManufacturerController@exists');
  Route::resource('manufacturers', 'ManufacturerController');

  // Kunden-Routing
  Route::resource('customers', 'CustomerController');

  // Kontaktpersonen-Routing
  Route::resource('contacts', 'ContactController');

  // Waehrungen-Routing
  Route::resource('currencies', 'CurrencyController');

  // Waehrungen-Routing
  Route::resource('maintenances', 'MaintenanceController');

  // Waehrungen-Routing
  Route::resource('operationsupports', 'OperationsupportController');

  // Waehrungen-Routing
  Route::resource('osstundenpools', 'OperationsupportStundenpoolController');

});

/*
Route::controllers([
  'auth' => 'Auth\AuthController',
  'password' => 'Auth\PasswordController'
  ]);
*/
//Route::controller('Produkte', 'ProdukteController');

/*Route::get('/home', function () {
return view('home');
});*/

// Catch Exceptions -> führt zu Exception :(
/*App::missing(function($exception) {
return View::make('index');
});*/

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

// Index-Route
Route::get('/', function () {
  return View::make('index');
});

// API-Prefix -> /api/.../...
Route::group(array('prefix' => 'api'), function() {

  // Authenticate-Routing
  Route::post('authenticate', 'AuthenticateController@authenticate');
  Route::get('authenticate/user', 'AuthenticateController@getAuthenticatedUser');

  // Wartungsvertraege-Routing
  Route::resource('contracts', 'ContractController');

  // Produkte-Routing
  Route::resource('products', 'ProductController');
  // Zusätzliche GET-Route für die Kontrolle mit Hersteller und Produktname
  Route::get('products/{manufacturerId}/{productName}', 'ProductController@reference');

  // Artikel-Routing
  Route::resource('articles', 'ArticleController');
  // Zusätzliche GET-Route für die Kontrolle, ob dem Artikel noch Produkte
  // zugewiesen sind
  Route::get('articles/{productId}', 'ProductController@product');

  // Stundenpools-Routing
  Route::resource('stundenpools', 'PoolController');

  // Hersteller-Routing
  Route::resource('manufacturers', 'ManufacturerController');

  // Kunden-Routing
  Route::resource('customers', 'CustomerController');

  // Kontaktpersonen-Routing
  Route::resource('contacts', 'ContactController');

  // Waehrungen-Routing
  Route::resource('currencies', 'CurrencyController');

  // Wartungen-Routing
  Route::resource('maintenances', 'MaintenanceController');

  // Operation-Support-Routing
  Route::resource('operationsupports', 'OperationsupportController');

  // OS-Stundenpools-Routing
  Route::resource('osstundenpools', 'OperationsupportStundenpoolController');

});

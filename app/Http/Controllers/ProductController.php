<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Notwendig für das Model
use App\Product;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return Response
  */
  public function index()
  {
    
    // Hol alle Produkte via Model
    $products = Product::all();
    $json = array();
    $i = 0;

    // Das Array wird mit dem Hersteller neu zusammengestellt
    foreach($products as $product)
    {
      $json[$i]['ID'] = $product->ID;
      $json[$i]['Name'] = $product->Name;
      $json[$i]['Artikelnummer'] = $product->Artikelnummer;
      // Hol den zum Produkt gehörigen Hersteller
      $manufacturer = Product::find($product->ID);
      $json[$i]['Hersteller'] = $product->manufacturer->Name;
      $i++;
    }
    // gib das Array als json-String
    return response()->json($json);

  }

  /**
  * Show the form for creating a new resource.
  *
  * @return Response
  */
  public function create()
  {
    //
  }

  /**
  * Store a newly created resource in storage.
  *
  * @return Response
  */
  public function store()
  {
    $product = new Product;
    $product->Artikelnummer = $request->Artikelnummer;
    $product->Name = $request->Name;
    $product->Produkte_Hersteller_ID = $request->Hersteller_ID;
    $product->save();
    /*Produkt::create(array(
    'Artikelnummer' => Input::get('Artikelnummer'),
    'Name' => Input::get('Name'),
    'Produkte_Hersteller_ID' => Input::get('Hersteller_ID'),
    'created_at' => new DateTime,
    'updated_at' => new DateTime
  ));*/
  //return Response::json(array('success' => true));
  return response()->json(['success' => true]);
}

/**
* Display the specified resource.
*
* @param  int  $id
* @return Response
*/
public function show($id)
{
  //
}

/**
* Show the form for editing the specified resource.
*
* @param  int  $id
* @return Response
*/
public function edit($id)
{
  //
}

/**
* Update the specified resource in storage.
*
* @param  int  $id
* @return Response
*/
public function update($id)
{
  //
}

/**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return Response
*/
public function destroy($id)
{
  echo 'lol';
  /*Produkt::destroy($id);

  return Response::json(array('success' => true));*/
}
}

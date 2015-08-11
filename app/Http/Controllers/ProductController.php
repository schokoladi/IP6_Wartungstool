<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use DateTime;

/**
 * Die ArticleController-Klasse handlet alle Funktionen (Actions), welche über
 * die URL 'api/articles' aufgerufen werden
 */
class ProductController extends Controller
{

  /**
  * Mit dem Konstruktor wird diese Klasse in der Middleware registriert, welche
  * beim Seitenaufruf zwischengeschaltet wird und filtert
  */
  public function __construct()
  {
    $this->middleware('jwt.auth');
  }

  /**
  * Gibt alle bestehenden Produkte zurück und holt zudem jeweils den dazugehörigen
  * Herstellen per Methode manufacturer() des Models Product.
  *
  * @return response  Erstelltes Array als JSON-String
  * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
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

      // Holt den zum Produkt gehörigen Hersteller
      $json[$i]['Hersteller'] = $product->manufacturer->Name;
      $i++;
    }

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
  * Speichert ein Produkt in der Datenbank mit den per Input übergebenen Formulardaten.
  *
  * @return response  Success-Meldung als JSON-String
  * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
  */
  public function store()
  {
    $product = new Product;

    $product->Artikelnummer = Input::get('Artikelnummer');
    $product->Name = Input::get('Name');
    $product->Produkte_Hersteller_ID = Input::get('Produkte_Hersteller_ID');
    $product->created_at = new DateTime;
    $product->updated_at = new DateTime;

    $product->save();

    return response()->json(['success' => true]);
  }

  /**
  * Gibt ein Produkte anhand der übergebenen Hersteller-ID zurück.
  *
  * @param  integer   Hersteller-ID
  * @return response  Produkte als Objekte in JSON-String
  * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
  */
  public function show($id)
  {
    return response()->json(Product::where('Produkte_Hersteller_ID', $id)->get());
  }

  /**
  * Dient der Einschränkung eines Produkts anhand der übergebenen Hersteller-ID
  * und des Produktnamens. So kann schlussendlich nur noch die Artikelnummer aus-
  * gewählt werden.
  *
  * @param  integer   Hersteller-ID
  * @param  integer   Produktname
  * @return response  Product-Objekte als JSON-String
  * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
  */
  public function reference($manufacturerId, $productName)
  {
    return response()->json(Product::where('Produkte_Hersteller_ID', $manufacturerId)->where('Name', $productName)->get());
  }

  /**
  * Gibt ein Produkt anhand der übergebenen ID zum bearbeiten zurück.
  *
  * @param  integer   Produkt-ID
  * @return response  Product-Objekt als JSON-String
  * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
  */
  public function edit($id)
  {
    return response()->json(Product::findOrFail($id));
  }

  /**
  * Aktualisiert ein Produkt anhand der mit Input übergebenen Formulardaten.
  *
  * @param  integer   Produkt-ID
  * @return response  Success-Meldung als JSON-String
  * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
  */
  public function update(Request $request, $id)
  {
    $product = Product::find($id);

    // Nur notwendige Werte ändern, 'updated_at' wird automatisch aktualisiert
    $product->Artikelnummer = Input::get('Artikelnummer');
    $product->Name = Input::get('Name');
    $product->Produkte_Hersteller_ID = Input::get('Produkte_Hersteller_ID');

    $product->save();

    return response()->json(['success' => true]);
  }

  /**
  * Löscht ein Produkt anhand der übergebenen ID.
  *
  * @param  integer   Produkt-ID
  * @return response  Success-Meldung als JSON-String
  * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
  */
  public function destroy($id)
  {
    Product::destroy($id);

    return response()->json(['success' => true]);
  }
  
}

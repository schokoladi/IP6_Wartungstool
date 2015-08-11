<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Currency;

use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
* Die CurrencyController-Klasse handlet alle Funktionen (Actions), welche über
* die URL 'api/currencies' aufgerufen werden
*/
class CurrencyController extends Controller
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
  * Holt alle Währungen aus der Datenbank und gibt sie als JSON-Objekt zurück.
  *
  * @return response  Curreny-Objekt als JSON-String
  * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
  */
  public function index()
  {
    return response()->json(Currency::all());
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
    //
  }

  /**
  * Gibt die Währung der mitgegebenen ID zurück.
  *
  * @param  integer   Übergebene ID der Wärhung
  * @return response  Währungsobjekt als JSON-String
  * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
  */
  public function show($id)
  {
    return response()->json(Currency::find($id));
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
    //
  }
  
}

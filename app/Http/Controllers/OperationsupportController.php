<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Operationsupport;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use DateTime;

/**
 * Die OperationsupportController-Klasse handlet alle Funktionen (Actions), welche
 * über die URL 'api/operationsupport' aufgerufen werden
 */
class OperationsupportController extends Controller
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
  * Gibt alle Operation Supports als Objekte in einem JSON-String zurück
  *
  * @return response  OS-Objekte als JSON-String
  * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
  */
  public function index()
  {
    return response()->json(Operationsupport::all());
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
  * @param  Request  $request
  * @return Response
  */
  public function store(Request $request)
  {
    //
  }

  /**
  * Gibt einen bestimmten Operation Support anhand der übergebenen ID zurück.
  *
  * @param  integer   Übergebene ID des Operation Supports
  * @return response  OS-Objekt als JSON-String
  * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
  */
  public function show($id)
  {
    return response()->json(Operationsupport::where('ID', $id)->get());
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
  * @param  Request  $request
  * @param  int  $id
  * @return Response
  */
  public function update(Request $request, $id)
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

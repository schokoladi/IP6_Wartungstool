<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Maintenance;

use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
 * Die MaintenanceController-Klasse handlet alle Funktionen (Actions), welche über
 * die URL 'api/maintenances' aufgerufen werden
 */
class MaintenanceController extends Controller
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
  * Gibt alle Wartungen in einem JSON-String als Objekte zurück
  *
  * @return response  Alle Wartungen als Objekte in JSON-String
  * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
  */
  public function index()
  {
    return response()->json(Maintenance::all());
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
    //
  }
}

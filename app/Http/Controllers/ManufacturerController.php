<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Manufacturer;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use DateTime;

/**
 * Die ManufacturerController-Klasse handlet alle Funktionen (Actions), welche über
 * die URL 'api/manufacturers' aufgerufen werden
 */
class ManufacturerController extends Controller
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
  * Gibt alle Hersteller als Objekte in einem JSON-String zurück
  *
  * @return response  Hersteller als Objekte in JSON-String
  * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
  */
  public function index()
  {
    return response()->json(Manufacturer::all());
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
  * Erstellt einen neuen Hersteller und gibt dessen ID zusammen mit der Success-
  * Meldung als JSON-String zurück.
  *
  * @return response  Success-Meldung und ID des erstellten Herstellers als JSON
  * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
  */
  public function store()
  {
    // firstOrNew sucht sich bestehenden Wert mit 'Name' oder Erstellt einen neuen
    $manufacturer = Manufacturer::firstOrNew(['Name' => Input::get('Hersteller')]);
    $manufacturer->created_at = new DateTime;
    $manufacturer->updated_at = new DateTime;
    $manufacturer->save();

    // gibt die ID des gerade erstellten Herstellers zurück
    return response()->json([
      'success' => true,
      'Manufacturer' => Manufacturer::orderBy('ID', 'desc')->first()
      ]);
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

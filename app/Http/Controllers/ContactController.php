<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contact;

use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
 * Die ContactController-Klasse handlet alle Funktionen (Actions), welche über
 * die URL 'api/contacts' aufgerufen werden
 */
class ContactController extends Controller
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
  * Display a listing of the resource.
  *
  * @return Response
  */
  public function index()
  {
    return response()->json(Contact::all());
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
  * Holt die Kontaktpersonen aus der Datenbank, welche dem übergebenen Kunden
  * zugeordnet sind.
  *
  * @param  integer   Übergebene ID des Kunden
  * @return response  Datenbankobjekt als JSON-String
  * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
  */
  public function show($id)
  {
    return response()->json(Contact::where('Kontaktpersonen_Kunden_ID', $id)->get());
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

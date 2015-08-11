<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Customer;

use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
 * Die CustomerController-Klasse handlet alle Funktionen (Actions), welche über
 * die URL 'api/customers' aufgerufen werden
 */
class CustomerController extends Controller
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
  * Gibt alle Kunden in einem JSON-String als Objekte zurück.
  *
  * @return response  Kunden als JSON-Objekte
  * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
  */
  public function index()
  {
    return response()->json(Customer::all());
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Notwendig und nicht standardmässig eingefügt
use App\Customer;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
  public function __construct() {
    // für alle
    //$this->middleware('jwt.auth');
    // Mit Ausnahmen
    $this->middleware('jwt.auth');

    // Wird dann so in den routes angezeigt!!!
  }
  /**
  * Display a listing of the resource.
  *
  * @return Response
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

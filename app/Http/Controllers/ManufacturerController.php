<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Notwendig für das Model
use App\Manufacturer;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use DateTime;
use Log;

class ManufacturerController extends Controller
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
    // Alle Hersteller als json-String zurückgeben
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
  * Store a newly created resource in storage.
  *
  * @return Response
  */
  public function store()
  {
    // firstOrNew sucht sich bestehenden Wert mit 'Name' oder Erstellt einen neuen
    // Log::info('Hersteller: '. Input::get('Hersteller'));
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

    public function exists($name)
    {
      // gib true oder false als String zurück, boolean nicht möglich
      if(Manufacturer::where('Name', '=', $name)->exists()) {
        return response()->json(['success' => true]);
      } else {
        return response()->json(['success' => false]);
      }
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

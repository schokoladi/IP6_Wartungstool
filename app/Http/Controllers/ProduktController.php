<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Notwendig für das Model
use App\Produkt;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProduktController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //echo 'hallo'; das hat funktioniert
        /*$produkte = Produkt::all();
        return view('flight.index', ['flights' => $flights]);*/

        // Ergebnis als json übergeben
        return response()->json(Produkt::get());
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
        $produkt = new Produkt;
        $produkt->Artikelnummer = $request->Artikelnummer;
        $produkt->Name = $request->Name;
        $produkt->Produkte_Hersteller_ID = $request->Hersteller_ID;
        $produkt->save();
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

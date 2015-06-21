<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProdukteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //echo 'hallo':
        /*$produkte = Produkt::all();
        return view('flight.index', ['flights' => $flights]);*/

        return Response::json(Produkt::get());
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
      /*Produkt::create(array(
          'Artikelnummer' => Input::get('Artikelnummer'),
          'Name' => Input::get('Name'),
          'Produkte_Hersteller_ID' => Input::get('Hersteller_ID'),
          'created_at' => new DateTime,
          'updated_at' => new DateTime
      ));
      return Response::json(array('success' => true));*/
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
      Produkt::destroy($id);

      return Response::json(array('success' => true));
    }
}

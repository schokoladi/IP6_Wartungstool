<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pool;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use DateTime;

class PoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
      //
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
      $pool = new Pool;

      $pool->Stundenpools_Wartungsvertraege_ID = Input::get('Stundenpools_Wartungsvertraege_ID');
      $pool->Stundenpools_OS_Stundenpools_ID = Input::get('Stundenpools_OS_Stundenpools_ID');

      $pool->Stundenpool_Start = Input::get('Stundenpool_Start');
      $pool->Stundenpool_von = Input::get('Stundenpool_von');
      $pool->Stundenpool_bis = Input::get('Stundenpool_bis');

      $pool->Stundensatz = Input::get('Stundensatz');
      $pool->Stundensatz_Waehrungen_ID = Input::get('Stundensatz_Waehrungen_ID');
      $pool->Anzahl_Stunden = Input::get('Anzahl_Stunden');

      $pool->Rechnungsnummer = Input::get('Rechnungsnummer');
      $pool->Rechnungsdatum = Input::get('Rechnungsdatum');

      $pool->save();

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
      $pools = Pool::where('Stundenpools_Wartungsvertraege_ID', $id)->get();
      $json = array();
      $i = 0;

      // Das Array wird mit dem Hersteller neu zusammengestellt
      foreach($pools as $pool)
      {
        $json[$i]['ID'] = $pool->ID;
        $json[$i]['Anzahl_Stunden'] = $pool->Anzahl_Stunden;
        // Hol den zum Produkt gehörigen Hersteller
        //$manufacturer = Product::find($product->ID);
        $json[$i]['OS_Pool'] = $pool->ospool->Bezeichnung;
        $i++;
      }
      // gib das Array als json-String
      return response()->json($json);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
      $pool = Pool::findOrFail($id);

      // Formatiere das Datum wieder um (die DB gibt YYYY-MM-DD zurück)
      //$article->Auftragsdatum = Carbon::createFromDate('d.m.Y', $article->Auftragsdatum);
      $pool->Stundenpool_Start = date("d.m.Y", strtotime($pool->Stundenpool_Start));
      $pool->Stundenpool_von = date("d.m.Y", strtotime($pool->Stundenpool_von));
      $pool->Stundenpool_bis = date("d.m.Y", strtotime($pool->Stundenpool_bis));
      $pool->Rechnungsdatum = date("d.m.Y", strtotime($pool->Rechnungsdatum));

      return response()->json($pool);
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
      $pool = Pool::find($id);

      $pool->Stundenpools_Wartungsvertraege_ID = $request->input('Stundenpools_Wartungsvertraege_ID');
      $pool->Stundenpools_OS_Stundenpools_ID = $request->input('Stundenpools_OS_Stundenpools_ID');

      $pool->Stundenpool_Start = $request->input('Stundenpool_Start');
      $pool->Stundenpool_von = $request->input('Stundenpool_von');
      $pool->Stundenpool_bis = $request->input('Stundenpool_bis');

      $pool->Stundensatz = $request->input('Stundensatz');
      $pool->Stundensatz_Waehrungen_ID = $request->input('Stundensatz_Waehrungen_ID');
      $pool->Anzahl_Stunden = $request->input('Anzahl_Stunden');

      $pool->Rechnungsnummer = $request->input('Rechnungsnummer');
      $pool->Rechnungsdatum = $request->input('Rechnungsdatum');

      $pool->save();

      return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
      Pool::destroy($id);

      return response()->json(['success' => true]);
    }
}

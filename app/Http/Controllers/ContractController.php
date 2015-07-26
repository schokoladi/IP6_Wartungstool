<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Notwendig für das Model
use App\Contract;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use DateTime;

class ContractController extends Controller
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
    $contracts = Contract::all();
    $json = array();
    $i = 0;

    // Das Array wird mit dem Hersteller neu zusammengestellt
    foreach($contracts as $contract)
    {
      $json[$i]['ID'] = $contract->ID;
      $json[$i]['Vertragsnummer'] = $contract->Vertragsnummer;
      $json[$i]['Beschreibung'] = $contract->Beschreibung;
      $json[$i]['Inaktiv'] = $contract->Inaktiv;
      $json[$i]['Zustaendigkeit'] = $contract->Zustaendigkeit;
      // Hol den zum Produkt gehörigen Hersteller
      $json[$i]['Kunde'] = $contract->customer->Name;
      $json[$i]['Kontaktperson_Vorname'] = $contract->contact->Vorname;
      $json[$i]['Kontaktperson_Name'] = $contract->contact->Name;
      $i++;
    }
    // gib das Array als json-String
    return response()->json($json);

    //return response()->json(Contract::get());
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
    $contract = new Contract;
    $contract->Vertragsnummer = Input::get('Vertragsnummer');
    $contract->Beschreibung = Input::get('Beschreibung');
    $contract->Inaktiv = Input::get('Inaktiv');
    $contract->Zustaendigkeit = Input::get('Zustaendigkeit');
    $contract->Wartungsvertraege_Kunden_ID = Input::get('Wartungsvertraege_Kunden_ID');
    $contract->Wartungsvertraege_Kontaktpersonen_ID = Input::get('Wartungsvertraege_Kontaktpersonen_ID');
    $contract->created_at = new DateTime;
    $contract->updated_at = new DateTime;
    $contract->save();

    return response()->json([
      'success' => true,
      'Contract' => Contract::orderBy('ID', 'desc')->first()
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
      $contract = Contract::findOrFail($id);
      $json = array();
      $i = 0;
      $j = 0;

      $json['ID'] = $contract->ID;
      $json['Vertragsnummer'] = $contract->Vertragsnummer;
      $json['Beschreibung'] = $contract->Beschreibung;
      $json['Inaktiv'] = $contract->Inaktiv;
      $json['Zustaendigkeit'] = $contract->Zustaendigkeit;
      // Kunde und Kontaktperson via ID holen
      $json['Kunde'] = $contract->customer->Name;
      $json['Kontaktperson_Vorname'] = $contract->contact->Vorname;
      $json['Kontaktperson_Name'] = $contract->contact->Name;

      $articles = Contract::find($id)->articles;
      // Artikel nür füllen, wenn Werte vorhanden
      if(!empty($articles)) {
        foreach($articles as $article) {
          $json['Artikel'][$i]['ID'] = $article->ID;
          $json['Artikel'][$i]['Seriennummer'] = $article->Seriennummer;
          $json['Artikel'][$i]['Artikelnummer'] = $article->product->Artikelnummer;
          $json['Artikel'][$i]['Name'] = $article->product->Name;
          $json['Artikel'][$i]['Hersteller'] = $article->product->manufacturer->Name;
          $json['Artikel'][$i]['Maintenance'] = $article->maintenance->Bezeichnung;
          $json['Artikel'][$i]['Start'] = $article->Maintenance_Start;
          $i++;
        }
      }

      $pools = Contract::find($id)->pools;
      // Pools nür füllen wenn Werte vorhanden
      if(!empty($pools)) {
        foreach($pools as $pool) {
          $json['Stundenpools'][$j]['ID'] = $pool->ID;
          $json['Stundenpools'][$j]['Stundenpool_Start'] = $pool->Stundenpool_Start;
          $json['Stundenpools'][$j]['Anzahl_Stunden'] = $pool->Anzahl_Stunden;
          $json['Stundenpools'][$j]['Stundensatz'] = $pool->Stundensatz;
          $json['Stundenpools'][$j]['Rechnungsnummer'] = $pool->Rechnungsnummer;
          $j++;
        }
      }

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
      // gib das Array als json-String. findOrFail gibt sonst Exception zurück
      return response()->json(Contract::findOrFail($id));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update(Request $request, $id)
    {
      $contract = Contract::find($id);
      $contract->Vertragsnummer = $request->input('Vertragsnummer');
      $contract->Beschreibung = $request->input('Beschreibung');
      $contract->Inaktiv = $request->input('Inaktiv');
      $contract->Zustaendigkeit = $request->input('Zustaendigkeit');
      $contract->Wartungsvertraege_Kunden_ID = $request->input('Wartungsvertraege_Kunden_ID');
      $contract->Wartungsvertraege_Kontaktpersonen_ID = $request->input('Wartungsvertraege_Kontaktpersonen_ID');

      $contract->save();

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
      //
    }
  }

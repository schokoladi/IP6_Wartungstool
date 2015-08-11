<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contract;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use DateTime;

/**
 * Die ContractController-Klasse handlet alle Funktionen (Actions), welche über
 * die URL 'api/contracts' aufgerufen werden
 */
class ContractController extends Controller
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
  * Holt alle Wartungsverträge aus der Datenbank und fügt dem Array zusätzlich
  * verknüpfte daten hinzu. Dies wird mit den Methoden customer() und contact()
  * des Contract-Models erreicht.
  *
  * @return response  Generiertes Array als JSON-String
  * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
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

    return response()->json($json);
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
  * Speichert einen Wartungsvertrag und dessen Details per übergebener Formular-
  * werte. Im JSON-String wird die erstellte Wartungsvertrags-ID zurückgegeben,
  * damit diese für die weitere Erfassung von Warutngsvertragsatrikeln verwendet
  * werden kann.
  *
  * @return response  Generiertes Array als JSON-String mit der letzten WV-ID
  * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
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
    * Holt einen Wartungsvertrag und dessen Artikel und Stundenpools aus der
    * Datenbank für die Detailsansicht. Dafür wird ein Array zusammengestellt.
    *
    * @param  integer   Übergebene ID des Wartungsvertrages
    * @return response  Generiertes Array als JSON-String
    * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
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

      // Zum Wartungsvertrag gehörige Artikel holen
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

      // Zum Wartungsvertrag gehörige Stundenpools holen
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
    * Holt einen Wartungsvertrag aus der Datenbank zum editieren.
    *
    * @param  integer   Übergebene ID des Wartungsvertrages
    * @return response  Contract-Objekt als JSON-String
    * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
    */
    public function edit($id)
    {
      return response()->json(Contract::findOrFail($id));
    }

    /**
    * Aktualisiert einen Wartungsvertrag mit den übergebenen Formularwerten.
    *
    * @param  Request   Formularwerte
    * @param  integer   Übergebene ID des Wartungsvertrages
    * @return response  Success-Meldung als JSON-String
    * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
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
      // Das Löschen einen Wartungsvertrags ist nicht vorgesehehen.
      // Dafür kann er auf inaktiv geschaltet werden
    }
  }

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pool;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use DateTime;

/**
 * Die PoolController-Klasse handlet alle Funktionen (Actions), welche über
 * die URL 'api/stundenpools' aufgerufen werden
 */
class PoolController extends Controller
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
  * Speichert einen erfassten Stundenpool anhand der mit Input übergebenen Formular-
  * daten.
  *
  * @return response  Success-Meldung als JSON-String
  * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
  */
  public function store()
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

    $pool->created_at = new DateTime;
    $pool->updated_at = new DateTime;

    $pool->save();

    return response()->json(['success' => true]);
  }

  /**
  * Gibt ein Stundenpool anhand der übergebenen Wartungsvertrags-ID zurück.
  * Dabei wird die zum Stundenpool gehörigen Operation Supports mitgegeben.
  * Dies ist momentan nur einer, soll aber erweitert werden können.
  *
  * @param  integer   Übergebene ID des Wartungsvertrages
  * @return response  Generiertes Array als JSON-String
  * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
  */
  public function show($id)
  {
    $pools = Pool::where('Stundenpools_Wartungsvertraege_ID', $id)->get();
    $json = array();
    $i = 0;

    // Das Array wird mit den OS-Pools neu zusammengestellt
    foreach($pools as $pool)
    {
      $json[$i]['ID'] = $pool->ID;
      $json[$i]['Anzahl_Stunden'] = $pool->Anzahl_Stunden;
      // Hol den zum Stundenpool gehörigen Operation Support
      $json[$i]['OS_Pool'] = $pool->ospool->Bezeichnung;
      $i++;
    }

    return response()->json($json);
  }

  /**
  * Gibt einen Stundenpool anhand der übergebenen ID zurück und wandelt dabei die
  * Daten in das Format "TT.MM.JJJJ" um, da sie in der Datenbank in YYYY-MM-DD
  * gespeichert sind.
  *
  * @param  integer   Übergebene ID des Stundenpools
  * @return response  Generiertes Array als JSON-String
  * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
  */
  public function edit($id)
  {
    $pool = Pool::findOrFail($id);

    // Formatiere das Datum wieder um (die DB gibt YYYY-MM-DD zurück)
    $pool->Stundenpool_Start = date("d.m.Y", strtotime($pool->Stundenpool_Start));
    $pool->Stundenpool_von = date("d.m.Y", strtotime($pool->Stundenpool_von));
    $pool->Stundenpool_bis = date("d.m.Y", strtotime($pool->Stundenpool_bis));
    $pool->Rechnungsdatum = date("d.m.Y", strtotime($pool->Rechnungsdatum));

    return response()->json($pool);
  }

  /**
  * Aktualisiert einen Stundenpool anhand der mit Input übergebenen Formulardaten.
  *
  * @param  Request   Input-Daten
  * @param  integer   Übergebene ID des Stundenpools
  * @return response  Success-Meldung JSON-String
  * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
  */
  public function update(Request $request, $id)
  {
    $pool = Pool::find($id);

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
  * Löscht den per ID übergebenen Stundenpool.
  *
  * @param  integer   Übergebene ID des Stundenpools
  * @return response  Success-Meldung JSON-String
  * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
  */
  public function destroy($id)
  {
    Pool::destroy($id);

    return response()->json(['success' => true]);
  }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Article;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Input;
use DateTime;

/**
 * Die ArticleController-Klasse handlet alle Funktionen (Actions), welche über
 * die URL 'api/articles' aufgerufen werden
 */
class ArticleController extends Controller
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
  * Speichert einen neuen Wartungsvertragsartikel. Alle Daten der Eingabefelder
  * werden mit Input als Formularfelder im lokal erzeugten Objekt gespeichert,
  * welches am Schluss in der Datenbank abgelegt wird
  *
  * @return response  Success-Meldung als JSON-String
  * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
  */
  public function store()
  {
    $article = new Article;

    $article->Artikel_Wartungsvertraege_ID = Input::get('Artikel_Wartungsvertraege_ID');
    $article->Artikel_Produkte_ID = Input::get('Artikel_Produkte_ID'); //

    $article->Seriennummer = Input::get('Seriennummer');
    $article->EKP_Artikel = Input::get('EKP_Artikel'); //
    $article->EKP_Artikel_Waehrungen_ID = Input::get('EKP_Artikel_Waehrungen_ID'); //
    $article->VKP_Artikel = Input::get('VKP_Artikel'); //
    $article->VKP_Artikel_Waehrungen_ID = Input::get('VKP_Artikel_Waehrungen_ID'); //

    $article->Auftragsnummer = Input::get('Auftragsnummer'); //
    $article->Auftragsdatum = Input::get('Auftragsdatum'); //
    $article->Rechnungsnummer = Input::get('Rechnungsnummer'); //
    $article->Rechnungsdatum = Input::get('Rechnungsdatum'); //

    $article->Artikel_Maintenance_ID = Input::get('Artikel_Maintenance_ID'); //
    $article->Maintenance_Start = Input::get('Maintenance_Start'); //
    $article->Maintenance_von = Input::get('Maintenance_von'); //
    $article->Maintenance_bis = Input::get('Maintenance_bis'); //
    $article->EKP_Maintenance = Input::get('EKP_Maintenance'); //
    $article->EKP_Maintenance_Waehrungen_ID = Input::get('EKP_Maintenance_Waehrungen_ID'); //
    $article->VKP_Maintenance = Input::get('VKP_Maintenance'); //
    $article->VKP_Maintenance_Waehrungen_ID = Input::get('VKP_Maintenance_Waehrungen_ID');//

    $article->Artikel_Operationsupport_ID = Input::get('Artikel_Operationsupport_ID'); //
    $article->Operationsupport_Start = Input::get('Operationsupport_Start'); //
    $article->Operationsupport_von = Input::get('Operationsupport_von'); //
    $article->Operationsupport_bis = Input::get('Operationsupport_bis');
    $article->VKP_Operationsupport = Input::get('VKP_Operationsupport'); //
    $article->VKP_Operationsupport_Waehrungen_ID = Input::get('VKP_Operationsupport_Waehrungen_ID'); //

    $article->save();

    return response()->json(['success' => true]);
  }

  /**
  * Holt alle Artikel aus der Datenbank, welche zu einem bestimmtem Wartungsvertrag
  * gehören und gibt diese in einem JSON-Array zurück
  * Dabei werden die Methoden product() und manufacturer() der Article- und Product-
  * Models verwendet.
  *
  * @param  integer   Übergebene ID des Wartungsvertrages
  * @return response  Generiertes Array als JSON-String
  * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
  */
  public function show($id)
  {
    $articles = Article::where('Artikel_Wartungsvertraege_ID', $id)->get();
    $json = array();
    $i = 0;

    if(!empty($articles)) {
      foreach($articles as $article) {
        $json[$i]['ID'] = $article->ID;
        $json[$i]['Hersteller'] = $article->product->manufacturer->Name;
        $json[$i]['Produkt'] = $article->product->Name;
        $json[$i]['Seriennummer'] = $article->Seriennummer;
        $i++;
      }
    }

    return response()->json($json);
  }

  /**
  * Es werden die Artikel, welche zu einem bestimmten Produkt gehören, zurückgegeben.
  * Dies dients der Kontrolle, ob ein Produkt gelöscht werden kann oder ob es noch
  * einem Wartungsvertragsartikel zugeordnet ist.
  *
  * @param  integer   ID des Produkts
  * @return response  Artikel-Objekt(e) als JSON-String
  * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
  */
  public function product($id)
  {
    return response()->json(Article::where('Artikel_Produkte_ID', $id)->get());
  }

  /**
  * Lädt den Artikel der übergebenen ID zum Bearbeiten und passt die Daten dem
  * Format des Formulars (TT.MM.JJJJ) an. in der DB sind sie als YYYY-MM-DD gespeichert.
  *
  * @param  integer   ID des zu bearbeitenden Artikels
  * @return response  Artikel-Objekt als JSON-String
  * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
  */
  public function edit($id)
  {
    $article = Article::findOrFail($id);

    // Formatiere das Datum wieder um (die DB gibt YYYY-MM-DD zurück)
    $article->Auftragsdatum = date("d.m.Y", strtotime($article->Auftragsdatum));
    $article->Rechnungsdatum = date("d.m.Y", strtotime($article->Rechnungsdatum));

    $article->Maintenance_Start = date("d.m.Y", strtotime($article->Maintenance_Start));
    $article->Maintenance_von = date("d.m.Y", strtotime($article->Maintenance_von));
    $article->Maintenance_bis = date("d.m.Y", strtotime($article->Maintenance_bis));

    $article->Operationsupport_Start = date("d.m.Y", strtotime($article->Operationsupport_Start));
    $article->Operationsupport_von = date("d.m.Y", strtotime($article->Operationsupport_von));
    $article->Operationsupport_bis = date("d.m.Y", strtotime($article->Operationsupport_bis));

    return response()->json($article);
  }

  /**
  * Aktualisiert einen bearbeiteten Wartungsvertragsartikel anhand der übergebenen
  * Formularwerte, welche dank Request als solche eingelesen und im Objekt gespeichert
  * werden können.
  *
  * @param  Request   Formularwerte
  * @param  integer   ID des Artikels
  * @return response  Success-Meldung als JSON-String
  * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
  */
  public function update(Request $request, $id)
  {
    $article = Article::find($id);

    // Nur notwendige Werte ändern, 'updated_at' wird automatisch aktualisiert
    $article->Artikel_Produkte_ID = $request->input('Artikel_Produkte_ID');

    $article->Seriennummer = $request->input('Seriennummer');
    $article->EKP_Artikel = $request->input('EKP_Artikel');
    $article->EKP_Artikel_Waehrungen_ID = $request->input('EKP_Artikel_Waehrungen_ID');
    $article->VKP_Artikel = $request->input('VKP_Artikel');
    $article->VKP_Artikel_Waehrungen_ID = $request->input('VKP_Artikel_Waehrungen_ID');

    $article->Auftragsnummer = $request->input('Auftragsnummer');
    $article->Auftragsdatum = $request->input('Auftragsdatum');
    $article->Rechnungsnummer = $request->input('Rechnungsnummer');
    $article->Rechnungsdatum = $request->input('Rechnungsdatum');

    $article->Artikel_Maintenance_ID = $request->input('Artikel_Maintenance_ID');
    $article->Maintenance_Start = $request->input('Maintenance_Start');
    $article->Maintenance_von = $request->input('Maintenance_von');
    $article->Maintenance_bis = $request->input('Maintenance_bis');
    $article->EKP_Maintenance = $request->input('EKP_Maintenance');
    $article->EKP_Maintenance_Waehrungen_ID = $request->input('EKP_Maintenance_Waehrungen_ID');
    $article->VKP_Maintenance = $request->input('VKP_Maintenance');
    $article->VKP_Maintenance_Waehrungen_ID = $request->input('VKP_Maintenance_Waehrungen_ID');

    $article->Artikel_Operationsupport_ID = $request->input('Artikel_Operationsupport_ID');
    $article->Operationsupport_Start = $request->input('Operationsupport_Start');
    $article->Operationsupport_von = $request->input('Operationsupport_von');
    $article->Operationsupport_bis = $request->input('Operationsupport_bis');
    $article->VKP_Operationsupport = $request->input('VKP_Operationsupport');
    $article->VKP_Operationsupport_Waehrungen_ID = $request->input('VKP_Operationsupport_Waehrungen_ID');

    $article->save();

    return response()->json(['success' => true]);
  }

  /**
  * Löscht einen Wartungsvertragsartikel per übergebener ID.
  *
  * @param  integer   ID des zu löschenden Wartungsvertragsartikels
  * @return response  Success-Meldung als JSON-String
  * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
  */
  public function destroy($id)
  {
    Article::destroy($id);

    return response()->json(['success' => true]);
  }

}

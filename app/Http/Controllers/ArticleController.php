<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Article;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Input;
use DateTime;

class ArticleController extends Controller
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
  * Display the specified resource.
  *
  * @param  int  $id
  * @return Response
  */
  public function show($id)
  {
    //return response()->json(Article::where('Artikel_Wartungsvertraege_ID', $id)->get()); // ok
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


  public function product($id)
  {
    //return response()->json(Article::where('Artikel_Wartungsvertraege_ID', $id)->get()); // ok
    $articles = Article::where('Artikel_Produkte_ID', $id)->get();

    if($articles) {
      return response()->json(['success' => true]);
    }
    else {
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
    //return response()->json(Article::findOrFail($id));
    $article = Article::findOrFail($id);

    // Formatiere das Datum wieder um (die DB gibt YYYY-MM-DD zurück)
    //$article->Auftragsdatum = Carbon::createFromDate('d.m.Y', $article->Auftragsdatum);
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
  * Update the specified resource in storage.
  *
  * @param  Request  $request
  * @param  int  $id
  * @return Response
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

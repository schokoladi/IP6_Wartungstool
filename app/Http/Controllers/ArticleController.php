<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Article;

use App\Http\Requests;
use App\Http\Controllers\Controller;
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
        $json[$i]['Hersteller'] = $article->product->manufacturer->Name;
        $json[$i]['Produkt'] = $article->product->Name;
        $json[$i]['Seriennummer'] = $article->Seriennummer;
        $i++;
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
    //
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

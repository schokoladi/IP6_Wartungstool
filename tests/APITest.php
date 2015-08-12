<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
* Die APITest-Klasse enthält Tests zur überprüfung der vom Backend definierten
* REST-APIs
*/
class APITest extends TestCase
{

  /**
  * Mit testProductAPI wird kontrolliert, ob beim Aufruf der product-API ein Fehler
  * zurückgegeben wird, da kein Token gesetzt ist.
  */
  public function testProductAPI()
  {
    $this->get('/api/products')
      ->seeJsonEquals([
        'error' => 'token_not_provided'
      ]);
  }

  /**
  * Mit testContractAPI wird kontrolliert, ob beim Aufruf der contract-API ein Fehler
  * zurückgegeben wird, da kein Token gesetzt ist.
  */
  public function testContractAPI()
  {
    $this->get('/api/contracts')
      ->seeJsonEquals([
        'error' => 'token_not_provided'
      ]);
  }

  /**
  * Mit testArticleAPI wird kontrolliert, ob beim Aufruf der article-API ein Fehler
  * zurückgegeben wird, da kein Token gesetzt ist.
  */
  public function testArticleAPI()
  {
    $this->get('/api/articles')
      ->seeJsonEquals([
        'error' => 'token_not_provided'
      ]);
  }

}

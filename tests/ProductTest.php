<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use DateTime;

class ProductTest extends TestCase
{

  // Die Middleware für den Test der API ausgeschaltet
  use WithoutMiddleware;
  // besser?
  //use DatabaseTransactions;
  //use DatabaseMigrations;

  /**
  * A basic functional test example.
  *
  * @return void
  */
  public function testStoreProduct()
  {
    $this->post('/api/products',
      [
        'Name' => 'Trinzic Testprodukt',
        'Artikelnummer' => 'TE-TEST-1234',
        'Produkte_Hersteller_ID' => '3',
        'created_at' => new DateTime,
        'updated_at' => new DateTime
      ])
      // Rückmeldung überprüfen
      ->seeJson(['success' => true]);
  }

  public function testGetProducts()
  {
    $this->get('/api/products')
      ->seeJson([
        'Artikelnummer' => 'IB-1102-A-MRI',
        'Name' => 'Trinzic Testprodukt',
        'Artikelnummer' => 'TE-TEST-1234',
        'Hersteller' => 'Infoblox'
      ]);
    // Höchste ID holen funktioniert,
    // kann aber in anderen Testfunktionen nicht genutzt werden
  }

  public function testShowProduct()
  {
    // Hersteller-ID wird übergeben
    $this->get('/api/products/3')
      ->seeJson([
        'Artikelnummer' => 'IB-1102-A-MRI',
        'Name' => 'Trinzic Testprodukt',
        'Artikelnummer' => 'TE-TEST-1234',
        'Produkte_Hersteller_ID' => 3
      ]);
  }
  
  public function testDestroyProduct()
  {
    $productIdMax = 0;
    $res = $this->call('GET', '/api/products');
    $data = json_decode($res->getContent());
    foreach($data as $product)
    {
      ($product->ID > $productIdMax) ? $productIdMax = $product->ID: $productIdMax = $productIdMax; // returns true
    }
    $this->delete('/api/products/'. $productIdMax)
      // Rückmeldung überprüfen
      ->seeJson(['success' => true]);
  }
}

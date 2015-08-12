<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use DateTime;

/**
 * Die ProductTest-Klasse enthält Methoden zum Testen der product-APIs
 */
class ProductTest extends TestCase
{

  // Die Middleware für den Test der API ausgeschaltet, damit die API ohne Token
  // verwendet werden können
  use WithoutMiddleware;

  /**
   * Ein JSON-Objekt mit einem Produkt wird erstellt und via API versucht zu speichern.
   * Die Rückmeldung kann mit seeJson() getestet werden
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

  /**
   * testGetProducts überprüft, ob das eben erstellte Produkt in der Produktabfrage
   * via API vorhanden ist (mit seeJson).
   */
  public function testGetProducts()
  {
    $this->get('/api/products')
      ->seeJson([
        'Artikelnummer' => 'IB-1102-A-MRI',
        'Name' => 'Trinzic Testprodukt',
        'Artikelnummer' => 'TE-TEST-1234',
        'Hersteller' => 'Infoblox'
      ]);
  }

  /**
   * Testet, ob das erstellte Produkt unter dem Hersteller, dessen ID per API übergeben
   * wird, vorhanden ist.
   */
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

  /**
   * Prüft, ob das Löschen eines Produkts via API funktioniert.
   * Dafür wird die ID des neusten (eben erstellten) Produkts geholt und als
   * Parameter übergeben.
   */
  public function testDestroyProduct()
  {
    $productIdMax = 0;
    $res = $this->call('GET', '/api/products');
    $data = json_decode($res->getContent());
    foreach($data as $product)
    {
      ($product->ID > $productIdMax) ? $productIdMax = $product->ID: $productIdMax = $productIdMax;
    }
    $this->delete('/api/products/'. $productIdMax)
      // Rückmeldung überprüfen
      ->seeJson(['success' => true]);
  }

}

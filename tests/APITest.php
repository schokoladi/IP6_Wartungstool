<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class APITest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testProductAPI()
    {
        $this->get('/api/products')
          ->seeJsonEquals([
            'error' => 'token_not_provided'
          ]);
    }

    public function testContractAPI()
    {
        $this->get('/api/contracts')
          ->seeJsonEquals([
            'error' => 'token_not_provided'
          ]);
    }

    public function testContractAPI()
    {
        $this->get('/api/contracts')
          ->seeJsonEquals([
            'error' => 'token_not_provided'
          ]);
    }
}

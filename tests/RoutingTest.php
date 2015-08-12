<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Die RoutingTest-Klasse prüft, ob man über eine bestimmte URL auf die gewünschte
 * Seite gelangt.
 */
class RoutingTest extends TestCase
{
    /**
    * Testet die Login Route. Mit see() wird kontrolliert, was auf der Seite
    * angezeigt wird.
    */
    public function testLoginRoute()
    {
        $this->visit('/#/login')
            ->see('Login');
    }

}

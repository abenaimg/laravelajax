<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
     public function testRegister()
     {
           $this->visit('/')
                ->click('Login')
                ->type('toto@chez.fr', 'email')
                ->type('password', 'password')
                ->press('Login')
                ->see('Dashboard');
     }
}

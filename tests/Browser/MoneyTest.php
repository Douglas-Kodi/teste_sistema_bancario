<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class MoneyTest extends DuskTestCase
{
    /** @test */
    public function check_if_register_money_function_is_working()
    {
        $this->browse(function (Browser $browser){
            $browser->visit('/moneys/11')
                ->type('valor', '1500')
                ->type('password', '123456')
                ->press('Realizar a transição')
                ->assertPathIs('/users/11')
                ->assertSee('Controle de dados');
        });
    }

    /** @test */
    public function check_if_release_money_function_is_working()
    {
        $this->browse(function (Browser $browser){
            $browser->visit('/users/11')
                ->assertSee('156.304.000-02')
                ->assertSee('R$ 1.500');
        });
    }


}

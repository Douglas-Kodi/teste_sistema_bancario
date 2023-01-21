<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UserTest extends DuskTestCase
{
    /** @test */
    public function check_if_register_user_function_is_working()
    {
        $this->browse(function (Browser $browser){
            $browser->visit('/users/create')
                ->type('name', 'User Tester')
                ->type('cpf', '156.304.000-02')
                ->type('email', 'test@test.com')
                ->type('password', '123456')
                ->type('password2', '123456')
                ->press('Adicionar')
                ->assertPathIs('/users')
                ->assertSee('Tabela de Usuário');
        });
    }

    /** @test */
    public function check_if_update_user_function_is_working()
    {
        $this->browse(function (Browser $browser){
            $browser->visit('/users/11/edit')
                ->type('name', 'User Test')
                ->type('cpf', '156.304.000-02')
                ->type('email', 'test@test.com')
                ->type('password', '123456')
                ->type('password2', '123456')
                ->press('Alterar')
                ->assertPathIs('/users/11/edit')
                ->assertSee('Alterar Conta');
        });
    }

    /** @test */
    public function check_if_release_user_function_is_working()
    {
        $this->browse(function (Browser $browser){
            $browser->visit('/users/11')
                ->assertSee('User Test')
                ->assertSee('156.304.000-02');
        });
    }

    /** @test */
    public function check_if_delete_user_function_is_working()
    {
        $this->browse(function (Browser $browser){
            $browser->visit('/users') 
                ->press('Deletar')
                ->waitForDialog()
                ->assertDialogOpened('Deseja mesmo apagar?')
                ->acceptDialog()
                ->assertPathIs('/users')
                ->assertSee('Tabela de Usuário');
        });
    }
}

<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\ModelUser;
use App\Models\ModelMoney;

class ModelTest extends TestCase
{
    /** @test */
    public function check_user()
    {
        $user = new ModelUser;

        $expected = [
            'numcc',
            'name',
            'cpf',
            'email',
            'password'
        ];

        $arrayCompared = array_diff($expected, $user->getFillable());

        $this->assertEquals(0, count($arrayCompared));
    }

    /** @test */
    public function check_money()
    {
        $money = new ModelMoney;

        $expected = [
            'id_numcc',
            'type',
            'valor'
        ];

        $arrayCompared = array_diff($expected, $money->getFillable());

        $this->assertEquals(0, count($arrayCompared));
    }
}

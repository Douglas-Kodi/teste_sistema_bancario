<?php

namespace Database\Seeders;

use App\Models\ModelMoney;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MoneySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelMoney::factory(30)->create();
    }
}

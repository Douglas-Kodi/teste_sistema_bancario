<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ModelUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'numcc' => rand(1000000000000000, 9999999999999999),
            'name' => Str::random(10),
            'cpf' => rand(10000000000, 99999999999),
            'email' => Str::random(10),
            'password' => '123456',
        ];
    }
}

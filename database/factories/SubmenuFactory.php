<?php

namespace Database\Factories;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SubmenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $array = [1, 2, 3, 4, 5];
        $bool = [0, 1];

        return [
            'menu_id' => Arr::random($array),
            'name' => fake()->citySuffix(),
            'position' => Arr::random($array),
            'is_active' => Arr::random($bool)
        ];
    }
}
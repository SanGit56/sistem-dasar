<?php

namespace Database\Factories;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class LogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $array = [1, 2, 3, 4, 5];

        return [
            'user_id' => Arr::random($array),
            'description' => fake()->realText($maxNbChars = 64, $indexSize = 2)
        ];
    }
}

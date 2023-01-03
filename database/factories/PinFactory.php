<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pin>
 */
class PinFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $word = fake()->word();
        return [
            'user_id' => \App\Models\User::inRandomOrder()->first()->id,
            'status'  => fake()->randomElement(['published', 'draft']),
            'title'   => $word,
            'slug'    => \Str::slug($word),
            'short_description' => fake()->sentence(),
            'description' => fake()->paragraph(),

        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MessagesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
         'name'=>fake()->name(),
         'email'=>fake()->email(),
         'message'=>fake()->text('350'),
          'user_id'=>fake()->numberBetween(1,13),
            'created_at' => now(),
            'updated_at' => now(),
            ];
    }
}

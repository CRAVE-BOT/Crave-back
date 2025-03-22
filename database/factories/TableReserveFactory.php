<?php

namespace Database\Factories;

use App\Models\Table;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TableReserve>
 */
class TableReserveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'table_id' => $this->faker->randomElement([37,38,39,40,41,42,43,44]),
            'user_id'  => $this->faker->numberBetween(1, 27),
            'date'     => $this->faker->dateTimeBetween('2024-01-01', '2024-12-31')->format('Y-m-d'),
            'the_time' => $this->faker->dateTimeBetween('12:00:00', '23:59:59')->format('H:i:s'),
            'Number_people' => $this->faker->numberBetween(1, 10),
        ];

    }
}

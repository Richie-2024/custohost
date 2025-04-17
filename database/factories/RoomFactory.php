<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    protected $model = Room::class;

    public function definition(): array
    {
        return [
            'room_number' => $this->faker->unique()->numberBetween(100, 999),
            'type' => $this->faker->randomElement(['single', 'double', 'suite']),
            'capacity' => $this->faker->numberBetween(1, 4),
            'price' => $this->faker->randomFloat(2, 100, 1000),
            'status' => $this->faker->randomElement(['available', 'occupied', 'maintenance']),
            'description' => $this->faker->sentence,
            'amenities' => json_encode($this->faker->randomElements(['wifi', 'tv', 'desk', 'ac'], 2)),
            'hostel_id' => null, // to be set in seeder
        ];
    }
}

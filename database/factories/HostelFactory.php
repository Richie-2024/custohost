<?php

namespace Database\Factories;

use App\Models\Hostel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class HostelFactory extends Factory
{
    // Define the model the factory is for
    protected $model = Hostel::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'address' => $this->faker->address,
            'description' => $this->faker->paragraph,
            'photo' => $this->faker->imageUrl(640, 480), // URL of a random image
            'owner_id' => User::factory(), // Create a new User (owner)
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'total_rooms' => $this->faker->numberBetween(10, 50), // Random number of rooms
            'available_rooms' => $this->faker->numberBetween(5, 40), // Random number of available rooms
        ];
    }
}

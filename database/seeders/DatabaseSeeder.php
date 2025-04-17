<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Hostel;
use App\Models\Room;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles
        $roles = ['admin', 'student', 'hostel_manager'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Create users
        $student = User::factory()->create([
            'name' => 'Student Oscar',
            'email' => 'student@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $student->assignRole('student');

        $admin = User::factory()->create([
            'name' => 'Admin Oscar',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $admin->assignRole('admin');

        $manager = User::factory()->create([
            'name' => 'Manager Mike',
            'email' => 'manager@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $manager->assignRole('hostel_manager');

        // Create hostels with rooms
        Hostel::factory(5)->create(['owner_id' => $manager->id])->each(function ($hostel) {
            $roomCount = rand(3, 10);

            Room::factory($roomCount)->create([
                'hostel_id' => $hostel->id
            ]);

            $hostel->total_rooms = $roomCount;
            $hostel->available_rooms = $roomCount;
            $hostel->save();
        });
    }
}

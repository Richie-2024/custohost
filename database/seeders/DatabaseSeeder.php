<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $roles=[
            'admin',
            'student',
            'hostel_manager',
        ];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }
      ;

      $user1=  User::factory()->create([
            'name' => 'Student Oscar',
            'email' => 'student@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
      $user1->assignRole('student');
      $user2=  User::factory()->create([
            'name' => 'Admin Oscar',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $user2->assignRole('hostel_manager');
   

    }
}

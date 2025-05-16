<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'supervisor']);

        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@empaku.com',
            'password' => Hash::make('12345678')
        ]);

        $user->assignRole('admin');
    }
}

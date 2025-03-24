<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'nomor_telepon' => '08123456789',
            'password' => Hash::make('admin123'), // Hashing password

        ]);
        
        $genres = [
            ['title' => 'Drama', 'slug' => 'drama'],
            ['title' => 'Romance', 'slug' => 'romance'],
            ['title' => 'Fantasi', 'slug' => 'fantasi'],
            ['title' => 'Horror', 'slug' => 'horror'],
            ['title' => 'Action', 'slug' => 'action'],
            ['title' => 'Sci-Fi', 'slug' => 'sci-fi'],
            ['title' => 'Adventure', 'slug' => 'adventure'],
            ['title' => 'Thriller', 'slug' => 'thriller'],
            ['title' => 'Crime', 'slug' => 'crime'],
            ['title' => 'Comedy', 'slug' => 'Comedy'],
        ];
        
        foreach ($genres as $genre) {
            Genre::firstOrCreate($genre);
        }
        
    }
}

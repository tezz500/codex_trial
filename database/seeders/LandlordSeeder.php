<?php

namespace Database\Seeders;

use App\Models\Landlord;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LandlordSeeder extends Seeder
{
    public function run(): void
    {
        Landlord::firstOrCreate(
            ['email' => 'landlord@example.com'],
            [
                'name' => 'Default Landlord',
                'password' => Hash::make('password'),
            ]
        );
    }
}

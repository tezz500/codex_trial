<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\TenantUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TenantSeeder extends Seeder
{
    public function run(): void
    {
        $tenant = Tenant::firstOrCreate(
            ['slug' => 'acme'],
            ['name' => 'Acme Inc.']
        );

        TenantUser::firstOrCreate(
            [
                'tenant_id' => $tenant->id,
                'email' => 'user@acme.test',
            ],
            [
                'name' => 'Acme User',
                'password' => Hash::make('password'),
            ]
        );
    }
}

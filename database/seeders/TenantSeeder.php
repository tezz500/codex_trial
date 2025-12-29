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
        $landlordDomain = config('tenancy.landlord_domain');
        $tenantDomain = $landlordDomain ? 'acme.'.$landlordDomain : 'acme.test';

        $tenant = Tenant::firstOrCreate(
            ['slug' => 'acme'],
            [
                'name' => 'Acme Inc.',
                'domain' => $tenantDomain,
                'db_host' => '127.0.0.1',
                'db_database' => 'tenant_acme',
                'db_username' => 'tenant_user',
                'db_password' => 'secret',
            ]
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

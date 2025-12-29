<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tenants', function (Blueprint $table): void {
            $table->string('domain')->nullable()->after('slug');
            $table->string('db_host')->nullable()->after('domain');
            $table->string('db_database')->nullable()->after('db_host');
            $table->string('db_username')->nullable()->after('db_database');
            $table->string('db_password')->nullable()->after('db_username');
        });
    }

    public function down(): void
    {
        Schema::table('tenants', function (Blueprint $table): void {
            $table->dropColumn(['domain', 'db_host', 'db_database', 'db_username', 'db_password']);
        });
    }
};

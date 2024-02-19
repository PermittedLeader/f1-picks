<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Role::create([
            'name'=>'Super Admin'
        ]);
        Role::create([
            'name'=> 'League Administrator'
        ]);
        Role::create([
            'name'=>'User'
        ]);
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Role::findByName('Super Admin')->delete();
        Role::findByName('League Administrator')->delete();
        Role::findByName('User')->delete();
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
    }
};

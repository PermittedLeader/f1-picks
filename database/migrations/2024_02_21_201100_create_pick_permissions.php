<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    public $permissions = [
        'list picks' => 'User',
        'view picks' => 'User',
        'create picks' => 'League Administrator',
        'edit picks' => 'League Administrator',
        'delete picks' => 'Super Admin',
        'restore picks' => 'Super Admin',
        'forceDelete picks' => 'Super Admin'
    ];

    public function assignPermissions(string|array $roles){
        $roles = collect($roles);
        foreach($roles as $role){
            Role::findByName($role)->
            givePermissionTo(
                array_keys(array_filter(
                    $this->permissions,
                    function($value)use($role){
                        return $value == $role;
                    }
                ))
            );
        }
    }

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        foreach($this->permissions as $permission => $users){
            Permission::create(['name'=>$permission]);
        };
        $this->assignPermissions(['Super Admin','League Administrator','User']);
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach($this->permissions as $permission){
            Permission::findByName($permission)->delete();
        }
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
    }
};

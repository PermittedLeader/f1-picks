<?php

use App\Models\League;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('leagues', function (Blueprint $table) {
            $table->string('slug')->default();
            $table->boolean('public')->default(false);
            $table->string('password')->default(Str::random());
        });

        foreach(League::all() as $league){
            $league->update([
                'slug'=>Str::slug($league->name)
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leagues', function (Blueprint $table) {
            $table->dropColumn(['slug','public','password']);
        });
    }
};

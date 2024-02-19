<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pickables', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('team')->nullable()->default(null);
            $table->string('avatar')->nullable()->default(null);
            $table->timestamps(6);
            $table->softDeletesTz('deleted_at',6);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pickables');
    }
};

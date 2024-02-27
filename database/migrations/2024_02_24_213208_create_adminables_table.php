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
        Schema::create('adminables', function (Blueprint $table) {
            $table->id();
            $table->string('adminable_type');
            $table->foreignId('adminable_id');
            $table->foreignId('user_id')->constrained();
        });
        Schema::dropIfExists('event_admins');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adminables');
    }
};

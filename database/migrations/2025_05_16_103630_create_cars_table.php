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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('transmission', ['manual', 'otomatis', 'semi_otomatis']);
            $table->boolean('status')->default(true);
            $table->integer('seat')->default(5);
            $table->integer('cost')->default(0);
            $table->string('image')->default('https://kzmqzswrwee5icmdcac3.lite.vusercontent.net/placeholder.svg');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};

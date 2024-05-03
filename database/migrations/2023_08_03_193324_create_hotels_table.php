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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // $table->string('excerpt')->nullable();
            // $table->string('description')->nullable();
            // $table->string('note')->nullable();
            $table->longText('google_map');
            $table->boolean('display')->default(false);
            $table->boolean('displayPrice')->default(false);
            $table->string('city');
            $table->integer('commision')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};

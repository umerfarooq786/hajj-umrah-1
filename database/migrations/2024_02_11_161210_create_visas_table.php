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
        Schema::create('visas', function (Blueprint $table) {
            $table->id();
            $table->decimal('hajj_charges', 10, 2)->nullable();
            $table->decimal('umrah_charges', 10, 2)->nullable();
            $table->string('current_currency')->nullable();
            $table->boolean('show_hajj')->default(false);
            $table->integer('umrah_commision')->default(0);
            $table->integer('hajj_commision')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visas');
    }
};

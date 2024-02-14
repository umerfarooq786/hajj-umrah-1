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
        Schema::create('currency_conversions', function (Blueprint $table) {
            $table->id();
            $table->double('sar_to_usd', 8, 2);
            $table->double('sar_to_pkr', 8, 2);
            $table->string('default_currency')->default('sar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currency_conversions');
    }
};

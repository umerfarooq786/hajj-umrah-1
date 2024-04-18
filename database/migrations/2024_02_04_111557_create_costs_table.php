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
        Schema::create('costs', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('item_id');
            $table->string('item_type');
            $table->decimal('cost', 10, 2);
            $table->date('validity')->nullable();
            $table->date('validity_start');
            $table->date('validity_end');
            $table->timestamps();

            $table->index(['item_id', 'item_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('costs');
    }
};

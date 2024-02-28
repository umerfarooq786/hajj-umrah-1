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
        Schema::create('hotel_special_offer_rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('package_id');
            $table->unsignedBigInteger('room_id');
            $table->decimal('price', 6, 2);
            $table->timestamps();

            // Define foreign key with cascade delete for package_id
            $table->foreign('package_id')
                ->references('id')
                ->on('hotel_special_offers')
                ->onDelete('cascade'); // Cascade delete

            // Define foreign key with cascade delete for room_id
            $table->foreign('room_id')
                ->references('id')
                ->on('rooms')
                ->onDelete('cascade'); // Cascade delete
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_special_offer_rooms');
    }
};

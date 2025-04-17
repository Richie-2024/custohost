<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hostel_id')->constrained()->onDelete('cascade');
            $table->string('room_number');
            $table->enum('type', ['single', 'double', 'triple', 'quad']);
            $table->integer('capacity');
            $table->decimal('price', 10, 2);
            $table->enum('status', ['available', 'occupied', 'maintenance'])->default('available');
            $table->text('description')->nullable();
            $table->json('amenities')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['hostel_id', 'room_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
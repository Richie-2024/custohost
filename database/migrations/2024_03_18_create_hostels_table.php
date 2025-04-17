<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hostels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
            $table->string('name');
            $table->text('address');
            $table->text('description')->nullable();
            $table->string('photo')->nullable();
            $table->enum('status', ['active', 'inactive', 'maintenance'])->default('active');
            $table->integer('total_rooms')->default(0);
            $table->integer('available_rooms')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hostels');
    }
};
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->unique()->nullable(); // Phone number (nullable for optional)
            $table->enum('sex', ['M', 'F'])->nullable(); // Sex: M for male, F for female
            $table->date('birthdate')->nullable(); // Birthdate
            $table->string('address')->nullable(); // Address
            $table->string('profile_image')->nullable(); // Profile image URL
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'sex', 'birthdate', 'address', 'profile_image']);
        });
    }
}

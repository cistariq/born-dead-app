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
        Schema::create('martyrs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_no')->unique();
            $table->string('name');
            $table->foreignId('hospital_id')->nullable()->constrained('constants')->nullOnDelete();
            $table->dateTime('Date_martyrdom');
            $table->string('cause_death')->nullable();
            $table->foreignId('insert_user_id')->constrained('users');
            $table->text('notes')->nullable();
            $table->foreignId('cause_death_id')->nullable()->constrained('constants')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('martyrs');
    }
};

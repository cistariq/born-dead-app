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
        Schema::create('citizens', function (Blueprint $table) {
            $table->id();
            $table->integer('id_no')->unique();
            $table->string('first_name');
            $table->string('second_name');
            $table->string('third_name');
            $table->string('last_name');
            $table->date('DOB')->nullable();
            $table->tinyInteger('gender')->default(1)->comment('1 => male,   2 =>female ');
            $table->foreignId('nationality_id')->nullable()->constrained('constants')->nullOnDelete();
            $table->foreignId('social_status_id')->nullable()->constrained('constants')->nullOnDelete();
            $table->foreignId('religion_id')->nullable()->constrained('constants')->nullOnDelete();
            $table->foreignId('region_id')->nullable()->constrained('constants')->nullOnDelete();
            $table->foreignId('city_id')->nullable()->constrained('constants')->nullOnDelete();
            $table->foreignId('insert_user_id')->constrained('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citizens');
    }
};

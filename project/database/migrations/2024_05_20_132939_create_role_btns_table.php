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
        Schema::create('role_btns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('follow_to_page')
                ->constrained('role_pages','id');
            $table->text('notes')->nullable();
            $table->foreignId('insert_user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_btns');
    }
};

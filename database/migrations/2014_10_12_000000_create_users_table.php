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
        Schema::create('users', function (Blueprint $table) {
            $table->id('us_ID');
            $table->foreignId('role_id')->nullable();
            $table->string('us_name');
            $table->string('us_username');
            $table->string('avatar')->nullable();
            $table->string('us_gender')->nullable();
            $table->integer('us_age')->nullable();
            $table->string('us_email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->dateTime('password_updated_at');
            $table->string('us_stat')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

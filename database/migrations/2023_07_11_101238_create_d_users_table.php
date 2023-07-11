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
        /***username
            email
            first_name
            last_name
            is_admin 0/1(0=>user, 1=>admin), default 0
            is_active 0/1(0=>inactive, 1=>active), default 1
            password*
            timestamps
         */
        Schema::create('d_users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('email');
            $table->string('first_name', 20);
            $table->string('last_name', 20);
            $table->binary('is_admin')->default(0);
            $table->binary('is_active')->default(1);
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('d_users');
    }
};

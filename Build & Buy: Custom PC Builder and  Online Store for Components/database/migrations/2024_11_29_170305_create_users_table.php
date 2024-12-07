<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->string('name');  // User's name
            $table->string('email')->unique();  // Unique email for login
            $table->string('password');  // User's password
            $table->string('role')->default('customer');  // Role (admin, customer, etc.)
            $table->string('phone_number')->nullable();  // Phone number
            $table->text('address')->nullable();  // Shipping address
            $table->rememberToken();  // For "remember me" functionality
            $table->timestamps();  // Created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

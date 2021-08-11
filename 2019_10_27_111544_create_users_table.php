<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
			$table->string('email');
			$table->string('username');
			$table->string('password');
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('location')->nullable();
			$table->string('avatar')->default('user.jpg');
			$table->string('state')->nullable();
			$table->string('zip')->nullable();
			$table->string('status')->nullable();
			$table->string('gender')->nullable();
			$table->string('service_state')->nullable();
			$table->string('plateau')->nullable();
			$table->string('remember_token')->nullable();
            $table->timestamps();
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

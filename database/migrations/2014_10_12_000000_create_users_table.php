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
            $table->id();
            $table->string('name');
            $table->string('role')->default('client');
            $table->string('email')->unique();
            $table->string('number')->nullable();
            $table->string('image')->nullable();
            $table->string('reg_no')->nullable();
            $table->string('natnal_id')->nullable();
            $table->string('dob')->nullable();
            $table->string('certificate')->nullable();
            $table->string('certificate_2')->nullable();
            $table->string('specialty')->nullable();
            $table->string('experience')->nullable();
            $table->string('chember_address')->nullable();
            $table->string('address')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('status')->default('active');
            $table->date('last_login')->nullable();
            $table->integer('review')->default(0);
            $table->double('rat')->default(0,00);
            $table->string('lawyer_type')->nullable();
            $table->integer('is_verified')->nullable();
            $table->rememberToken();
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesAbilitiesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('descr');
            $table->timestamps();
        });

        Schema::create('abilities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('descr');
            $table->timestamps();
        });

        Schema::create('ability_role', function (Blueprint $table) {
            $table->primary((['ability_id','role_id']));
            $table->foreignId('ability_id');
            $table->foreignId('role_id');
            $table->timestamps();

            $table->foreign('ability_id')->references('id')->on('abilities')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });

        Schema::create('role_user', function (Blueprint $table) {
            $table->primary((['role_id','user_id']));
            $table->foreignId('role_id');
            $table->foreignId('user_id');
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
        Schema::dropIfExists('abilities');
        Schema::dropIfExists('ability_role');
        Schema::dropIfExists('role_user');
    }
}

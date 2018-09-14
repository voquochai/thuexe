<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username',50)->nullable();
            $table->string('password');
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->string('address')->nullable();
            $table->integer('district_id')->default(0);
            $table->integer('province_id')->default(0);
            $table->string('image')->nullable();
            $table->string('oauth_id',50)->nullable();
            $table->string('oauth_provider',50)->nullable();
            $table->integer('priority')->default(1);
            $table->string('status',100)->default('publish');
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
        Schema::dropIfExists('members');
    }
}

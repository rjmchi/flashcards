<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userlists', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('word');
            $table->string('definition');
            $table->integer('group_id')->default(0);
            $table->boolean('learned')->defult(false);
            $table->boolean('learned_english')->default(false);
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
        Schema::dropIfExists('userlists');
    }
}

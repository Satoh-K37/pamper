<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('recipe_title');
            $table->text('content');
            $table->bigInteger('serving');
            $table->string('ingredient');
            $table->string('seasoning');
            $table->string('step_content');
            $table->string('step_content2');
            $table->string('step_content3');
            $table->string('step_content4');
            $table->string('step_content5');
            $table->string('step_content6');
            $table->string('cooking_point');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('recipes');
    }
}

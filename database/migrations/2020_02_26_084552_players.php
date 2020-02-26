<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Players extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid');
            $table->integer('player_id');
            $table->string('first_name', 100);
            $table->string('second_name', 100);
            $table->string('form', 100);
            $table->string('total_points', 100);
            $table->string('influence', 100);
            $table->string('creativity', 100);
            $table->string('threat', 100);
            $table->string('ict_index', 100);
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
        Schema::dropIfExists('players');
    }
}

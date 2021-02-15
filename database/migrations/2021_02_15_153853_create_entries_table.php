<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entries', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('competition_id');
            $table->unsignedInteger('competitor_id');
            $table->timestamp('start')->nullable();
            $table->timestamp('finish')->nullable();
            $table->timestamps();

            $table->foreign('competition_id')->references('id')->on('competitions');
            $table->foreign('competitor_id')->references('id')->on('competitor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entries');
    }
}

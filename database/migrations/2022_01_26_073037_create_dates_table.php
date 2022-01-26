<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dates', function (Blueprint $table) {
            $table->id();
            $table->string('year')->unique();
            $table->text('_1');
            $table->text('_2');
            $table->text('_3');
            $table->text('_4');
            $table->text('_5');
            $table->text('_6');
            $table->text('_7');
            $table->text('_8');
            $table->text('_9');
            $table->text('_10');
            $table->text('_11');
            $table->text('_12');
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
        Schema::dropIfExists('dates');
    }
}

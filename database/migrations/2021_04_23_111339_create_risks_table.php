<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRisksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('risks', function (Blueprint $table) {
            $table->id();
            $table->longText('operation');
            $table->longText('hazard');
            $table->longText('risk');
            $table->text('at_risk');
            $table->unsignedBigInteger('pre_probability');
            $table->unsignedBigInteger('post_probability');
            $table->unsignedBigInteger('pre_severity');
            $table->unsignedBigInteger('post_severity');
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
        Schema::dropIfExists('risks');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMethodRiskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('method_risk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order');
            $table->unsignedBigInteger('method_id');
            $table->unsignedBigInteger('risk_id');
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
        Schema::dropIfExists('method_risk');
    }
}

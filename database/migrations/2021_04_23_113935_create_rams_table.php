<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('rams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job');
            $table->text('site');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('method_id');
            $table->unsignedBigInteger('prelim_id');
            $table->unsignedBigInteger('setup_id');
            $table->date('works_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('rams');
    }
}

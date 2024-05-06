<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('file');
            $table->string('poster')->default('');
            $table->string('preview')->default('');
            $table->unsignedBigInteger('portfolio_id');
            $table->unsignedBigInteger('direction_id');
            $table->timestamps();
        });

        Schema::table('media', function (Blueprint $table){
           $table->foreign('portfolio_id')->references('id')->on('portfolios');
           $table->foreign('direction_id')->references('id')->on('directions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media');
    }
};

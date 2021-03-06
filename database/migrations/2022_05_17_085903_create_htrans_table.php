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
        Schema::create('htrans', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('pasar_id')->reference();
            $table->string('user_id')->reference();
            $table->string('stand_id')->reference();
            $table->string('transportasi');
            $table->bigInteger('total_jumlah');
            $table->bigInteger('total_harga')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('htrans');
    }
};

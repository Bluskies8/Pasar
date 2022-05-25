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
        Schema::create('dtrans', function (Blueprint $table) {
            $table->id();
            $table->string('htrans_id')->reference();
            $table->string('kode');
            $table->string('nama_barang');
            $table->integer('jumlah');
            $table->double('bruto');
            $table->integer('round');
            $table->integer('netto');
            $table->integer('parkir');
            $table->bigInteger('subtotal');
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
        Schema::dropIfExists('dtrans');
    }
};

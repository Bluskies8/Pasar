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
            $table->string('nama_barang');
            $table->string('tipe_berat');
            $table->integer('jumlah');
            $table->integer('harga');
            $table->bigInteger('subtotal');
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
        Schema::dropIfExists('dtrans');
    }
};

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
        Schema::create('retribusis', function (Blueprint $table) {
            $table->id();
            $table->string('pasar_id')->referenced();
            $table->string('retribusi');
            $table->string('listrik');
            $table->string('kuli');
            $table->string('sampah');
            $table->string('ponten_siang');
            $table->string('ponten_malam');
            $table->string('parkir_siang');
            $table->string('parkir_malam');
            $table->string('motor_siang');
            $table->string('motor_malam');
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
        Schema::dropIfExists('retribusis');
    }
};

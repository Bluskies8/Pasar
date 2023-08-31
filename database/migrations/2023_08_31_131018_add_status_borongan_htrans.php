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
        Schema::table('htrans', function (Blueprint $table) {
            $table->tinyInteger('status_borongan')
                ->default(0)
                ->after('total_harga');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('htrans', function (Blueprint $table) {
            $table->dropColumn('status_borongan');
        });
    }
};

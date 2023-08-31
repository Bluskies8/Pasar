<?php

namespace Database\Seeders;

use App\Models\transportasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransportasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        transportasi::create([
            "nama" => "gratis",
            'value' =>'0',
        ]);
        transportasi::create([
            "nama" => "motor",
            'value' =>'3000',
        ]);
        transportasi::create([
            "nama" => "mobil",
            'value' =>'5000',
        ]);
        transportasi::create([
            "nama" => "pick up",
            'value' =>'10000',
        ]);
        transportasi::create([
            "nama" => "truck engkel",
            'value' =>'20000',
        ]);
        transportasi::create([
            "nama" => "truck container",
            'value' =>'50000'
        ]);
    }
}

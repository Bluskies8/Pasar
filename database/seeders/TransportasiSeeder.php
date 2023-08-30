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
            'value' =>'0',
        ]);
        transportasi::create([
            'value' =>'3000',
        ]);
        transportasi::create([
            'value' =>'5000',
        ]);
        transportasi::create([
            'value' =>'10000',
        ]);
        transportasi::create([
            'value' =>'20000',
        ]);
        transportasi::create([
            'value' =>'50000'
        ]);
    }
}

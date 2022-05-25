<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\stand;
use Illuminate\Database\Seeder;

class StandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //stand 35
        stand::create([
            'no_stand' => '01',
            'seller_name' => 'Mario',
            'Phone' => '123456789',
            'jenis_jualan' => "salak"
        ]);
        stand::create([
            'no_stand' => '02',
            'seller_name' => 'toni',
            'Phone' => '123456789',
            'jenis_jualan' => "apel"
        ]);
        stand::create([
            'no_stand' => '03',
            'seller_name' => 'michael',
            'Phone' => '123456789',
            'jenis_jualan' => "jeruk"
        ]);
    }
}

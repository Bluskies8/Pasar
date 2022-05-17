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
        stand::create([
            'seller_name' => 'Mario',
            'Phone' => '123456789',
            'jenis_jualan' => "salak"
        ]);
    }
}

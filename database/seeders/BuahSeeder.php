<?php

namespace Database\Seeders;

use App\Models\buah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BuahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        buah::create(['name'=>"jeruk"]);
        buah::create(['name'=>"mangga"]);
        buah::create(['name'=>"jeruk import"]);
        buah::create(['name'=>"mangga import"]);
        buah::create(['name'=>"nanas"]);
        buah::create(['name'=>"durian"]);
        buah::create(['name'=>"melon"]);
        buah::create(['name'=>"semangka"]);
        buah::create(['name'=>"anggur"]);
    }
}

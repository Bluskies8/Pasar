<?php

namespace Database\Seeders;

use App\Models\listrik;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ListrikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        listrik::create(['value'=>"25000"]);
        listrik::create(['value'=>"40000"]);
        listrik::create(['value'=>"50000"]);
        listrik::create(['value'=>"75000"]);
        listrik::create(['value'=>"100000"]);
    }
}

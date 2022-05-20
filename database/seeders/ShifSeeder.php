<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\models\shif;

class ShifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        shif::create([
            'start' => '08:00:00',
            'end' => '15:00:00',
        ]);
        shif::create([
            'start' => '15:00:00',
            'end' => '22:00:00',
        ]);
        shif::create([
            'start' => '22:00:00',
            'end' => '08:00:00',
        ]);
    }
}

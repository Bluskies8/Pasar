<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\models\shif;
use Carbon\Carbon;

class ShifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $time = Carbon::now();
        // $date = Carbon::now()->format('Y-m-d');
        shif::create([
            'pasar_id' => '1',
            'number' => 1,
            'start' => '2022-05-30 08:00:00',
            'end' => '2022-05-30 15:00:00',
        ]);
        shif::create([
            'pasar_id' => '1',
            'number' => 2,
            'start' => '2022-05-30 15:00:00',
            'end' => '2022-05-30 22:00:00',
        ]);
        shif::create([
            'pasar_id' => '1',
            'number' => 3,
            'start' => '2022-05-30 22:00:00',
            'end' => '2022-05-31 08:00:00',
        ]);
    }
}

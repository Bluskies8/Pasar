<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\pasar;
use App\Models\shif;

class PasarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        pasar::create([
            'nama'=> "pasar 47",
            'alamat'=>"JL. tanjungsari 47"
        ]);
        shif::create([
            'pasar_id' => '1',
            'number' => 1,
            'start' => '2022-05-30 04:00:00',
            'end' => '2022-05-30 12:00:00',
        ]);
        shif::create([
            'pasar_id' => '1',
            'number' => 2,
            'start' => '2022-05-30 12:00:00',
            'end' => '2022-05-30 20:00:00',
        ]);
        shif::create([
            'pasar_id' => '1',
            'number' => 3,
            'start' => '2022-05-30 20:00:00',
            'end' => '2022-05-31 04:00:00',
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\pasar;

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
    }
}

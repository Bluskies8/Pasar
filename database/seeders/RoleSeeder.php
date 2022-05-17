<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name'=>'SuperAdmin'],
            ['name'=>'admin'],
            ['name'=>'checker'],
        ];
        foreach ($data as $key ) {
            role::create([
                'name' => $key['name']
            ]);
        }
    }
}

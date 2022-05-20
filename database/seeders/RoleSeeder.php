<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\role;
use App\Models\User;

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
            ['name'=>'Admin'],
            ['name'=>'Checker'],
        ];
        foreach ($data as $key ) {
            role::create([
                'name' => $key['name']
            ]);
        }
        User::create([
            'name'=>'michael',
            'role_id' => '1',
            'email' => 'michaelwibisono17@gmail.com',
            'pasar_id' => '1',
            'password' => '$2y$10$20dNKaah/p.N3GelNUmm6e3t37AcbFpBbZ4V.hmlIL/016W3oL4FS',
            'shif' => 1
        ]);
    }
}

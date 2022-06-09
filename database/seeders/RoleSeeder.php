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
            ['name'=>'Kapten'],
            ['name'=>'Checker'],
        ];
        foreach ($data as $key ) {
            role::create([
                'name' => $key['name']
            ]);
        }
        User::create([
            'name'=>'checker1',
            'role_id' => '3',
            'email' => 'checker1@gmail.com',
            'pasar_id' => '1',
            'password' => '$2y$10$20dNKaah/p.N3GelNUmm6e3t37AcbFpBbZ4V.hmlIL/016W3oL4FS',
            'shif' => 1
        ]);
        User::create([
            'name'=>'checker2',
            'role_id' => '3',
            'email' => 'checker2@gmail.com',
            'pasar_id' => '1',
            'password' => '$2y$10$20dNKaah/p.N3GelNUmm6e3t37AcbFpBbZ4V.hmlIL/016W3oL4FS',
            'shif' => 2
        ]);
        User::create([
            'name'=>'checker3',
            'role_id' => '3',
            'email' => 'checker3@gmail.com',
            'pasar_id' => '1',
            'password' => '$2y$10$20dNKaah/p.N3GelNUmm6e3t37AcbFpBbZ4V.hmlIL/016W3oL4FS',
            'shif' => 3
        ]);
        User::create([
            'name'=>'kapten1',
            'role_id' => '3',
            'email' => 'kapten1@gmail.com',
            'pasar_id' => '1',
            'password' => '$2y$10$20dNKaah/p.N3GelNUmm6e3t37AcbFpBbZ4V.hmlIL/016W3oL4FS',
        ]);
        User::create([
            'name'=>'kapten2',
            'role_id' => '3',
            'email' => 'kapten2@gmail.com',
            'pasar_id' => '1',
            'password' => '$2y$10$20dNKaah/p.N3GelNUmm6e3t37AcbFpBbZ4V.hmlIL/016W3oL4FS',
        ]);
        User::create([
            'name'=>'kapten3',
            'role_id' => '3',
            'email' => 'kapten3@gmail.com',
            'pasar_id' => '1',
            'password' => '$2y$10$20dNKaah/p.N3GelNUmm6e3t37AcbFpBbZ4V.hmlIL/016W3oL4FS',
        ]);
        User::create([
            'name'=>'admin1',
            'role_id' => '2',
            'email' => 'admin1@gmail.com',
            'pasar_id' => '1',
            'password' => '$2y$10$20dNKaah/p.N3GelNUmm6e3t37AcbFpBbZ4V.hmlIL/016W3oL4FS',
        ]);
        User::create([
            'name'=>'superadmin',
            'role_id' => '1',
            'email' => 'superadmin@gmail.com',
            'pasar_id' => '1',
            'password' => '$2y$10$20dNKaah/p.N3GelNUmm6e3t37AcbFpBbZ4V.hmlIL/016W3oL4FS',
        ]);
    }
}

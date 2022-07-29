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
            'role_id' => '4',
            'email' => 'checker1RIP',
            'pasar_id' => '1',
            'password' => '$2y$10$20dNKaah/p.N3GelNUmm6e3t37AcbFpBbZ4V.hmlIL/016W3oL4FS',
            'shif' => 1
        ]);
        User::create([
            'name'=>'checker2',
            'role_id' => '4',
            'email' => 'checker2ONO',
            'pasar_id' => '1',
            'password' => '$2y$10$20dNKaah/p.N3GelNUmm6e3t37AcbFpBbZ4V.hmlIL/016W3oL4FS',
            'shif' => 2
        ]);
        User::create([
            'name'=>'checker3',
            'role_id' => '4',
            'email' => 'checker3NDK',
            'pasar_id' => '1',
            'password' => '$2y$10$20dNKaah/p.N3GelNUmm6e3t37AcbFpBbZ4V.hmlIL/016W3oL4FS',
            'shif' => 3
        ]);
        User::create([
            'name'=>'kapten1',
            'role_id' => '3',
            'email' => 'kapten1BYU',
            'pasar_id' => '1',
            'password' => '$2y$10$20dNKaah/p.N3GelNUmm6e3t37AcbFpBbZ4V.hmlIL/016W3oL4FS',
            'shif' => 1
        ]);
        User::create([
            'name'=>'kapten2',
            'role_id' => '3',
            'email' => 'kapten2BKG',
            'pasar_id' => '1',
            'password' => '$2y$10$20dNKaah/p.N3GelNUmm6e3t37AcbFpBbZ4V.hmlIL/016W3oL4FS',
            'shif' => 2
        ]);
        User::create([
            'name'=>'admin',
            'role_id' => '2',
            'email' => 'admin20',
            'pasar_id' => '1',
            'password' => '$2y$10$20dNKaah/p.N3GelNUmm6e3t37AcbFpBbZ4V.hmlIL/016W3oL4FS',
        ]);
        User::create([
            'name'=>'superadmin',
            'role_id' => '1',
            'email' => 'superadmin',
            'pasar_id' => '1',
            'password' => '$2y$10$lQABvLawm3q6QSviXQPRd.nbJ5c1CeMHHJvflODxl/Xi//E7PWVPK',
        ]);
    }
}

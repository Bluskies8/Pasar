<?php

namespace Database\Seeders;

use App\Models\transportasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            // PasarSeeder::class,
            TransportasiSeeder::class,
            // ListrikSeeder::class,
            // RoleSeeder::class,
            // StandSeeder::class,
            // NettoSeeder::class,
            // BuahSeeder::class,
            //nanti dihapus
            // HtransSeeder::class
        ]);
    }
}

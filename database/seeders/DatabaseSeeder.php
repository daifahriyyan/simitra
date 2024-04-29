<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\DataImporter;
use App\Models\DataPersediaan;
use App\Models\User;
use App\Models\DataHargar;
use App\Models\DataHppFeet;
use App\Models\DataPegawai;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory(10)->create();
        DataPegawai::factory(10)->create();
        DataHppFeet::factory(10)->create();
        DataHargar::factory(10)->create();
        DataPersediaan::factory(10)->create();
        DataImporter::factory(10)->create();
        DataPegawai::factory(10)->create();
    }
}

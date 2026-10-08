<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Chama o nosso seeder customizado com os dados reais do GINTech
        $this->call([
            InicialSeeder::class,
        ]);
    }
}
<?php

namespace Database\Seeders;

use App\Models\Hobi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HobiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hobis = ['Membaca', 'Menulis', 'Bersepeda', 'Memasak'];

        foreach ($hobis as $hobi) {
            Hobi::create(['name' => $hobi]);
        }
    }
}

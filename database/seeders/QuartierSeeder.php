<?php

namespace Database\Seeders;

use App\Models\Quartier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuartierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $quartiers = ["Igaga", "Isada", "Antarandolo", "Ampasambazaha", "Tanambao", "Ivory"];
        foreach($quartiers as $quartier){
            Quartier::create([
                "quartier" => $quartier
            ]);
        }
    }
}

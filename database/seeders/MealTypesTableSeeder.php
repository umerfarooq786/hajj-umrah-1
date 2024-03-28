<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MealType;

class MealTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $types = [
            'Breakfast',
            'Half Meal',
            'Full Meal'
         ];
      
         foreach ($types as $type) {
              MealType::create(['name' => $type]);
         }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'name' => 'Infraestrutura',
            'created_by' => 'system'
        ]);

        Category::create([
            'name' => 'Suporte',
            'created_by' => 'system'
        ]);

        Category::create([
            'name' => 'Sistemas',
            'created_by' => 'system'
        ]);
    }
}

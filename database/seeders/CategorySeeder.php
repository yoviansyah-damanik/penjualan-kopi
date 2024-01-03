<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Robusta',
            'description' => 'Biji kopi pilihan yang dioleh menggunakan teknik khusus.'
        ]);
        Category::create([
            'name' => 'Arabica',
            'description' => 'Biji kopi pilihan yang dioleh menggunakan teknik khusus.'
        ]);
    }
}

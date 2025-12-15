<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Food & Dining',
            'Transportation',
            'Bills & Utilities',
            'Entertainment',
            'Shopping',
            'Healthcare',
            'Education',
            'Travel',
            'Personal Care',
            'Home & Garden'
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
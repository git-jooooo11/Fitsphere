<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Cardio Equipment',
                'children' => [
                    'Treadmills',
                    'Stationary bikes',
                    'Elliptical trainers',
                    'Rowing machines',
                    'Stair climbers',
                ]
            ],
            [
                'name' => 'Strength Training Equipment',
                'children' => [
                    'Free weights (dumbbells, barbells)',
                    'Weight machines',
                    'Resistance bands',
                    'Kettlebells',
                    'Medicine balls',
                ]
            ],
            [
                'name' => 'Functional Training Equipment',
                'children' => [
                    'Cable machines',
                    'TRX suspension trainers',
                    'Battle ropes',
                    'Plyo boxes',
                    'Sandbags',
                ]
            ],
            [
                'name' => 'Flexibility & Recovery Tools',
                'children' => [
                    'Foam rollers',
                    'Stretching machines',
                    'Massage guns',
                    'Yoga mats',
                ]
            ],
            [
                'name' => 'Bodyweight & Calisthenics Equipment',
                'children' => [
                    'Pull-up bars',
                    'Dip stations',
                    'Parallel bars',
                    'Ab benches',
                ]
            ],
            [
                'name' => 'Accessories',
                'children' => [
                    'Gym balls (stability balls)',
                    'Jump ropes',
                    'Mats',
                    'Resistance tubes',
                    'Wrist/ankle weights',
                ]
            ],
        ];

        foreach ($categories as $category) {
            $parent = Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
            ]);

            foreach ($category['children'] as $child) {
                Category::create([
                    'name' => $child,
                    'slug' => Str::slug($child),
                    'parent_id' => $parent->id,
                ]);
            }
        }
    }
} 
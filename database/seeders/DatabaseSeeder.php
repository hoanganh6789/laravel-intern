<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ProductColor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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


        // fake data color
        $dataColor = [
            [
                'name' => 'Đen',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Trắng',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Xanh',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Nâu',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Tím',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cam',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Vàng',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Xám',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Hồng',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        // DB::table('product_colors')->insert($dataColor);

        $dataSize = [
            [
                'name' => 'L',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'M',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'S',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'S',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'XL',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'XXL',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'XXXL',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        // DB::table('product_sizes')->insert($dataSize);


        $dataTags = [
            [
                'name' => 'Áo Nike',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Áo DSQ',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Áo Phông',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Quần Đùi',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Quần Tây',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Hot Trend 2024',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'LuxChill',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        // DB::table('tags')->insert($dataTags);

    }
}

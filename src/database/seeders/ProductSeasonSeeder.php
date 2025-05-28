<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeasonSeeder extends Seeder
{
    public function run()
    {
        $productSeasons = [
            1 => [3, 4],
            2 => [1],
            3 => [4],
            4 => [2],
            5 => [2],
            6 => [2,3],
            7 => [1,2],
            8 => [2, 3],
            9 => [2],
            10 => [1,2],
        ];

        foreach ($productSeasons as $productId => $seasonIds) {
            foreach ($seasonIds as $seasonId) {
                DB::table('product_season')->insert([
                    'product_id' => $productId,
                    'season_id' => $seasonId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}

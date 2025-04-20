<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Tasawk\Models\Nationality;

class NationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Nationality::query()->delete();
        $parties = [
            [
                'name' => [
                    'ar' => 'سعودي',
                    'en' => 'Saudi',
                ],
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($parties as $party) {
            Nationality::create($party);
        }

    }
}

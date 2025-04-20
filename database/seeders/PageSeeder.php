<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Tasawk\Models\Pages\Pages;
class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pages::query()->delete();
        $pages = [
            [
                'id' => 'aboutus',
                'created_at' => '2021-10-10 10:10:10',
                'updated_at' => '2021-10-10 10:10:10'
            ],
            [
                'id' => 'partner',
                'created_at' => '2021-10-10 10:10:10',
                'updated_at' => '2021-10-10 10:10:10'
            ],
            [
                'id' => 'ourservice',
                'created_at' => '2021-10-10 10:10:10',
                'updated_at' => '2021-10-10 10:10:10'
            ],
            [
                'id' => 'company-message',
                'created_at' => '2021-10-10 10:10:10',
                'updated_at' => '2021-10-10 10:10:10'
            ],
            [
                'id' => 'terms-condition',
                'created_at' => '2021-10-10 10:10:10',
                'updated_at' => '2021-10-10 10:10:10'
            ],
            [
                'id' => 'privacy-policy',
                'created_at' => '2021-10-10 10:10:10',
                'updated_at' => '2021-10-10 10:10:10'
            ],
            [
                'id' => 'contact-us',
                'created_at' => '2021-10-10 10:10:10',
                'updated_at' => '2021-10-10 10:10:10'
            ],
            [
                'id' => 'faq',
                'created_at' => '2021-10-10 10:10:10',
                'updated_at' => '2021-10-10 10:10:10'
            ],
            [
                'id' => 'career',
                'created_at' => '2021-10-10 10:10:10',
                'updated_at' => '2021-10-10 10:10:10'
            ],
            [
                'id' => 'company-aims',
                'created_at' => '2021-10-10 10:10:10',
                'updated_at' => '2021-10-10 10:10:10'
            ],
            [
                'id' => 'company-vision',
                'created_at' => '2021-10-10 10:10:10',
                'updated_at' => '2021-10-10 10:10:10'
            ],
            [
                'id' => 'our-values',
                'created_at' => '2021-10-10 10:10:10',
                'updated_at' => '2021-10-10 10:10:10'
            ],
            [
                'id' => 'scientific-experiences',
                'created_at' => '2021-10-10 10:10:10',
                'updated_at' => '2021-10-10 10:10:10'
            ],
            [
                'id' => 'relevant-company',
                'created_at' => '2021-10-10 10:10:10',
                'updated_at' => '2021-10-10 10:10:10'
            ],
            [
                'id' => 'team-mission',
                'created_at' => '2021-10-10 10:10:10',
                'updated_at' => '2021-10-10 10:10:10'
            ]
        ];

        foreach ($pages as $page) {
            Pages::create($page);
        }
    }
}

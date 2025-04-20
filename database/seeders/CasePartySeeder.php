<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Tasawk\Models\CaseParty;

class CasePartySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CaseParty::query()->delete();
        $parties = [
            [
                'name' => [
                    'ar' => 'المدعي',
                    'en' => 'Plaintiff',
                ],
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'ar' => 'المدعى عليه',
                    'en' => 'Defendant',
                ],
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'ar' => 'طرف ثالث',
                    'en' => 'Third Party',
                ],
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($parties as $party) {
            CaseParty::create($party);
        }

    }
}

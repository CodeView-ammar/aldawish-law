<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Tasawk\Models\CaseType as CaseTypeModel;

class CasesType extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CaseTypeModel::query()->delete();
        $types = [
            [
                'name' => [
                    'ar' => 'القضايا الجزائية',
                    'en' => 'Criminal Cases',
                ],
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'ar' => 'قضايا المعاملات المدنية',
                    'en' => 'Civil Transactions Cases',
                ],
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'ar' => 'قضايا الأحوال الشخصية',
                    'en' => 'Personal Status Cases',
                ],
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'ar' => 'القضايا العمالية',
                    'en' => 'Labor Cases',
                ],
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'ar' => 'القضايا التجارية',
                    'en' => 'Commercial Cases',
                ],
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'ar' => 'منازعات العقارات',
                    'en' => 'Real Estate Disputes',
                ],
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'ar' => 'قضايا التعويضات',
                    'en' => 'Compensation Cases',
                ],
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'ar' => 'قضايا التأمين',
                    'en' => 'Insurance Cases',
                ],
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'ar' => 'قضايا التنفيذ',
                    'en' => 'Execution Cases',
                ],
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'ar' => 'قضايا التحكيم والوساطة',
                    'en' => 'Arbitration and Mediation Cases',
                ],
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'ar' => 'قضايا البنوك والتمويل',
                    'en' => 'Banking and Finance Cases',
                ],
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'ar' => 'قضايا المخالفات البيئية',
                    'en' => 'Environmental Violations Cases',
                ],
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'ar' => 'قضايا الجرائم المعلوماتية',
                    'en' => 'Cybercrime Cases',
                ],
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'ar' => 'قضايا التركات',
                    'en' => 'Inheritance Cases',
                ],
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'ar' => 'قضايا الأخطاء الطبية',
                    'en' => 'Medical Malpractice Cases',
                ],
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'ar' => 'قضايا الزكاة والضريبة',
                    'en' => 'Zakat and Tax Cases',
                ],
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'ar' => 'القضايا المرورية',
                    'en' => 'Traffic Cases',
                ],
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'ar' => 'قضايا النصب والاحتيال',
                    'en' => 'Fraud Cases',
                ],
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'ar' => 'قضايا الأوقاف والوصايا',
                    'en' => 'Endowments and Wills Cases',
                ],
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'ar' => 'قضايا الملكية الفكرية',
                    'en' => 'Intellectual Property Cases',
                ],
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'ar' => 'القضايا الإدارية',
                    'en' => 'Administrative Cases',
                ],
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'ar' => 'صياغة وتوثيق العقود',
                    'en' => 'Contract Drafting and Notarization',
                ],
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'ar' => 'استفسارات منصة ناجز',
                    'en' => 'Najiz Platform Inquiries',
                ],
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'ar' => 'تحرير وكالة',
                    'en' => 'Agency Editing',
                ],
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'ar' => 'التسوية الودية',
                    'en' => 'Amicable Settlement',
                ],
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($types as $type) {
            CaseTypeModel::create($type);
        }
    }
}

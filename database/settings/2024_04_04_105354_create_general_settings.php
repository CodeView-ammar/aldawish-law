<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.years_of_experience_text', [
            'en' => 'Years of experience',
            'ar' => 'سنوات الخبرة',
        ]);
        $this->migrator->add('general.successful_pleadings_text', [
            'en' => 'Successful pleadings',
            'ar' => 'مرافعات ناجحة',
        ]);
        $this->migrator->add('general.legal_experts_text', [
            'en' => 'Legal experts',
            'ar' => 'الخبراء القانونيين',
        ]);
    }
};

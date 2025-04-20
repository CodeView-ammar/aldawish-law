<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->deleteIfExists('general.app_location');
        $this->migrator->add('general.app_location', [
            'en' => 'Al Diriyah - Riyadh - Saudi Arabia',
            'ar' => 'الدرعية - الرياض - المملكة العربية السعودية',
            'fr' => 'Al Dhariyah - Riyadh - Saudi Arabia',
            'de' => 'Al Dhariyah - Riyadh - Saudi Arabia',
            'zh' => '阿尔迪亚 - 利雅得 - 沙特阿拉伯',
        ]);

        $this->migrator->deleteIfExists('general.years_of_experience_text');
        $this->migrator->add('general.years_of_experience_text', [
            'en' => 'Years of experience',
            'ar' => 'سنوات الخبرة',
            'fr' => 'Années d\'expérience',
            'de' => 'Jahre Erfahrung',
            'zh' => '年份的经验',
        ]);

        $this->migrator->deleteIfExists('general.successful_pleadings_text');
        $this->migrator->add('general.successful_pleadings_text', [
            'en' => 'Successful pleadings',
            'ar' => 'مرافعات ناجحة',
            'fr' => 'Pleadings réussis',
            'de' => 'Erfolgreiche Pleadings',
            'zh' => '成功的诉讼',
        ]);

        $this->migrator->deleteIfExists('general.legal_experts_text');
        $this->migrator->add('general.legal_experts_text', [
            'en' => 'Legal experts',
            'ar' => 'الخبراء القانونيين',
            'fr' => 'Experts juridiques',
            'de' => 'Rechtsberater',
            'zh' => '法律专家',
        ]);

    }
};

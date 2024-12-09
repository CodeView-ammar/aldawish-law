<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration {
    public function up(): void {
        $this->migrator->add('general.app_whatsapp', '5193456789');
        $this->migrator->add('general.app_location', [
            'en' => 'Al Diriyah - Riyadh - Saudi Arabia',
            'ar' => 'الدرعية - الرياض - المملكة العربية السعودية',
        ]);
    }
};

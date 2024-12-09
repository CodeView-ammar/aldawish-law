<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.years_of_experience', '10');
        $this->migrator->add('general.successful_pleadings', '250');
        $this->migrator->add('general.legal_experts', '15');
    }
};

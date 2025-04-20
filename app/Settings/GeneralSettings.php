<?php

namespace Tasawk\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string|null $app_logo;
    public string $app_name;
    public string $app_email;
    public string $app_phone;
    public string $app_address;
    public float $taxes;
    public array $app_pages = [];

    public array $applications_links = [];

    public array $social_links = [];

    public array|null $app_location;
    public string|null $app_whatsapp;

    public string $years_of_experience;
    public string $successful_pleadings;
    public string $legal_experts;

    public array|null $years_of_experience_text;
    public array|null $successful_pleadings_text;
    public array|null $legal_experts_text;
    public array $working_days = [];
    public string $forget_verification;

    public string $iban_number;
    public string $account_number;



    public static function group(): string
    {
        return 'general';
    }
}
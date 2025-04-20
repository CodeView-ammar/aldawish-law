<?php

namespace Tasawk\Rules;

use Illuminate\Contracts\Validation\Rule;
use libphonenumber\PhoneNumberUtil;


class PhoneNumber implements Rule {
    protected $countryCode;

    public function __construct($countryCode) {
        $this->countryCode = $countryCode;
    }

    public function passes($attribute, $value) {
        $phoneUtil = PhoneNumberUtil::getInstance();
        try {
            $phoneNumber = $phoneUtil->parse($value, $this->countryCode);
            return $phoneUtil->isValidNumber($phoneNumber);
        } catch (\libphonenumber\NumberParseException $e) {
            return false;
        }
    }

    public function message() {
        return __('validation.phone');
    }
}



<?php

namespace Tasawk\Lib;

use Illuminate\Support\Facades\Http;

class SMS {
    static public function make(): SMS {
        return new self();
    }

    public function send($phone, $message) {
         return Http::get('http://mora-sa.com/api/v1/sendsms', [
            'username' => env("SMS_USERNAME", '966505995291'),
            'sender' => env("SMS_SENDER", 'AldawishLaw'),
            'message' => $message,
            'numbers' => $phone,
            'response' => 'json',
            'api_key' => env("SMS_API_KEY", '839566e7d51a34abf21b7b8aa46c14f85bbdc401'),
        ])->json();
    }
}

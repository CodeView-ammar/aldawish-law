<?php

namespace Tasawk\Lib;

use Http;

class SMS {
    static public function make(): SMS {
        return new self();
    }

    public function send($phone, $message) {
         return Http::get('http://mora-sa.com/api/v1/sendsms', [
            'username' => env("SMS_USERNAME", 'aldawishlaw'),
            'sender' => env("SMS_SENDER", 'AldawishLaw'),
            'message' => $message,
            'numbers' => $phone,
            'response' => 'json',
            'api_key' => env("SMS_API_KEY", '64362c9cfa4c47248efa64bb332b9362a9fc6740'),
        ])->json();
    }
}

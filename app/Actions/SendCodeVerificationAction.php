<?php

namespace Tasawk\Actions;


use Illuminate\Support\Str;
use Lorisleiva\Actions\Concerns\AsAction;
use Tasawk\Lib\SMS;
use Tasawk\Lib\Utils;

class SendCodeVerificationAction {
    use asAction;

    public function handle($user, $phone = null): void {
        $user->verificationCodes()->delete();
        $code = Utils::randomOtpCode();
        $user->verificationCodes()->create(['phone' =>Str::replace(" ",'', $phone ?? $user->phone), "code" => $code]);
        SMS::make()->send($phone ?? $user->phone, __("site.otp_code_message", ['code' => $code],'ar'));
    }
}

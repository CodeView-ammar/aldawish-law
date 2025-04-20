<?php

namespace Tasawk\Actions;

use Illuminate\Support\Str;
use Lorisleiva\Actions\Concerns\AsAction;
use Tasawk\Lib\SMS;

class SendTextMessageAction {
    use AsAction;

    public function handle($message, $phone = null): void {
        // إرسال الرسالة النصية إلى الهاتف المحدد
        $phone = $phone;  // في حال لم يتم توفير رقم الهاتف، نستخدم رقم المستخدم.
        SMS::make()->send($phone, $message);
    }
}

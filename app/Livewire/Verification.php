<?php

namespace Tasawk\Livewire;

use Livewire\Component;
use Tasawk\Actions\SendCodeVerificationAction;
use Tasawk\Models\User;
use Tasawk\Models\VerificationCode;

class Verification extends Component {
    public array $otp = [];
    public $successMessage, $errorMessage;

    public function render() {
        return view('livewire.verification');
    }

    public function getValidationAttributes() {
        return [
            'otp' => __('site.code'),
        ];
    }

    public function getRules() {
        return [
            'otp' => ['required', 'array'],
        ];
    }

    public function verify() {

        $this->validate();
        $data = session('user');

        $user = User::where('id', $data->id)->first();

        $code = (int)(implode('', $this->otp));
        $phone = str_replace(" ", "", $user->phone);
        $confirmed = VerificationCode::where('code', $code)->where("phone", $phone)->where('expired_at', ">=", now())->exists();

        if (!$confirmed) {
            return $this->addError('otp', __('validation.api.invalid_verification_code'));
        }
        $user->update([
            'phone_verified_at' => now()
        ]);
        return redirect()->to('/register-success');
    }
    public function resend() {
        SendCodeVerificationAction::run(session()->get('user'));
        return redirect()->route('verifyCode');
    }
}

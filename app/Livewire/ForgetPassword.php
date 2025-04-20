<?php

namespace Tasawk\Livewire;

use Livewire\Component;
use Tasawk\Actions\SendCodeVerificationAction;
use Tasawk\Lib\SMS;
use Tasawk\Models\Customer;
use Tasawk\Models\Pages\TopBar;
use Tasawk\Models\User;
use Tasawk\Settings\GeneralSettings;
use Tasawk\Rules\PhoneNumber;


class ForgetPassword extends Component {
    public $email, $phone, $type, $country_code = 'SA', $country_key = "966";
    public $successMessage, $errorMessage;
    protected function getTopBars() {
        return TopBar::where('status', 1)->get();
    }
    public function render() {
        $topBars = $this->getTopBars();
        $this->type = (new GeneralSettings())->forget_verification; // تعيين القيمة هنا
        return view('livewire.forget-password', [
            'topBars' => $topBars,
            'type' => $this->type, // تمرير المتغير للعرض
        ]);
    }

    public function mount() {
        $setting = new GeneralSettings();
        $this->type = $setting->forget_verification ?? 'email'; // قيمة افتراضية لتجنب الخطأ
    }
    public function getValidationAttributes() {
        return [
            'email' => __('site.email'),
            'phone' => __('site.phone_number'),

        ];
    }

    public function getRules() {
        if ($this->type == 'email') {
            return [
                'email' => ['required', 'email', 'exists:users,email'],
            ];
        } elseif ($this->type == 'phone') {
            return [
                'phone' => ['required', new PhoneNumber($this->country_code)],
            ];
        }

        return [];
    }


    public function resetPassword() {

        $this->validate();
        $user = null;
        if ($this->type == 'email') {
            $user = Customer::where('email', $this->email)->first();
            session()->put('user', $user);
            session()->put('email', $user->email);

            if (!$user) {
                return $this->addError('email', __('site.invalid email'));
                return redirect()->back();
            }
        }
        if ($this->type == 'phone') {
            // dd($cu->phone,"+" . $this->country_key . $this->phone);
            $user = Customer::where('phone', "+" . $this->country_key . $this->phone)->first();
            if (!$user) {
                return $this->addError('phone', __('site.invalid phone'));
                return redirect()->back();
            }
            session()->put('user', $user);
            session()->put('email', $user->email);
            session()->put('phone', $user->phone);

        }
        SendCodeVerificationAction::run($user);
        session()->put('user', $user);
        return redirect()->to('/verification-password', ['phone' => $user->phone]);
        // return redirect()->route('reset-password', $user->email);


    }
}

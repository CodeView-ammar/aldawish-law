<?php

namespace Tasawk\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Tasawk\Models\Nationality;
use Tasawk\Settings\GeneralSettings;
use Tasawk\Actions\SendCodeVerificationAction;
use Tasawk\Models\Pages\TopBar; // تأكد من استيراد نموذج TopBar

class AuthController extends BaseController
{
    protected function getTopBars() {
        return TopBar::where('status', 1)->get();
    }

    public function login()
    {
        $topBars = $this->getTopBars(); // جلب بيانات topBars
        return view('site.pages.auth.login', compact('topBars'));
    }

    public function resetPassword()
    {
        $topBars = $this->getTopBars(); // جلب بيانات topBars
        return view('site.pages.auth.reset_password', compact('topBars'));
    }

    public function gorgetPassword()
    {
        $setting = new GeneralSettings();
        $type = $setting->forget_verification;
        $topBars = $this->getTopBars(); // جلب بيانات topBars

        return view('site.pages.auth.forget_password', compact('topBars'));
    }

    public function register()
    {
        $nationalities = Nationality::where('status', 1)->get();
        $topBars = $this->getTopBars(); // جلب بيانات topBars

        return view('site.pages.auth.register', compact('topBars', 'nationalities'));
    }

    public function registerSuccess()
    {
        $topBars = $this->getTopBars(); // جلب بيانات topBars
        return view('site.pages.auth.register_success', compact('topBars'));
    }

    public function verify()
    {
        $topBars = $this->getTopBars(); // جلب بيانات topBars
        return view('site.pages.auth.verification', compact('topBars'));
    }

    public function verifyPassword()
    {
        $topBars = $this->getTopBars(); // جلب بيانات topBars
        return view('site.pages.auth.verificationPassword', compact('topBars'));
    }

    public function verifyPassword2()
    {
        SendCodeVerificationAction::run(session('user'));
        $topBars = $this->getTopBars(); // جلب بيانات topBars
        return view('site.pages.auth.verificationPassword', compact('topBars'));
    }
}
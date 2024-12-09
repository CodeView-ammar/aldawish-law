<?php

namespace Tasawk\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Tasawk\Models\Nationality;
use Tasawk\Settings\GeneralSettings;
use Tasawk\Actions\SendCodeVerificationAction;

class AuthController extends BaseController
{

    public function login()
    {
        return view('site.pages.auth.login', get_defined_vars());
    }
    public function resetPassword()
    {
        return view('site.pages.auth.reset_password', get_defined_vars());
    }
    public function gorgetPassword()
    {
        $setting = new GeneralSettings();
        $type = $setting->forget_verification;

        return view('site.pages.auth.forget_password', get_defined_vars());
    }

    public function register()
    {
        $nationalities = Nationality::where('status', 1)->get();
        // dd($nationalities);
        return view('site.pages.auth.register', get_defined_vars());
    }
    public function registerSuccess()
    {
        return view('site.pages.auth.register_success', get_defined_vars());
    }
    public function verify()
    {
        return view('site.pages.auth.verification', get_defined_vars());
    }
    public function verifyPassword()
    {
        return view('site.pages.auth.verificationPassword', get_defined_vars());
    }
    public function verifyPassword2()
    {
        SendCodeVerificationAction::run(session('user'));
        return view('site.pages.auth.verificationPassword', get_defined_vars());
    }
}

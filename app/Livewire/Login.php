<?php

namespace Tasawk\Livewire;

use Auth;
use Livewire\Component;
use Tasawk\Models\User;

class Login extends Component
{
    public $email, $password;
    public $successMessage, $errorMessage;

    public function render()
    {
        return view('livewire.login');
    }

    public function getValidationAttributes()
    {
        return [
            'email' => __('site.email'),
            'password' => __('site.password'),
        ];
    }


    public function getRules()
    {
        return [
            'email' => ['required', 'email','exists:users,email'],
            'password' => ['required'],
        ];
    }

    public function login()
    {
        $this->validate();

        $user = User::where('email', $this->email)->first();

        if(!$user){
            return $this->addError('email', __('site.email or password are wrong.'));
        }
      
        if ($user->active == 0) {
            return $this->addError('email', __('site.your_account_was_inactive.'));
            return redirect()->back();
        }

        if (\auth()->guard('customer')->attempt(array('email' => $this->email, 'password' => $this->password))) {
            auth()->guard('customer')->login($user);
            $this->successMessage = __('site.you are Login successful.');
        } else {
            return $this->addError('email', __('site.email or password are wrong.'));
        }

        return redirect()->to('/');
    }
}

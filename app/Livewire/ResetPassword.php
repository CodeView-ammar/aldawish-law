<?php

namespace Tasawk\Livewire;

use Hash;
use Livewire\Component;
use Tasawk\Models\User;
use Illuminate\Validation\Rules\Password;

class ResetPassword extends Component
{
    public $password, $password_confirmation;
    public $successMessage, $errorMessage;
    public function render()
    {
        return view('livewire.reset-password');
    }


    public function getRules()
    {
        return [
            'password' => ['required', Password::min(8)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()],
            'password_confirmation' => ['required', 'same:password'],
        ];
    }

    public function updatePassword()
    {
        $this->validate();

        $user = User::where('email', session('email'))->first();

        $user->update([
            'password' => $this->password
        ]);
        $this->successMessage = __('site.password updated successfully');
        return redirect()->to('/login');
    }
}

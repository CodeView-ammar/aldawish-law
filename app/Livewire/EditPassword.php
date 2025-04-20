<?php

namespace Tasawk\Livewire;

use Hash;
use Livewire\Component;
use Tasawk\Models\User;
use Illuminate\Validation\Rules\Password;

class EditPassword extends Component
{
    public $old_password, $password, $password_confirmation;
    public $successMessage, $errorMessage;

    public function render()
    {
        return view('livewire.edit-password');
    }

    public function getValidationAttributes()
    {
        return [
            'old_passeord' => __('site.current password'),
            'passeord' => __('site.passeord'),
            'password_confirmation' => __('site.password confirmation'),
        ];
    }

    public function getRules()
    {
        return [
            'old_password' => 'required',
            'password' => ['required', Password::min(8)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()],
            'password_confirmation' => ['required', 'same:password'],
        ];
    }

    public function editPassword()
    {
        $this->validate();
        $user = User::where('id', auth()->guard('customer')->user()->id)->first();

        $user->update([
            'password' => $this->password
        ]);

        $this->successMessage = __('site.password updated successfully');
        return redirect()->to('/login');
    }
}

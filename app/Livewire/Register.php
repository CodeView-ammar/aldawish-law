<?php

namespace Tasawk\Livewire;

use Carbon\Carbon;
use Hash;
use Livewire\Component;
use Tasawk\Actions\SendCodeVerificationAction;
use Tasawk\Models\Customer;
use Tasawk\Models\User;
use Spatie\Permission\Models\Role;
use Tasawk\Rules\PhoneNumber;
use Illuminate\Validation\Rules\Password;
use Tasawk\Models\Nationality;

class Register extends Component {
    public $email, $phone, $password, $name, $birthday, $gender, $address, $password_confirmation, $id_number, $remember, $nationality_id, $nationality, $passport_number;
    public $successMessage, $errorMessage, $country_code = 'SA', $country_key = "966", $nationalities, $showIdNumber = false, $showPassportNumber = false;

    public function render() {
        return view('livewire.register', ['nationalities' => $this->nationalities]);
    }

    public function getValidationAttributes() {
        return [
            'name' => __('site.full_name'),
            'gender' => __('site.gender'),
            'birthday' => __('site.birthday'),
            'address' => __('site.address'),
            'phone' => __('site.phone_number'),
            'email' => __('site.email'),
            'passeord' => __('site.passeord'),
            'password_confirmation' => __('site.password confirmation'),
            // 'id_number' => __('site.id number'),
            'nationality' => __('site.nationality'),
            'passport_number' => __('site.passport_number'),
            'remember' => __('site.terms_conditions')
        ];
    }

    public function updatedNationalityId() {
        if ($this->nationality_id == 1) {
            $this->showIdNumber = true;
            $this->showPassportNumber = false;
        } else {
            $this->showIdNumber = false;
            $this->showPassportNumber = true;
        }
    }

    public function getMessages() {
        return [
            'passport_number.required_if' => __('validation.required', ['attribute' => __('site.passport_number')]),
            // 'id_number.required_if' => __('validation.required', ['attribute' => __('site.id_number')]),
        ];
    }

    public function mount() {
        // $oldNationality = Nationality::find(12);
        // if ($oldNationality) {
        //     // Create a new instance with the same data but different id
        //     $newNationality = $oldNationality->replicate();
        //     $newNationality->id = 1; // Set the new id
        //     $newNationality->save();

        //     // Optionally delete the old instance
        //     $oldNationality->delete();
        // }
        $this->nationalities = Nationality::where('status', 1)->get();
    }

    public function getRules() {
        return [
            'name' => ['required', 'string', 'min:3', 'max:40'],
            'email' => ['required', 'email', 'unique:users'],
            'phone' => ['required', new PhoneNumber($this->country_code), 'unique:users,phone'],
            'password' => ['required', Password::min(8)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()],
            'password_confirmation' => ['required', 'same:password'],
            'birthday' => ['required'],
            'gender' => ['required'],
            'address' => ['required'],
            'nationality' => ['required'],
            // 'id_number' => 'required',
            // 'passport_number' =>  'required_if:nationality_id,!=,1',
            "remember" => ['required_if:checkbox,= ,0', 'nullable'],
            // "remember" => ['required'],
        ];
    }

    public function register() {
        $this->validate();
        $Customers = Customer::get();
        foreach ($Customers as $cu) {
            if ($cu->phone == "+" . $this->country_key . $this->phone) {
                return $this->addError('phone', __('panel.messages.phone_is_unique'));
            }
        }

        // $carbonBirthday = Carbon::createFromFormat('F, d Y', $this->birthday);
        // $this->birthday = $carbonBirthday->format('Y-m-d');
        $customer = User::create(['name' => $this->name, 'email' => $this->email, 'phone' => "+" . $this->country_key . $this->phone, 'password' => $this->password, 'birthday' => $this->birthday, 'gender' => $this->gender,  'nationality' => $this->nationality, 'passport_number' => $this->passport_number, 'address' => $this->address]);
        $role = Role::where('name', 'customer')->first();
        if (!$role) {
            Role::create(['name' => 'customer']);
        }
        $customer->assignRole(Customer::ROLE);

        session()->put('user', $customer);
        SendCodeVerificationAction::run($customer);

        return redirect()->to('/verification-code');
    }
}

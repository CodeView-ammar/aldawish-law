<?php

namespace Tasawk\Livewire;

use Livewire\Component;
use Tasawk\Models\User;
use Tasawk\Rules\PhoneNumber;
use Illuminate\Validation\Rule;
use Request;
use Tasawk\Models\Nationality;
use Carbon\Carbon;
use Tasawk\Models\Customer;

class EditProfile extends Component
{
    public $users, $email, $phone, $name, $birthday, $gender, $address, $id_number, $nationality_id, $passport_number, $state = [], $nationalities;
    public $successMessage, $errorMessage, $country_code = 'SA', $country_key  = "966";

    public function render()
    {
        return view('livewire.edit-profile', ['nationalities' => $this->nationalities]);
    }

    public function getValidationAttributes()
    {
        return [
            'name' => __('site.full_name'),
            'gender' => __('site.gender'),
            'birthday' => __('site.birthday'),
            'address' => __('site.address'),
            'phone' => __('site.phone_number'),
            'email' => __('site.email'),
            // 'id_number' => __('site.id number'),
        ];
    }

    public function mount()
    {
        $this->nationalities = Nationality::where('status', 1)->get();
        $this->name = auth()->guard('customer')->user()->name;
        $this->email = auth()->guard('customer')->user()->email;
        $this->phone = auth()->guard('customer')->user()->phone;
        $this->gender = auth()->guard('customer')->user()->gender;
        // $this->id_number = auth()->guard('customer')->user()->id_number;
        $this->birthday = auth()->guard('customer')->user()->birthday;
        $this->address = auth()->guard('customer')->user()->address;
        $this->nationality_id = auth()->guard('customer')->user()->nationality_id;
        $this->passport_number = auth()->guard('customer')->user()->passport_number;

        // $this->state = auth()->user()->withoutRelations()->toArray();
    }

    public function getRules()
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:40'],
            'phone' => ['required', new PhoneNumber($this->country_code),'unique:users,phone,'.auth()->user()->id],
            'address' => ['required'],

        ];
    }

    public function editProfile(Request $request)
    {
        $this->validate();
        $Customers = Customer::where('id','!=',auth()->user()->id)->get();
        foreach($Customers as $cu){
            if($cu->phone == "+".$this->country_key.$this->phone){
                return $this->addError('phone', __('panel.messages.phone_is_unique'));
            }
        }
        // dd($this->validate());
        $user = User::where('id', auth()->guard('customer')->user()->id)->first();
        $user->update([
            'name' => $this->name,
            'passport_number' => $this->passport_number,
            'nationality_id' => $this->nationality_id,
            'address' => $this->address,
            // 'id_number' => $this->id_number,
            'birthday' => $this->birthday,
            'gender' => $this->gender,
            'email' => $this->email,
            'phone' => "+".$this->country_key.$this->phone,
        ]);
        if (!$user->name) {
            return $this->addError('name', __('panel.messages.name_is_required'));
        } elseif (!$user->phone) {
            return $this->addError('phone', __('panel.messages.phone_is_required'));
        } elseif (!$user->address) {
            return $this->addError('name', __('panel.messages.address_is_required'));
        }

        $this->successMessage = __('site.profile updated successfully');
    }
}

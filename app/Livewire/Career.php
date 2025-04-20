<?php

namespace Tasawk\Livewire;

use Livewire\Component;
use Tasawk\Rules\PhoneNumber;
use Tasawk\Models\Career as CareerModel;
use Livewire\WithFileUploads;


class Career extends Component
{
    use WithFileUploads;
    public $name;
    public $gender;
    public $age;
    public $address;
    public $phone;
    public $email;
    public $job_title;
    public $position;
    public $cv;
    public $country_code='SA';
    public $successMessage;

    public function getRules() {
        return [
            'name' => ['required', 'min:3', 'max:255'],
            'gender' => ['required'],
            'age' => ['required', 'numeric'],
            'address' => ['required', 'min:3', 'max:255'],
            'phone' => ['required', new PhoneNumber($this->country_code)],
            'email' => ['required', 'email', 'max:255'],
            'job_title' => ['required', 'min:3', 'max:255'],
            'position' => ['required', 'min:3', 'max:255'],
            'cv' => ['required', 'mimes:pdf,doc,docx'],
        ];
    }
    public function getValidationAttributes() {
        return [
            'name' => __('site.full_name'),
            'gender' => __('site.gender'),
            'age' => __('site.age'),
            'address' => __('site.address'),
            'phone' => __('site.phone_number'),
            'email' => __('site.email'),
            'job_title' => __('site.job_title'),
            'position' => __('site.postion'),
            'cv' => __('site.cv'),
        ];
    }
    public function submitForm() {

        $career = $this->validate();
        $career['name'] = $this->name;
        $career['gender'] = $this->gender;
        $career['age'] = $this->age;
        $career['address'] = $this->address;
        $career['phone'] = $this->phone;
        $career['email'] = $this->email;
        $career['job_title'] = $this->job_title;
        $career['position'] = $this->position;
        $career = CareerModel::create($career);
        if ($this->cv) {
            $career->addMedia($this->cv)->toMediaCollection('cv');
        }
        $this->reset();
        $this->successMessage = __('site.career_success');
    }
    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.career');
    }
}

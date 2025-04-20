<?php

namespace Tasawk\Livewire;

use Livewire\Component;
use Tasawk\Rules\PhoneNumber;
use Tasawk\Models\ContactType;
use Tasawk\Models\Content\Contact   ;

class ContactUs extends Component
{
    public $name;
    public $email;
    public $phone;
    public $message;
    public $contact_type_id;
    public $country_code='SA';
    public  $country_key  = "966";
    public $contact_type =[];
    public $successMessage;

    public function getRules() {
        return [
            'name' => ['required', 'min:3', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['required', new PhoneNumber($this->country_code)],
            'message' => ['required', 'min:3', 'max:255'],
            'contact_type_id' => ['required', 'exists:contact_types,id'],
        ];
    }
    public function getValidationAttributes() {
        return [
            'phone' => __('site.phone'),
            'contact_type_id' => __('site.message_type'),
            'name' => __('site.full_name'),
            'email' => __('site.email'),
            'message' => __('site.contact_massage'),
        ];
    }

    public function mount() {
        $this->contact_type = ContactType::where('status', true)->get();

    }

    public function submitForm() {

        $contact = $this->validate();
        $contact['name'] = $this->name;
        $contact['email'] = $this->email;
        $contact['message'] = $this->message;
        $contact['phone'] =  "+".$this->country_key.$this->phone;
        $contact['contact_type_id'] = $this->contact_type_id;
        Contact::create($contact);
        $this->reset();
        $this->successMessage = __('site.contact_us_success');
    }
    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }

    public function render() {
        return view('livewire.contact-us', [
            'contact_type' => $this->contact_type,
        ]);
    }
}

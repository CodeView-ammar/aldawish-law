<?php

namespace Tasawk\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Tasawk\Models\CaseParty;
use Tasawk\Models\CaseType;
use Tasawk\Rules\PhoneNumber;
use Tasawk\Models\Order;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Notification;
use Tasawk\Notifications\Customer\NewOrderNotification;
use Tasawk\Notifications\AdminNewOrderNotification;
use Tasawk\Models\User;

class RequestConsultation extends Component
{
    use WithFileUploads;
    public $ristrict = 'cases';
    public $client_name;
    public $id_number;
    public $phone_number;

    public $country_code = 'SA';

    public $country_key  = "966";
    public $email;
    public $address;
    public $case_type = [];
    public $case_type_id;
    public $case_status;

    public $case_number;
    public $court;
    public $party_in_the_case = [];
    public $party_in_the_case_id;

    public $case_summary;
    public $file;
    public $successMessage;

    public function getRules()
    {
        return [
            'ristrict' => 'required|in:cases,arbitration',
            'client_name' => 'required|string|max:255',
            'id_number' => 'required|numeric',
            'phone_number' => ['required', new PhoneNumber($this->country_code)],
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'case_type_id' => 'required_if:ristrict,cases',
            'case_status' => 'required_if:ristrict,cases',
            'case_number' => 'required_if:case_status,existing',
            'court' => 'required_if:case_status,existing',
            'party_in_the_case_id' => 'required|exists:case_parties,id',
            'case_summary' => 'required_if:ristrict,cases|string',
            'file' => ['required'],
        ];
    }

    public function getValidationAttributes()
    {
        return [
            'ristrict' => __('site.ristrict'),
            'client_name' => __('site.client_name'),
            'id_number' => __('site.id_number'),
            'phone_number' => __('site.phone_number'),
            'email' => __('site.email'),
            'address' => __('site.address'),
            'case_type_id' => __('site.case_type'),
            'case_status' => __('site.case_status'),
            'case_number' => __('site.case_number'),
            'court' => __('site.court'),
            'party_in_the_case_id' => __('site.party_in_the_case'),
            'case_summary' => __('site.case_summary'),
            'file' => __('site.add_file_re'),
        ];
    }

    public function getMessages()
    {
        return [
            'case_type_id.required_if' => __('validation.required', ['attribute' => __('site.case_type')]),
            'case_status.required_if' => __('validation.required', ['attribute' => __('site.case_status')]),
            'court.required_if' => __('validation.required', ['attribute' => __('site.court')]),
            'case_number.required_if' => __('validation.required', ['attribute' => __('site.case_number')]),
            'case_summary.required_if' => __('validation.required', ['attribute' => __('site.case_summary')]),
        ];
    }



    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function mount()
    {


        $this->case_type = CaseType::select('id', 'name->en as name_en','name->fr as name_fr','name->de as name_de','name->zh as name_zh', 'name->ar as name_ar')
            ->where('status', 1)->get();
        $this->party_in_the_case = CaseParty::select('id', 'name->en as name_en','name->fr as name_fr','name->de as name_de','name->zh as name_zh', 'name->ar as name_ar')
            ->where('status', 1)->get();
        // $this->phone_number = auth()->guard('customer')->user()->phone;
        $this->email = auth()->guard('customer')->user()->email;
    }


    public function submitForm()
    {

        // dd($this->file);case_type
        $consultation = $this->validate();
        // dd($consultation);
        $consultation['ristrict'] = $this->ristrict;
        $consultation['client_name'] = $this->client_name;
        $consultation['id_number'] = $this->id_number;
        $consultation['customer_id'] = auth()->guard('customer')->id();
        $consultation['phone_number'] = "+".$this->country_key.$this->phone_number;
        $consultation['email'] = $this->email;
        $consultation['address'] = $this->address;
        $consultation['case_type'] = $this->case_type_id;
        $consultation['case_status'] = $this->case_status;
        $consultation['case_number'] = $this->case_number ?? null;
        $consultation['court'] = $this->court;
        $consultation['party_in_the_case'] = $this->party_in_the_case_id;
        $consultation['case_summary'] = $this->case_summary;
        $consultation['status'] = 'new';
        $consultation['order_number'] = sprintf("%'.03d", 1);
        $consultation['payment_status'] = 'pending';
        $consultation = Order::create($consultation);
        if ($this->file) {
            foreach ($this->file as $attachment) {
                $consultation->addMedia($attachment)->toMediaCollection('consultation');
            }
        }
        Notification::send($consultation->customer, new NewOrderNotification($consultation));
        Notification::send(User::whereHas("roles", fn($q) => $q->where('name', 'super_admin'))->first(), new AdminNewOrderNotification($consultation));
        Session::put('order_number', $consultation->order_number);
        $this->reset();
        redirect()->route('site.consultation.success');
    }

    public function render()
    {
        return view('livewire.request-consultation', [
            'case_type' => $this->case_type,
            'party_in_the_case' => $this->party_in_the_case,
        ]);
    }
}

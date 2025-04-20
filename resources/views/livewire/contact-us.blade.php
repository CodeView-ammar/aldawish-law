<form wire:submit.prevent="submitForm">
    @if ($successMessage)
        <div class="alert alert-success" role="alert">
            {{ $successMessage }}
        </div>
    @endif
    <div class="contact-us-form">
        <div class="contact-form-row">
            <div class="contact-form-input">
                <label class="form-label required">
                    {{ trans('site.full_name') }}
                </label>
                <input type="text" wire:model="name" class="form-input">
                @error('name')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <div class="contact-form-input">
            <div  wire:ignore>
                <label class="form-label required">
                    {{ trans('site.phone') }}
                                </label>
                <input type="tel" class="form-input"  wire:model="phone" id="phone_number" style="margin-right: 10px">
                <input type="hidden" wire:model="country_code" >
                <input type="hidden" wire:model="country_key" >

            </div>
            @error('phone')
            <small class="text-danger">
                {{ $message }}
            </small>
            @enderror
            </div>

        </div>
        <div class="contact-form-row">
            <div class="contact-form-input">
                <label class="form-label">
                    {{ trans('site.email') }}
                </label>
                <input type="email" wire:model="email" class="form-input">
                @error('email')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror
            </div>

            <div class="contact-form-input">
                <label class="form-label required">
                    {{ trans('site.message_type') }}
                </label>
                <div class="select" wire:model="contact_type_id">
                    <select class="form-input ">
                        <option value="0">
                            {{ trans('site.choose_from') }}
                        </option>
                        @foreach ($contact_type as $contact)
                            <option value="{{ $contact->id }}">{{ $contact->name }}</option>
                        @endforeach
                    </select>
                    @error('contact_type_id')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>
        </div>

        <label class="form-label required">
            {{ trans('site.contact_massage') }}
        </label>
        <textarea wire:model="message" class="form-input form-textarea"></textarea>
        @error('message')
            <small class="text-danger">
                {{ $message }}
            </small>
        @enderror
        <div class="submit-button">
            <button wire:loading.attr="disabled" wire:target="submitForm" class="submit-btn">
                <span wire:loading.remove wire:target="submitForm"> {{ trans('site.send') }}</span>
                <span wire:loading wire:target="submitForm">
                    <div class="spinner-border spinner-border-sm text-light" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div> {{ trans('site.send') }}
                </span>
            </button>
        </div>
    </div>
</form>
@push('scripts')

    <script>

        $(function () {
            document.getElementById("phone_number").addEventListener("countrychange", function () {
                @this.set('country_code', iti.getSelectedCountryData().iso2)
                @this.set('country_key', iti.getSelectedCountryData().dialCode);

            })
        })
    </script>

@endpush

@push('css')
<style>
    .form-control:disabled, .form-control[readonly] {
        background-color: white !important;
    }
    </style>

@endpush
<div class="careers-form-section">
    <h2 class="sign-in-success-title text-start  mb35">
        @lang('site.update profile')
    </h2>
    {{-- {{ dd(auth()->guard('customer')->user()->name) }} --}}
    <form class="careers-form">
        @if ($successMessage)
            <div class="alert alert-success" role="alert">
                {{ $successMessage }}
            </div>
        @endif
        @if ($errorMessage)
            <div class="alert alert-danger">
                {{ $errorMessage }}
            </div>
        @endif
        <label class="form-label required">
            @lang('site.full name')
        </label>
        <input type="text" class="form-input" placeholder="" value="{{ $name  }}"
            wire:model="name" required>
        @error('name')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        <label class="form-label required">
            @lang('site.gender')
        </label>
        <div class="checkbox-section ">
            <div class="radio-button-block checkbox-block">
                <div class=" radio-check">
                    <input type="radio" wire:model="gender" id="boy" value="male"  @if( $gender =='male')  checked @endif>
                    <label class="radio-btn-label" for="boy"> {{ trans('site.male') }}</label>
                </div>
            </div>
            <div class="radio-button-block checkbox-block">
                <div class=" radio-check">
                    <input type="radio" wire:model="gender" id="girl" value="female"  @if( $gender =='female')  checked @endif>
                    <label class="radio-btn-label" for="girl"> {{ trans('site.female') }}</label>
                </div>
            </div>
            @error('gender')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror
        </div>
        <div wire:ignore>
            <label class="form-label required">
                @lang('site.birthday')
            </label>
            <input type="text" class="form-input" wire:model="birthday" id="basicDate"  value="{{ $birthday }}"  data-input readonly="readonly">
        </div>
        @error('birthday')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        <label class="form-label required">
            @lang('site.address')
        </label>
        <input type="text" class="form-input" placeholder=""
            value="{{ auth()->guard('customer')->user()->address  }}" wire:model="address">
        @error('address')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        <label class="form-label required">
            @lang('site.nationality')
        </label>
        <div class="select" wire:model="nationality_id">
            <select class="form-input nationality-select" id="nationality_id" name="nationality_id" wire:model="nationality_id" selected >
                <option value="0">
                    {{ trans('site.choose_nationality') }}
                </option>
                @foreach ($nationalities as $nationality)
                    <option @if ($nationality_id == $nationality->id) selected @endif value="{{ $nationality->id }}" disabled>
                        {{ $nationality->name }}
                    </option>
                @endforeach
            </select>
            @error('nationality_id')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror
        </div>

        <div wire:ignore>
            <label class="form-label required">
                {{ trans('site.phone') }}
            </label>
            <input  type="tel"  wire:model="phone" id="phone_number"  class="form-input "   value="{{ $phone ?? '' }}">
            <input type="hidden" wire:model="country_code"  >
            <input type="hidden" wire:model="country_key">

        </div>
        @error('phone')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror
        <label class="form-label required">
            @lang('site.email')
        </label>
        <input type="email" class="form-input" placeholder="{{ $email ?? '' }}"
            value="{{ $email ?? '' }}" wire:model="email" disabled>
        @error('email')
            <p class="text-danger">{{ $message }}</p>
        @enderror

        <button type="submit" class="submit-btn margin-0" wire:click.prevent="editProfile">
            @lang('site.save changes')
        </button>
    </form>
</div>
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.js"></script>
    <script>
        $("#basicDate").flatpickr({
            altInput: true,
    altFormat: "F j, Y",
    dateFormat: "Y-m-d",


        });


    </script>


@endpush
@push("scripts")
    <script>
 $(function () {
            document.getElementById("phone_number").addEventListener("countrychange", function () {
                @this.set('country_code', iti.getSelectedCountryData().iso2)
                @this.set('country_key', iti.getSelectedCountryData().dialCode);
            })
        })

    </script>
@endpush

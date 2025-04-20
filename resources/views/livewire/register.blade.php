@push('css')
    <style>
        .form-control:disabled, .form-control[readonly] {
            background-color: white !important;
        }
        .d-none{
            display: none;
        }
    </style>

@endpush
<div class="careers-form-section">
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
        <input type="text" class="form-input" wire:model="name">
        @error('name')
        <p class="text-danger">{{ $message }}</p>
        @enderror
        <label class="form-label required">
            @lang('site.gender')
        </label>
        <div class="checkbox-section ">
            <div class="radio-button-block checkbox-block">
                <div class=" radio-check">
                    <input type="radio" wire:model="gender" id="boy" value="male" checked>
                    <label class="radio-btn-label" for="boy"> {{ trans('site.male') }}</label>
                </div>
            </div>
            <div class="radio-button-block checkbox-block">
                <div class=" radio-check">
                    <input type="radio" wire:model="gender" id="girl" value="female">
                    <label class="radio-btn-label" for="girl"> {{ trans('site.female') }}</label>
                </div>
            </div>
            @error('gender')
            <small class="text-danger">
                {{ $message }}
            </small>
            @enderror
        </div>
        {{-- <label class="form-label required">
            @lang('site.birthday')
        </label>
        <input type="date" class="form-input" wire:model="birthday"> --}}
        <div wire:ignore>
            <label class="form-label required">
                @lang('site.birthday')
            </label>
            <input type="text" class="form-input" wire:model="birthday" id="basicDate"
                   placeholder="{{ trans('site.enter_data') }}" data-input readonly="readonly">
        </div>
        @error('birthday')
        <p class="text-danger">{{ $message }}</p>
        @enderror
        <label class="form-label required">
            @lang('site.address')
        </label>
        <input type="text" class="form-input" wire:model="address">
        @error('address')
        <p class="text-danger">{{ $message }}</p>
        @enderror

        <label class="form-label required">
            {{ trans('site.nationality') }}
        </label>
        <input type="text" class="form-input" wire:model="nationality">
        {{-- <div class="select" wire:ignore>
            <select class="form-input nationality-select" id="nationality_id" name="nationality_id"
                    wire:model="nationality_id" selected >
                <option value="0">
                    {{ trans('site.choose_nationality') }}
                </option>
                @foreach ($nationalities as $nationality)
                    <option value="{{ $nationality->id }}">
                        {{ $nationality->name }}
                    </option>
                @endforeach
            </select>

        </div> --}}
        @error('nationality')
        <small class="text-danger">
            {{ $message }}
        </small>
        @enderror

        <div class="d-none passport_number" wire:ignore>
            <label class="form-label required">
                @lang('site.passport_number')
            </label>
            <input type="text" class="form-input" wire:model="passport_number">
            @error('passport_number')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div wire:ignore>
            <label class="form-label required">
                {{ trans('site.phone') }}
            </label>
            <input type="tel" wire:model="phone" id="phone_number" class="form-input" required >
            <input type="hidden" wire:model="country_code">
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
        <input type="email" class="form-input" wire:model="email">
        @error('email')
        <p class="text-danger">{{ $message }}</p>
        @enderror
        <div>
            <label class="form-label required">
                @lang('site.password')
            </label>
            <div class="password-block">
                <input type="password" class="form-input" id="pass" wire:model="password">
                <a onclick="togglePassword()">
                    <i class="fa-regular fa-eye-slash  password-icon" id="eye-slash"></i>
                    <i class=" fa-regular fa-eye password-icon" id="eye"></i>

                </a>
            </div>
            <span
                class="text-danger">{{ __('validation.password_field_must_be_at_least_8_characters,_including_one_capital_letter,_one_small_letter_and_one_symbol_at_least') }}</span>

            @error('password')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <label class="form-label required">
            @lang('site.password confirmation')
        </label>
        <div class="password-block">
            <input type="password" class="form-input" id="pass2" wire:model="password_confirmation">
            <a onclick="togglePassword2()">
                <i class="fa-regular fa-eye-slash  password-icon" id="eye-slash2"></i>
                <i class=" fa-regular fa-eye password-icon" id="eye2"></i>

            </a>
        </div>
        @error('password_confirmation')
        <p class="text-danger">{{ $message }}</p>
        @enderror

        <div class="checkbox">
            <input type="checkbox" class="input-radio-btn" id="remember" name="remember" value="0"
                   wire:model="remember">
            <label for="remember" class="remember-me"> @lang('site.i have read and agree to')
                <a href="{{ route('terms-condition') }}" class="register-link" target="__blank">
                    @lang('site.terms_conditions') </a>
            </label>
        </div>
        @error('remember')
        <p class="text-danger">{{ $message }}</p>
        @enderror
        <a href="{{ route('register-success') }}" type="submit" class="submit-btn sign-in-btn"
           wire:click.prevent="register">
            @lang('site.register')
        </a>
    </form>
</div>
@push('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.js"></script>
    <script type="module">


        $("#basicDate").flatpickr({
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",

        });

        document.addEventListener('DOMContentLoaded', function () {
            $('.nationality-select').on('change', function (e) {
                var data = $('.nationality-select').select2("val");
                @this.
                set('nationality_id', data);
            });

        });
        document.getElementById("phone_number").addEventListener("countrychange", function () {
            @this.
            set('country_code', iti.getSelectedCountryData().iso2)
            @this.set('country_key', iti.getSelectedCountryData().dialCode);
        })


        $('#nationality_id').on('change', function () {
            var selectVal = $("#nationality_id option:selected").val();

            if (selectVal == 1) {
                // $('.id_number').removeClass('d-none');
                $('.passport_number').addClass('d-none');
            } else {
                // $('.id_number').addClass('d-none');
                $('.passport_number').removeClass('d-none');
            }

        });


    </script>

@endpush
{{-- @push("scripts")
    <script>
 $(function () {
            document.getElementById("phone_number").addEventListener("countrychange", function () {
                @this.
                set('country_code', iti.getSelectedCountryData().iso2)
            })
        })

    </script>
@endpush --}}



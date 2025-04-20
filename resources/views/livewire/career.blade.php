<div class="careers-form-section">
    <form wire:submit.prevent="submitForm">
        @if ($successMessage)
            <div class="alert alert-success" role="alert">
                {{ $successMessage }}
            </div>
        @endif
        <div>
            <label class="form-label required">
                {{ trans('site.full_name') }}
            </label>
            <input type="text" wire:model="name" class="form-input" required>
            @error('name')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror
        </div>
        <label class="form-label required">
            {{ trans('site.gender') }}
        </label>
        <div>
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
            </div>
            @error('gender')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror
        </div>
        <div>
            <label class="form-label required">
                {{ trans('site.age') }}
            </label>
            <input type="text" wire:model="age" class="form-input" required>
            @error('age')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror
        </div>
        <div>
            <label class="form-label required">
                {{ trans('site.address') }}
            </label>
            <input type="text" wire:model="address" class="form-input" required>
            @error('address')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror
        </div>
        <div wire:ignore>
            <label class="form-label required">
                {{ trans('site.phone') }}
            </label>
            <input  type="tel"  wire:model="phone" id="phone_number"  class="form-input " >
            <input type="hidden" wire:model="country_code" >
        </div>

        @error('phone')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror
        <div>
            <label class="form-label required">
                {{ trans('site.email') }}
            </label>
            <input type="email" wire:model="email" class="form-input" required>
            @error('email')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror
        </div>
        <div>
            <label class="form-label required">
                {{ trans('site.job_title') }}
            </label>
            <input type="text" wire:model="job_title" class="form-input" required>
            @error('job_title')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror
        </div>
        <div>
            <label class="form-label required">
                {{ trans('site.postion') }}
            </label>
            <input type="text" wire:model="position" class="form-input" required>
            @error('position')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror
        </div>
        <div>
            <label class="form-label required">
                {{ trans('site.cv') }}
            </label>
            <div class="upload__box">
                <div class="upload__btn-box">
                    <label class="form-input upload__btn" id="file" for="customFile">
                        <b class="upload-file"> {{ trans('site.add_file') }}</b>
                        <input type="file" wire:model="cv" class="upload-change" id="customFile">
                    </label>
                </div>
            </div>
            @error('cv')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror

        </div>
        <button wire:loading.attr="disabled" wire:target="submitForm" class="submit-btn">
            <span wire:loading.remove wire:target="submitForm"> {{ trans('site.send') }}</span>
            <span wire:loading wire:target="submitForm">
                <div class="spinner-border spinner-border-sm text-light" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div> {{ trans('site.send') }}
            </span>
        </button>
    </form>
</div>
@push('scripts')

    <script>

        $(function () {
            document.getElementById("phone_number").addEventListener("countrychange", function () {
                @this.
                set('country_code', iti.getSelectedCountryData().iso2)
            })
        })
    </script>

@endpush

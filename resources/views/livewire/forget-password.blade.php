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
        @if($type =='phone')
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
        @endif
        @if($type =='email')

        <label class="form-label ">
            @lang('site.email')
        </label>
        <input type="email" class="form-input" required wire:model="email">
        @error('email')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        @endif
        <a href="#" type="submit" class="submit-btn sign-in-btn" wire:click.prevent="resetPassword">
            @lang('site.send')
        </a>
    </form>
</div>

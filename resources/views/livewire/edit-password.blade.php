<div class="careers-form-section">
    <h2 class="sign-in-success-title text-start mb35">
        @lang('site.change password')
    </h2>
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
            @lang('site.current password')
        </label>
        <div class="password-block">
            <input type="password" class="form-input" id="pass" wire:model="old_password">
            <a onclick="togglePassword()">
                <i class="fa-regular fa-eye-slash  password-icon" id="eye-slash"></i>
                <i class=" fa-regular fa-eye password-icon" id="eye"></i>

            </a>
        </div>
        @error('old_password')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        <label class="form-label required">
            @lang('site.new password')
        </label>
        <div class="password-block">
            <input type="password" class="form-input" id="pass2" wire:model="password">
            <a onclick="togglePassword2()">
                <i class="fa-regular fa-eye-slash  password-icon" id="eye-slash2"></i>
                <i class=" fa-regular fa-eye password-icon" id="eye2"></i>

            </a>
        </div>
        @error('password')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        <label class="form-label required">
            @lang('site.confirmation new password')
        </label>
        <div class="password-block">
            <input type="password" class="form-input" id="pass3" wire:model="password_confirmation">
            <a onclick="togglePassword3()">
                <i class="fa-regular fa-eye-slash  password-icon" id="eye-slash3"></i>
                <i class=" fa-regular fa-eye password-icon" id="eye3"></i>

            </a>
        </div>
        @error('password_confirmation')
            <p class="text-danger">{{ $message }}</p>
        @enderror

        <button href="#" type="submit" class="submit-btn margin-0" wire:click.prevent="editPassword">
            @lang('site.save changes')
        </button>
    </form>
</div>

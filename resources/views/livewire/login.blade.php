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
        <label class="form-label ">
            @lang('site.email')
        </label>
        <input type="email" class="form-input" wire:model="email" required>
        @error('email')
            <p class="text-danger">{{ $message }}</p>
        @enderror

        <label class="form-label">
            @lang('site.password') </label>
        <div class="password-block">
            <input type="password" class="form-input" id="pass" wire:model="password">
            <a onclick="togglePassword()">
                <i class="fa-regular fa-eye-slash  password-icon" id="eye-slash"></i>
                <i class=" fa-regular fa-eye password-icon" id="eye"></i>

            </a>
        </div>
        @error('password')
            <p class="text-danger">{{ $message }}</p>
        @enderror

        <div class="forget-password-bar">
            <div class="checkbox">
                <input type="checkbox" class="input-radio-btn" id="remember" name="remember" value="remember">
                <label for="remember" class="remember-me"> @lang('site.remember me')</label>
            </div>
            <a href="{{ route('forget-password') }}" class="forget-password-link">
                @lang('site.did you forget your password?') </a>
        </div>


        <button type="submit" class="submit-btn sign-in-btn" wire:click.prevent="login">
            @lang('site.login')
        </button>
    </form>
</div>

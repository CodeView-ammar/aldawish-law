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
        <label class="form-label">
            @lang('site.new password')
        </label>
        <input type="password" class="form-input" wire:model="password">
        @error('password')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        <label class="form-label">
            @lang('site.confirmation new password')
        </label>
        <input type="password" class="form-input" wire:model="password_confirmation">
        @error('password_confirmation')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        <button type="submit" class="submit-btn sign-in-btn" wire:click.prevent="updatePassword">
            @lang('site.reset')
        </button>
    </form>
</div>

<div class="careers-form-section ">
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

        <div class="verefecation-list" x-data="{ focusedInput: 0 }">
            <input type="text" class="inputs verefication-input" maxlength="1" wire:model="otp.0"
                   autofocus
            >

            <input type="text" class="inputs verefication-input" maxlength="1" wire:model="otp.1"
            >

            <input type="text" class="inputs verefication-input" maxlength="1" wire:model="otp.2"
            >

            <input type="text" class="inputs verefication-input" maxlength="1" wire:model="otp.3"
            >
        </div>
        @error('otp')
        <p class="text-danger">{{ $message }}</p>
        @enderror
            <div x-data="timer(new Date().setDate(new Date().getDate() + 1))" x-init="init();">


                <div class="timee" x-show="!showResendAction">
                    <span>00</span>:
                    <span x-text="time().seconds"></span>
                </div>

                <div x-cloak>
                    <h2 class="sign-in-title" x-show="showResendAction">
                        @lang('site.did not you receive the message?')
                        <a wire:click="resend" class="register-link resend" >
                            @lang('site.resend')
                        </a>
                    </h2>
                </div>
            </div>

        <a href="{{ route('register-success') }}" type="submit" class="submit-btn confirm-btn"
           wire:click.prevent="verify">
            @lang('site.confirm')
        </a>
    </form>
</div>

@push('scripts')
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        function timer(expiry) {
            return {
                expiry: expiry,
                remaining: null,
                showResendAction: false,
                init() {

                    setInterval(() => {
                        this.setRemaining();
                        // this.showResendAction=true;
                    }, 1000);
                },
                setRemaining() {
                    const diff = this.expiry - new Date().getTime();

                    this.remaining = parseInt(diff / 1000);
                    if (this.seconds().value <=0) {
                        this.showResendAction = true;

                    }


                },
                days() {
                    return {
                        value: this.remaining / 86400,
                        remaining: this.remaining % 86400
                    };
                },
                hours() {
                    return {
                        value: this.days().remaining / 3600,
                        remaining: this.days().remaining % 3600
                    };
                },
                minutes() {
                    return {
                        value: this.hours().remaining / 60,
                        remaining: this.hours().remaining % 60
                    };
                },
                seconds() {

                    return {
                        value: this.minutes().remaining,
                    };
                },
                format(value) {
                    return ("0" + parseInt(value)).slice(-2)
                },
                time() {
                    return {
                        seconds: this.format(this.seconds().value),
                    }
                },
            }
        }

    </script>
@endpush

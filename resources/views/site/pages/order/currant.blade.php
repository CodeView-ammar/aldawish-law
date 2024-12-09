<div class="meeting-pay-section">
    @if ($order->status->value != 'rejected')
        <div class="pay-details mb30">
            <h3 class="order-details-title">
                {{ trans('site.meeting details') }}
            </h3>
            <label class="pay-label">
                {{ trans('site.date') }}
            </label>
            <span class="meeting-answer">
                {{ $order->date->format('Y-m-d') }}
            </span>
            <label class="pay-label">
                {{ trans('site.time') }}
            </label>
            <span class="meeting-answer">
                {{ $order->date->format('H:i') }}
            </span>
            <label class="pay-label">
                {{ trans('site.session duration') }}
            </label>
            <span class="meeting-answer">
                {{ $order->duration_text }}
            </span>
            <?php
            $now = Carbon\Carbon::now();
            $start = Carbon\Carbon::parse($order->date);
            $end = Carbon\Carbon::parse($order->date)->addMinutes($order->duration);
            // dd($now->between($start, $end));
            ?>
            @if ($now->between($start, $end) && $order->payment_status->value == 'paid')
                @if (!$sessionRunning)
                    <button type="submit" id="startCallBtn" wire:click="startSession" class="submit-btn  w-100">
                        {{ trans('site.enter meeting') }}
                    </button>
                @endif
            @endif
        </div>
    @endif
    <div class="pay-details">
        <h3 class="order-details-title">
            {{ trans('site.payment details') }}
        </h3>
        <label class="pay-label">
            {{ trans('site.Session cost') }}
        </label>
        <span class="money">
            {{ \Cknow\Money\Money::parse($order->total)->getAmount() / 100 }}
            @lang('forms.suffixes.sar')
        </span>
        <label class="pay-label">
            {{ trans('site.payment method') }}
        </label>
        <span class="meeting-answer">
            @if ($order->payment_type == 'visa')
                {{ trans('site.visa') }}
                <img class="pay-img" src="{{ asset('site/images/payment-methods/01.png') }}"
                    alt="payment method"></label>
            @elseif($order->payment_type == 'mada')
                {{ trans('site.mada') }}
                <img class="pay-img" src="{{ asset('site/images/payment-methods/02.png') }}"
                    alt="payment method"></label>
            @elseif($order->payment_type == 'bank_transfer_receipt')
                {{ trans('site.bank_transfer') }}
                {{-- <img class="pay-img" src="{{ asset('site/images/payment-methods/02.png') }}" alt="payment method"> --}}
                </label>
            @elseif($order->payment_type == 'pay')
                {{ trans('site.apple pay') }}
                <img class="pay-img" src="{{ asset('site/images/payment-methods/03.png') }}"
                    alt="payment method"></label>
            @endif
        </span>
        {{--  @if ($order->payment_type == 'bank_transfer_receipt')
            <label class="pay-label">
                {{ trans('site.iban_number') }}
            </label>
            <span style="    font-size: 14px;">
                {{ $setting?->iban_number ?? '' }} </span>
            <label class="pay-label">
                {{ trans('site.account_number') }}
            </label>
            <span style="    font-size: 14px;">
                {{ $setting?->account_number ?? '' }}
            </span>
        @endif  --}}
    </div>
</div>

@push('scripts')
    <script>
        document.getElementById('startCallBtn').addEventListener('click', function(event) {
            event.preventDefault();
            window.scrollTo(0, 0);
            document.getElementById('meeting-pay-section').submit();
        });
    </script>
@endpush

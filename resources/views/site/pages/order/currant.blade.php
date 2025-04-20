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
            @if($order->payment_status->value=='paid')
            <!-- إضافة رابط الاجتماع -->
            @if ($order->meeting_link) <!-- إذا كان هناك رابط اجتماع -->
                <label class="pay-label">
                {{ trans('site.enter meeting') }}
                </label>
                <span class="meeting-answer" style="width: -webkit-fill-available;">
                    <a href="{{ $order->meeting_link }}"  class="submit-btn w-300" target="_blank" style="width: auto;">{{ trans('site.enter meeting') }}</a>
                </span>
            @endif
            @endif

            <?php
                date_default_timezone_set('Asia/Riyadh'); // تغييرها حسب المنطقة الزمنية المطلوبة
                $now = Carbon\Carbon::now()->startOfMinute();  // تجاهل الثواني
                $start = Carbon\Carbon::parse($order->date)->startOfMinute(); // تجاهل الثواني في وقت البداية
                $end = $start->copy()->addMinutes($order->duration); // تأكد من أنك تستخدم نسخة لتجنب تعديل $start
                $isBetween = $now->between($end, $start);

            ?>
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
                <img class="pay-img" src="{{ asset('site/images/payment-methods/01.png') }}" alt="payment method">
            @elseif($order->payment_type == 'mada')
                {{ trans('site.mada') }}
                <img class="pay-img" src="{{ asset('site/images/payment-methods/02.png') }}" alt="payment method">
            @elseif($order->payment_type == 'bank_transfer_receipt')
                {{ trans('site.bank_transfer') }}
            @elseif($order->payment_type == 'pay')
                {{ trans('site.apple pay') }}
                <img class="pay-img" src="{{ asset('site/images/payment-methods/03.png') }}" alt="payment method">
            @endif
        </span>
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

@push('css')
<style>
    .form-input2 {
        width: 244px;
        height: 54px;
        display: flex;
        align-items: center;
        background-color: #fff;
        border-radius: 25px;
        border: 2px solid rgb(220, 231, 238);
        transition: 1.5s;
        padding: 0px 13px;
        outline: none;
        margin: 12px -8px 19px;
        position: relative;
        color: rgb(128, 128, 128);
        font-size: 13px;
    }

</style>
@endpush
<div x-data="{ show: false }">

    <div class="pay-details">
        <h3 class="order-details-title">

            {{ trans('site.payment details') }}
        </h3>
        <label class="pay-label">

            {{ trans('site.Session cost') }}
        </label>
        <span class="money">
            {{\Cknow\Money\Money::parse( $order->total)->getAmount()/100 }}
            {{ trans('forms.suffixes.sar') }}
        </span>
        <label class="pay-label">
            {{ trans('site.Choose the appropriate payment method') }}
        </label>
        <form wire:submit.prevent="submitForm">
            <div class="checkbox-section flex-wrap margin-0">

                <div class="radio-button-block checkbox-block mb20">
                    <div class=" radio-check">
                        <input type="radio" id="visa" wire:model="payment_type" name="ristrict" value="visa" @click="show = false">
                        <label class="radio-btn-label payment-radio-label" for="visa">
                            {{ trans('site.visa') }}
                            <img class="pay-img" src="{{ asset('site/images/payment-methods/01.png') }}" alt="payment method"></label>
                    </div>
                </div>
                <div class="radio-button-block checkbox-block mb20">
                    <div class=" radio-check">
                        <input type="radio" id="mada" wire:model="payment_type" name="ristrict" value="mada" @click="show = false">
                        <label class="radio-btn-label  payment-radio-label" for="mada">
                            {{ trans('site.mada') }}
                            <img class="pay-img" src="{{ asset('site/images/payment-methods/02.png') }}" alt="payment method"></label>
                    </div>
                </div>
                <div class="radio-button-block checkbox-block mb20">
                    <div class=" radio-check">
                        <input type="radio" id="pay" wire:model="payment_type" name="ristrict" value="pay" @click="show = false">
                        <label class="radio-btn-label  payment-radio-label" for="pay">
                            {{ trans('site.apple pay') }}
                            <img class="pay-img" src="{{ asset('site/images/payment-methods/03.png') }}" alt="payment method"></label>
                    </div>
                </div>
                <div class="radio-button-block checkbox-block" style="margin-bottom: 10px;">
                    <div class="radio-check">
                        <input type="radio" id="bank_transfer" wire:model="payment_type" name="ristrict" value="bank_transfer" @click="show = true">
                        <label class="radio-btn-label payment-radio-label" for="bank_transfer">
                            {{ trans('site.bank_transfer') }}
                            <img class="pay-img" src="{{ asset('site/images/payment-methods/bank-transfer.png') }}" alt="payment method" style="width: 25px !important;">
                        </label>
                    </div>
                </div>
                <div x-show="show">
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
                </br>

                    <span class="address-type" style="width: 121px !important;">
                        {{ trans('site.bank_transfer_receipt') }}
                    </span>
                    <div class="upload__box">
                        <div class="upload__btn-box">
                            <label class="custom-file-upload form-input2">
                                <input type="file" wire:model="bank_transfer_receipt" class="upload-change"  />
                                <span class="upload-btn file-txt" data-title=""></span>
                            </label>
                        </div>
                    </div>
                    @error('bank_transfer_receipt')
                    <small class="text-danger" style="margin-top: 10px !important;">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
            </div>
            <button wire:loading.attr="disabled" wire:target="submitForm" class="submit-btn w-100">
                <span wire:loading.remove wire:target="submitForm"> {{ trans('site.payment') }}</span>
                <span wire:loading wire:target="submitForm">
                    <div class="spinner-border spinner-border-sm text-light" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div> {{ trans('site.payment') }}
                </span>
            </button>

    </div>
</div>

@extends('site.layouts.master')
@section('page_title', __('site.payments'))
@section('meta_title', __('site.payments'))
@section('body_class', 'inner-page')
@section('content')

@include('site.layouts.app.breadcrumb')

<!-- end breadcrumb -->


<!-- about-section -->
<div class="about-us-section">
    <div class="container">
        <div class="careers-section">
            <div class="edit-account-section">
                @include('site.layouts.app.profile_menue')

                <div class="careers-form-section w-848">

                    <h2 class="sign-in-success-title text-start mb35 ">
                        @lang('site.payments')
                    </h2>
                    @if($payments->count() > 0)
                    <div class="pay-table">
                        <table class="payments-table">
                            <tr class="thead">
                                <th>
                                    @lang('site.id')
                                </th>
                                <th>
                                    @lang('site.invoice_number')
                                </th>
                                <th>
                                    @lang('site.reservation_number')
                                </th>
                                <th>
                                    @lang('site.paid_amount')
                                </th>
                                <th>
                                    @lang('site.payment_method')
                                </th>
                                <th>
                                    @lang('site.invoice')
                                </th>
                            </tr>

                            @foreach ($payments as $order)
                            <tr class="thead table-row">
                                <td>
                                    #{{ $order->id }}
                                </td>
                                <td>
                                    INV {{ $order?->payment_data['InvoiceId'] ?? '' }}
                                </td>
                                <td>
                                    {{ $order->order_number }}
                                </td>
                                <td>
                                    {{ $order->total }} {{ trans('forms.suffixes.sar') }}
                                </td>
                                <td>
                                    @if ($order->payment_type == 'visa')
                                    {{ trans('site.visa') }}
                                    <img class="pay-img" src="{{ asset('site/images/payment-methods/01.png') }}" alt="payment method"></label>
                                    @elseif($order->payment_type == 'mada')
                                    {{ trans('site.mada') }}
                                    <img class="pay-img" src="{{ asset('site/images/payment-methods/02.png') }}" alt="payment method"></label>
                                    @elseif($order->payment_type == 'pay')
                                    {{ trans('site.apple pay') }}
                                    <img class="pay-img" src="{{ asset('site/images/payment-methods/03.png') }}" alt="payment method"></label>
                                    @endif
                                </td>
                                @if($order?->payment_data['invoiceURL'] != null)
                                <td>
                                    <button class="download-btn">
                                        <a target="_blank" href="{{ $order?->payment_data['invoiceURL']  }}" download="{{ $order?->payment_data['invoiceURL']  }}">
                                            {{ trans('site.download') }}
                                        </a>
                                    </button>
                                </td>
                                @endif
                            </tr>
                            @endforeach

                        </table>
                    </div>
                    @else

                    <div class="about-us-section height-auto">
                        <div class="container">
                            <div class="careers-section">
                                <p class="success-text">
                                    @lang('site.Order_payment_empty')
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="payments-pagination">
                        <ul class="services-pagination">
                            {{ $payments->links() }}
                        </ul>
                    </div>


                </div>
            </div>


        </div>

    </div>
</div>

@endsection
@push('scripts')
<script>
    function togglePassword() {

        var x = document.getElementById("pass");
        var eyeSlash = document.getElementById("eye-slash");
        var eye = document.getElementById("eye");
        if (x.type === "password") {
            x.type = "text";
            eyeSlash.style.display = "none";
            eye.style.display = "block";

        } else {
            x.type = "password";
            eyeSlash.style.display = "block";
            eye.style.display = "none";
        }
    }

</script>
@endpush

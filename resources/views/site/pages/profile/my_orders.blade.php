@extends('site.layouts.master')
@section('page_title', __('site.my orders'))
@section('meta_title', __('site.my orders'))
@section('body_class', 'inner-page')
@section('content')

    @include('site.layouts.app.breadcrumb')

    <div class="about-us-section">
        <div class="container">
            <div class="careers-section">
                <div class="edit-account-section">
                    @include('site.layouts.app.profile_menue')
                    <div class="careers-form-section w-848">

                        <h2 class="sign-in-success-title text-start mb35 ">
                            @lang('site.my orders')
                        </h2>
                        @if ($orders->count() > 0)
                            @foreach ($orders as $order)
                                <a href="order-new.html" class="order-link">
                                    <div class="notification-block order-block">
                                        <div class="order-det">
                                            <div class="order-det-row">
                                                <label class="order-labels">
                                                    @lang('site.order id')
                                                </label>
                                                <span class=" order-answer">
                                                    {{ $order->order_number }}
                                                </span>
                                            </div>
                                            <div class="order-det-row">
                                                <label class="order-labels">
                                                    @lang('site.order date')
                                                </label>
                                                <span class=" order-answer">
                                                    {{ $order->date_text ?? '' }}
                                                </span>
                                            </div>
                                        </div>

                                        <div class="order-det">
                                            <div class="order-det-row">
                                                <label class="order-labels">
                                                    @lang('site.order type')
                                                </label>
                                                <span class=" order-answer">
                                                    {{ $order->ristrict_name }}
                                                </span>
                                            </div>
                                            <div class="order-det-row">
                                                <label class="order-labels">
                                                    @lang('site.order status')
                                                </label>
                                                <span class="order-status {{ $order?->status?->getColorClass() }}}">
                                                    {{ $order->status->getLabel() }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach

                        @endif
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

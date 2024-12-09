@extends('site.layouts.master')
@section('page_title', __('site.verify_otp_code'))
@section('meta_title', __('site.verify_otp_code'))
@section('body_class', 'inner-page')
@section('content')

    @include('site.layouts.app.breadcrumb')

    <div class="about-us-section ">
        <div class="container">
            <div class="careers-section verefication-section">
                <h2 class="sign-in-title w-480">
                    @lang('site.enter the verification code sent in a text message to your registered mobile number to be able to complete the  reset passowrd')
                </h2>
                <livewire:verification-forget-password />

            </div>

        </div>
    </div>
@endsection

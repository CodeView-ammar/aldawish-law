@extends('site.layouts.master')
@section('page_title', __('site.new registration'))
@section('meta_title', __('site.new registration'))
@section('body_class' , 'inner-page')
@section('content')

    @include('site.layouts.app.breadcrumb')

    <div class="about-us-section height-auto">
        <div class="container">
            <div class="careers-section">
                <img class="success-img" src="{{ asset('site/images/success.png') }}" alt="success sign in">
                <h2 class="sign-in-success-title">
                    @lang('site.your account has been registered successfully')
                </h2>
                <p class="success-text">
                    @lang('site.thank you for choosing Othman Ahmed Al-Dawish Law Firm and Legal Consultations')
                </p>
                <p class="success-text">
                    @lang('site.you can now log in and start requesting legal advice')
                </p>
                <a href="{{ route('login') }}" type="submit" class="submit-btn">
                    @lang('site.sign in')
                </a>
            </div>

        </div>
    </div>
@endsection

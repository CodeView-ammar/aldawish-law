@extends('site.layouts.master')
@section('page_title', __('site.services'))
@section('body_class', 'inner-page')
@section('content')
    <div class="breadcrumb-section">
        <h2 class="breadcrumb-head">{{ trans('site.request-consultation') }}</h2>
        <ol class="breadcrumb">
            <li class="item-home">
                <a class="bread-link bread-home" href="{{ route('index') }}">{{ trans('site.home') }}</a>
            </li>

            <li class="active item-23">
                <span class="bread-current">{{ trans('site.request-consultation') }}</span>
            </li>
        </ol>
    </div>
    <div class="about-us-section height-auto">
        <div class="container">
            <div class="careers-section">
                <img class="success-img" src="{{ asset('site/images/success.png') }}" alt="success sign in">
                <h2 class="sign-in-success-title">
                    {{ trans('site.your_request_has_been_payment_successfully') }}
                </h2>
                <p class="success-text">
                    {{ trans('site.thank you for choosing Othman Ahmed Al-Dawish Law Firm and Legal Consultations') }}
                </p>
                <p class="success-text">
                    {{ trans('site.your_order_number') }}
                    <span class="order-number">
                        #{{ Session::get('order_number') }}
                    </span>
                    {{ trans('site.share_orders') }}
                </p>
                <a href="{{ route('site.profile.myOrders') }}" type="submit" class="submit-btn">
                    {{ trans('site.orders') }}
                </a>
            </div>

        </div>
    </div>

@endsection

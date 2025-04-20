@extends('site.layouts.master')
@section('page_title', __('site.my_orders'))
@section('body_class', 'inner-page')
@section('content')
    <div class="breadcrumb-section">
        <h2 class="breadcrumb-head">{{ trans('site.my_orders') }}</h2>
        <ol class="breadcrumb">
            <li class="item-home">
                <a class="bread-link bread-home" href="{{ route('index') }}">{{ trans('site.home') }}</a>
            </li>

            <li class="active item-23">
                <span class="bread-current">{{ trans('site.my_orders') }}</span>
            </li>
        </ol>
    </div>
    <div class="about-us-section">
        <div class="container">
            <div class="careers-section">
                <div class="edit-account-section">
                    @include('site.layouts.app.profile_menue')
                    <div class="careers-form-section w-848">
                        <h2 class="sign-in-success-title text-start mb35">
                            {{ trans('site.my_orders') }}
                        </h2>
                        @foreach ($orders as $order)
                        
                            <a href="{{ route('site.order-details',$order->id) }}" class="order-link">
                                <div class="notification-block order-block">
                                    <div class="order-det">
                                        <div class="order-det-row">
                                            <label class="order-labels">
                                                {{ trans('site.order_number') }}
                                            </label>
                                            <span class=" order-answer">
                                                #{{ $order->order_number }}
                                            </span>
                                        </div>
                                        <div class="order-det-row">
                                            <label class="order-labels">
                                                {{ trans('site.order date') }}
                                            </label>
                                            <span class=" order-answer">
                                                {{ $order->date_text }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="order-det">
                                        <div class="order-det-row">
                                            <label class="order-labels">
                                                {{ trans('site.order type') }}
                                            </label>
                                            <span class=" order-answer">
                                                {{ $order->ristrict_name }}
                                            </span>
                                        </div>
                                        <div class="order-det-row">
                                            <label class="order-labels">
                                                {{ trans('site.order status') }}
                                            </label>
                                            <span class="order-status {{ $order?->status?->getColorClass() }}">
                                                {{ $order->status->getLabel() }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach

                    </div>
                </div>


            </div>

        </div>
    </div>

@endsection

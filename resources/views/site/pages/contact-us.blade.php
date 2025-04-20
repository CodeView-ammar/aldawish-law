@extends('site.layouts.master')
@section('page_title', ' / ' . __('site.contact_us'))
@section('body_class', 'inner-page')
@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-section">
        <h2 class="breadcrumb-head">{{ trans('site.contact_us') }}</h2>
        <ol class="breadcrumb">
            <li class="item-home">
                <a class="bread-link bread-home" href="{{ route('index') }}">{{ trans('site.home') }}</a>
            </li>
            <li class="active item-23">
                <span class="bread-current">{{ trans('site.contact_us') }}</span>
            </li>
        </ol>
    </div>
    <!-- end breadcrumb -->
    <div class="about-us-section">
        <div class="container">
            <div class="contact-us-section">
                <div class="contact-us-text">
                    <h2 class="careers-title mb-24">
                        {{ trans('site.contact_desc') }}
                    </h2>
                    <ul class="contact-us-list">
                        <li>
                            <i class="las la-map-marker-alt contact-us-icon"></i>
                            <b> {{ trans('site.main_office') }}
                                <span>
                                    
                                    <a href="https://maps.app.goo.gl/BeDSkayfacTdNkNU6?g_st=ac" target="_blank">{{ $app_location[app()->getLocale()] ?? '' }}</a>
                                </span>
                            </b>
                        </li>
                        <li>
                            <i class="las la-mobile contact-us-icon"></i>
                            <b>
                                {{ trans('site.phone_number') }}
                                <span>
                                <a href="tel:{{ $phone }}">{{ $phone }}</a>                                    
                                </span>
                            </b>
                        </li>
                        <li>
                            <i class="las la-envelope contact-us-icon"></i>
                            <b>
                                {{ trans('site.email') }}
                                <span>
                                <a href="mailto:{{ $email }}">{{ $email }}</a>
                                </span>
                            </b>
                        </li>
                    </ul>
                    <ul class="social-list">
                        @foreach ($social_media as $media)
                            <li class="social-list-link">
                                <a href="{{ $media['link'] }}" target="_blank">
                                    <i class="fa-brands fa-{{ $media['icon'] }} social-icon"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <livewire:contact-us />
            </div>
        </div>
    </div>
    <!-- about-section -->

@endsection

@extends('site.layouts.master')
@section('page_title', ' / ' .  __('site.faq'))
@section('body_class', 'inner-page')
@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-section">
        <h2 class="breadcrumb-head">{{ trans('site.faq') }}</h2>
        <ol class="breadcrumb">
            <li class="item-home">
                <a class="bread-link bread-home" href="{{ route('index') }}">{{ trans('site.home') }}</a>
            </li>
            <li class="active item-23">
                <span class="bread-current">{{ trans('site.faq') }}</span>
            </li>
        </ol>
    </div>
    <!-- end breadcrumb -->

    <!-- about-section -->
    <div class="about-us-section">
        <div class="container">
            <div class="faq-section">
                <h2 class="careers-title">
                   {{ trans('site.faq_section') }}
                </h2>
                <div class="faq-content">
                    @if (!is_null($faqs))
                        @foreach ($faqs as $faq)
                            <div class="accordion">
                                <label class="accordion__title" for="radio_1">
                                    <input id="radio_1" type="radio" name="radio"  />
                                    <span class="faq-number">
                                        {{ $loop->iteration }}
                                    </span>
                                    {{ $faq->question }}
                                </label>
                                <div class="accordion__text">
                                    <p class="faq-answer">
                                        {{ $faq->answer }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    @endif


                </div>
            </div>
        </div>
    </div>
@endsection

@extends('site.layouts.master')
@section('page_title', ' / ' . __('site.privacy_policy'))
@section('body_class', 'inner-page')
@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-section">
        <h2 class="breadcrumb-head">{{ trans('site.privacy_policy') }}</h2>
        <ol class="breadcrumb">
            <li class="item-home">
                <a class="bread-link bread-home" href="{{ route('index') }}">{{ trans('site.home') }}</a>
            </li>
            <li class="active item-23">
                <span class="bread-current">{{ trans('site.privacy_policy') }}</span>
            </li>

        </ol>
    </div>
    <div class="about-us-section terms-section">
        <div class="container">
            <div class="terms-conditions-section">
                <div class="terms-conditions-content">
                    <span class="date">
                        {{ trans('site.last_update') }}
                        {{ \Carbon\Carbon::parse($privacy->updated_at)->format('d-m-Y') }}
                    </span>
                    <div data-bs-spy="scroll" data-bs-target="#list-example" data-bs-smooth-scroll="true"
                        class="scrollspy-example" tabindex="0">
                        {!! Markdown::parse($privacy['description']) !!}
                    </div>
                </div>


                {{-- <div class="terms-conditions-titles">
                    <div id="list-example" class="list-group terms-conditions-group">
                        <h2 class="terms-conditions-group-title">
                            {{ trans('site.content') }}
                        </h2>

                    </div>
                </div> --}}



            </div>
        </div>
    </div>

@endsection

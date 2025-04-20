@extends('site.layouts.master')
@section('page_title', __('site.did you forget your password?'))
@section('meta_title', __('site.did you forget your password?'))
@section('body_class', 'inner-page')

@section('content')

    @include('site.layouts.app.breadcrumb')

    <div class="about-us-section height-auto">
        <div class="container">
            <div class="careers-section">
                <h2 class="sign-in-title">
                    @lang('site.enter your registered phone and you will receive a link to recover your password')
                </h2>
                <livewire:forget-password />

            </div>

        </div>
    </div>
@endsection

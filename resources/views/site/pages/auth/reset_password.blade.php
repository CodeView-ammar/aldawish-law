@extends('site.layouts.master')
@section('page_title', __('Login'))
@section('meta_title', __('Login'))
@section('body_class', 'inner-page')

@section('content')

    @include('site.layouts.app.breadcrumb')
    <div class="about-us-section height-auto">
        <div class="container">
            <div class="careers-section">
                <h2 class="sign-in-title">
                    @lang('site.the new password must be different from the previously used password')
                </h2>
                <livewire:reset-password />

            </div>

        </div>
    </div>
@endsection

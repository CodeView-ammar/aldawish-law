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
    <div class="about-us-section">
        <div class="container">
            <div class="careers-section">

                <div class="careers-form-section">
                   <livewire:request-consultation />
                </div>
            </div>

        </div>
    </div>

@endsection

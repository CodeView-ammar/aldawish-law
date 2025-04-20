@extends('site.layouts.master')
@section('page_title',' / ' . __('site.careers'))
@section('body_class', 'inner-page')
@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-section">
        <h2 class="breadcrumb-head">{{ trans('site.careers') }}</h2>
        <ol class="breadcrumb">
            <li class="item-home">
                <a class="bread-link bread-home " href="{{ route('index') }}">{{ trans('site.home') }}</a>
            </li>
            <li class="active item-23">
                <span class="bread-current">{{ trans('site.careers') }}</span>
            </li>

        </ol>
    </div>
    <!-- end breadcrumb -->
    <div class="about-us-section">
        <div class="container">
            <div class="careers-section">
                <h2 class="careers-title">
                    {{ trans('site.career_desc') }}
                </h2>
                <livewire:career />
            </div>

        </div>
    </div>
    <!-- about-section -->

@endsection

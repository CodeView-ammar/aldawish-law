@extends('site.layouts.master')
@section('page_title', ' / ' . __('site.topbars'))
@section('body_class', 'inner-page')
@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-section">
        <h2 class="breadcrumb-head">{{ trans('site.topbars') }}</h2>
        <ol class="breadcrumb">
            <li class="item-home">
                <a class="bread-link bread-home" href="{{ route('index') }}">{{ trans('site.home') }}</a>
            </li>
            <li class="active item-23">
                <span class="bread-current">{{ trans('site.topbars') }}</span>
            </li>
        </ol>
    </div>
    <!-- end breadcrumb -->

    <!-- about-section -->
    <div class="about-us-section">
        <div class="container">
            <div class="topbars-grid">
                @if ($topbars->count() > 0)
                    @foreach ($topbars as $topbar)
                        <a href="{{ $topbar['meta_data'] }}" target="__blank">
                            <div class="topbar-img-block">
                                <img class=" img-fluid" src="{{ $topbar['default'] }}" alt="topbar img">
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
            <ul class="services-pagination">
                {{ $topbars->links() }}

            </ul>

        </div>
    </div>
@endsection

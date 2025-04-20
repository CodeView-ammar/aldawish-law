@extends('site.layouts.master')
@section('page_title', ' / ' . __('site.partners'))
@section('body_class', 'inner-page')
@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-section">
        <h2 class="breadcrumb-head">{{ trans('site.partners') }}</h2>
        <ol class="breadcrumb">
            <li class="item-home">
                <a class="bread-link bread-home" href="{{ route('index') }}">{{ trans('site.home') }}</a>
            </li>
            <li class="active item-23">
                <span class="bread-current">{{ trans('site.partners') }}</span>
            </li>
        </ol>
    </div>
    <!-- end breadcrumb -->

    <!-- about-section -->
    <div class="about-us-section">
        <div class="container">
            <div class="partners-grid">
                @if ($partners->count() > 0)
                    @foreach ($partners as $partner)
                        
                            <div class="partner-img-block">
                                <img class=" img-fluid" src="{{ $partner['default'] }}" alt="partner img">
                            </div>
                    @endforeach
                @endif
            </div>
            <ul class="services-pagination">
                {{ $partners->links() }}

            </ul>

        </div>
    </div>
@endsection

@extends('site.layouts.master')
@section('page_title', ' / ' . __('site.terms-conditions'))
@section('body_class', 'inner-page')
@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-section">
        <h2 class="breadcrumb-head">{{ trans('site.terms-conditions') }}</h2>
        <ol class="breadcrumb">
            <li class="item-home">
                <a class="bread-link bread-home" href="{{ route('index') }}">{{ trans('site.home') }}</a>
            </li>
            <li class="active item-23">
                <span class="bread-current">{{ trans('site.terms-conditions') }}</span>
            </li>

        </ol>
    </div>


    <div class="about-us-section terms-section">
        <div class="container">
            <div class="terms-conditions-section">
                <div class="terms-conditions-content">
                    <span class="date">
                        {{ trans('site.last_update') }}
                        {{ \Carbon\Carbon::parse($term->updated_at)->format('d-m-Y') }}
                    </span>
                    <div data-bs-spy="scroll" data-bs-target="#list-example" data-bs-smooth-scroll="true"
                        class="scrollspy-example" tabindex="0">
                        {{-- {!! Markdown::parse($term['description']) !!} --}}

                        <h1 id="list-item-1" class="term-title">{{ $term['title'] ?? '' }}</h1>
                        <p class="term-paragraph">
                            {!! Markdown::parse($term['description']) !!}

                        </p>
                    </div>
                </div>

{{--                <div class="terms-conditions-titles">--}}
{{--                    <div id="list-example" class="list-group terms-conditions-group">--}}
{{--                        <h2 class="terms-conditions-group-title">--}}
{{--                            {{ trans('site.content') }}--}}
{{--                        </h2>--}}
{{--                        --}}{{-- @foreach ($meta_data as $meta) --}}
{{--                            <a class="list-group-item terms-conditions-list-group-item list-group-item-action"--}}
{{--                                href="#{{ $term['title'] }}"> {{ $term['title'] }}</a>--}}
{{--                        --}}{{-- @endforeach --}}

{{--                    </div>--}}
{{--                </div>--}}



            </div>
        </div>
    </div>

@endsection

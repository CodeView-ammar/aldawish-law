@extends('site.layouts.master')
@section('page_title',' / ' . __('site.our_values'))
@section('body_class', 'inner-page')
@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-section">
        <h2 class="breadcrumb-head">{{ trans('site.our_values') }}</h2>
        <ol class="breadcrumb">
            <li class="item-home">
                <a class="bread-link bread-home" href="{{ route('index') }}">{{ trans('site.home') }}</a>
            </li>
            <li class="active item-23">
                <span class="bread-current">{{ trans('site.our_values') }}</span>
            </li>
        </ol>
    </div>
    <!-- end breadcrumb -->

    <!-- about-section -->
    <div class="about-us-section">
        <div class="container">
            @if ($our_values !== null)
                <div class="about-us-content wow fadeInDown">
                    <img class="img-fluid about-us-image"
                        src="{{ asset('storage/' . $our_values->id . '/' . $our_values->file_name) }}"
                        alt="about us img" />
                    <h2 class="about-us-title">
                        @if(app()->getLocale() == 'ar'&& $our_values->title_ar  != null)
                        {{ $our_values->title_ar }}
                        @elseif(app()->getLocale() == 'en' && $our_values->title_en  != null)
                        {{ $our_values->title_en }}
                        @elseif(app()->getLocale() == 'fr' && $our_values->title_fr  != null)
                        {{ $our_values->title_fr }}
                        @elseif(app()->getLocale() == 'zh' && $our_values->title_zh  != null)
                        {{ $our_values->title_zh }}
                        @elseif(app()->getLocale() == 'de' && $our_values->title_de  != null)
                        {{ $our_values->title_de }}
                        @else
                        {{ $our_values->title_en }}
                        @endif
                       </h2>
                    <p class="about-us-paragraph">
                        @if(app()->getLocale() == 'ar'&& $our_values->description_ar  != null)
                        {!! $our_values->description_ar !!}
                        @elseif(app()->getLocale() == 'en' && $our_values->description_en  != null)
                        {!! $our_values->description_en !!}
                        @elseif(app()->getLocale() == 'fr' && $our_values->description_fr  != null)
                        {!! $our_values->description_fr !!}
                        @elseif(app()->getLocale() == 'zh' && $our_values->description_zh  != null)
                        {!! $our_values->description_zh !!}
                        @elseif(app()->getLocale() == 'de' && $our_values->description_de  != null)
                        {!! $our_values->description_de !!}
                        @else
                        {!! $our_values->description_en !!}
                        @endif


                    </p>
                </div>
            @endif
        </div>
    </div>
@endsection

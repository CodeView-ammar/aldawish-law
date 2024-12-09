@extends('site.layouts.master')
@section('page_title', ' / ' . __('site.company_vision'))
@section('body_class', 'inner-page')
@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-section">
        <h2 class="breadcrumb-head">{{ trans('site.company_vision') }}</h2>
        <ol class="breadcrumb">
            <li class="item-home">
                <a class="bread-link bread-home" href="{{ route('index') }}">{{ trans('site.home') }}</a>
            </li>
            <li class="active item-23">
                <span class="bread-current">{{ trans('site.company_vision') }}</span>
            </li>
        </ol>
    </div>
    <!-- end breadcrumb -->

    <!-- about-section -->
    <div class="about-us-section">
        <div class="container">
            @if ($company_vision !== null)
                <div class="about-us-content wow fadeInDown">
                    <img class="img-fluid about-us-image"
                        src="{{ asset('storage/' . $company_vision->id . '/' . $company_vision->file_name) }}"
                        alt="about us img" />
                    <h2 class="about-us-title">
                        @if(app()->getLocale() == 'ar'&& $company_vision->title_ar != null)
                        {{ $company_vision->title_ar }}
                        @elseif(app()->getLocale() == 'en' && $company_vision->title_en  != null)
                        {{ $company_vision->title_en }}
                        @elseif(app()->getLocale() == 'fr' && $company_vision->title_fr  != null)
                        {{ $company_vision->title_fr }}
                        @elseif(app()->getLocale() == 'zh' && $company_vision->title_zh  != null)
                        {{ $company_vision->title_zh }}
                        @elseif(app()->getLocale() == 'de' && $company_vision->title_de  != null)
                        {{ $company_vision->title_de }}
                        @else
                        {{ $company_vision->title_en }}
                        @endif
                        </h2>
                    <p class="about-us-paragraph">

                        @if(app()->getLocale() == 'ar'&& $company_vision->description_ar  != null)
                        {!! $company_vision->description_ar !!}
                        @elseif(app()->getLocale() == 'en' && $company_vision->description_en  != null)
                        {!! $company_vision->description_en !!}
                        @elseif(app()->getLocale() == 'fr' && $company_vision->description_fr  != null)
                        {!! $company_vision->description_fr !!}
                        @elseif(app()->getLocale() == 'zh' && $company_vision->description_zh  != null)
                        {!! $company_vision->description_zh !!}
                        @elseif(app()->getLocale() == 'de' && $company_vision->description_de  != null)
                        {!! $company_vision->description_de !!}
                        @else
                        {!! $company_vision->description_en !!}
                        @endif

                    </p>
                </div>
            @endif
        </div>
    </div>
@endsection

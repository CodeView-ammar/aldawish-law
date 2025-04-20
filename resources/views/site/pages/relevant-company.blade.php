@extends('site.layouts.master')
@section('page_title', ' / ' . __('site.relevant_skills'))
@section('body_class', 'inner-page')
@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-section">
        <h2 class="breadcrumb-head">{{ trans('site.relevant_skills') }}</h2>
        <ol class="breadcrumb">
            <li class="item-home">
                <a class="bread-link bread-home" href="{{ route('index') }}">{{ trans('site.home') }}</a>
            </li>
            <li class="active item-23">
                <span class="bread-current">{{ trans('site.relevant_skills') }}</span>
            </li>
        </ol>
    </div>
    <!-- end breadcrumb -->

    <!-- about-section -->
    <div class="about-us-section">
        <div class="container">
            @if ($relevant_company !== null)
                <div class="about-us-content wow fadeInDown">
                    <img class="img-fluid about-us-image"
                        src="{{ asset('storage/' . $relevant_company->id . '/' . $relevant_company->file_name) }}"
                        alt="about us img" />
                    <h2 class="about-us-title">
                        @if(app()->getLocale() == 'ar'&& $relevant_company->title_ar  != null)
                        {{ $relevant_company->title_ar }}
                        @elseif(app()->getLocale() == 'en' && $relevant_company->title_en  != null)
                        {{ $relevant_company->title_en }}
                        @elseif(app()->getLocale() == 'fr' && $relevant_company->title_fr  != null)
                        {{ $relevant_company->title_fr }}
                        @elseif(app()->getLocale() == 'zh' && $relevant_company->title_zh  != null)
                        {{ $relevant_company->title_zh }}
                        @elseif(app()->getLocale() == 'de' && $relevant_company->title_de  != null)
                        {{ $relevant_company->title_de }}
                        @else
                        {{ $relevant_company->title_en }}
                        @endif
                         </h2>
                    <p class="about-us-paragraph">
                        @if(app()->getLocale() == 'ar'&& $relevant_company->description_ar  != null)
                        {!! $relevant_company->description_ar !!}
                        @elseif(app()->getLocale() == 'en' && $relevant_company->description_en  != null)
                        {!! $relevant_company->description_en !!}
                        @elseif(app()->getLocale() == 'fr' && $relevant_company->description_fr  != null)
                        {!! $relevant_company->description_fr !!}
                        @elseif(app()->getLocale() == 'zh' && $relevant_company->description_zh  != null)
                        {!! $relevant_company->description_zh !!}
                        @elseif(app()->getLocale() == 'de' && $relevant_company->description_de  != null)
                        {!! $relevant_company->description_de !!}
                        @else
                        {!! $relevant_company->description_en !!}
                        @endif


                    </p>
                </div>
            @endif
        </div>
    </div>
@endsection

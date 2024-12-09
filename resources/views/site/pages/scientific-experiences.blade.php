@extends('site.layouts.master')
@section('page_title', ' / ' . __('site.scientific_practical_experiences'))
@section('body_class', 'inner-page')
@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-section">
        <h2 class="breadcrumb-head">{{ trans('site.scientific_practical_experiences') }}</h2>
        <ol class="breadcrumb">
            <li class="item-home">
                <a class="bread-link bread-home" href="{{ route('index') }}">{{ trans('site.home') }}</a>
            </li>
            <li class="active item-23">
                <span class="bread-current">{{ trans('site.scientific_practical_experiences') }}</span>
            </li>
        </ol>
    </div>
    <!-- end breadcrumb -->

    <!-- about-section -->
    <div class="about-us-section">
        <div class="container">
            @if ($scientific_experiences !== null)
                <div class="about-us-content wow fadeInDown">
                    <img class="img-fluid about-us-image"
                        src="{{ asset('storage/' . $scientific_experiences->id . '/' . $scientific_experiences->file_name) }}"
                        alt="about us img" />
                    <h2 class="about-us-title">
                        @if(app()->getLocale() == 'ar'&& $scientific_experiences->title_ar != null)
                        {{ $scientific_experiences->title_ar }}
                        @elseif(app()->getLocale() == 'en' && $scientific_experiences->title_en != null)
                        {{ $scientific_experiences->title_en }}
                        @elseif(app()->getLocale() == 'fr' && $scientific_experiences->title_fr != null)
                        {{ $scientific_experiences->title_fr }}
                        @elseif(app()->getLocale() == 'zh' && $scientific_experiences->title_zh != null)
                        {{ $scientific_experiences->title_zh }}
                        @elseif(app()->getLocale() == 'de' && $scientific_experiences->title_de != null)
                        {{ $scientific_experiences->title_de }}
                        @else
                        {{ $scientific_experiences->title_en }}
                        @endif
                         </h2>
                    <p class="about-us-paragraph">
                        @if(app()->getLocale() == 'ar'&& $scientific_experiences->description_ar  != null)
                        {!! $scientific_experiences->description_ar !!}
                        @elseif(app()->getLocale() == 'en' && $scientific_experiences->description_en  != null)
                        {!! $scientific_experiences->description_en !!}
                        @elseif(app()->getLocale() == 'fr' && $scientific_experiences->description_fr  != null)
                        {!! $scientific_experiences->description_fr !!}
                        @elseif(app()->getLocale() == 'zh' && $scientific_experiences->description_zh  != null)
                        {!! $scientific_experiences->description_zh !!}
                        @elseif(app()->getLocale() == 'de' && $scientific_experiences->description_de  != null)
                        {!! $scientific_experiences->description_de !!}
                        @else
                        {!! $scientific_experiences->description_en !!}
                        @endif


                    </p>
                </div>
            @endif
        </div>
    </div>
@endsection

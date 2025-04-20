@extends('site.layouts.master')
@section('page_title', ' / ' . __('site.company_aims'))
@section('body_class', 'inner-page')
@section('content')
<!-- breadcrumb -->
<div class="breadcrumb-section">
    <h2 class="breadcrumb-head">{{ trans('site.company_aims') }}</h2>
    <ol class="breadcrumb">
        <li class="item-home">
            <a class="bread-link bread-home" href="{{ route('index') }}">{{ trans('site.home') }}</a>
        </li>
        <li class="active item-23">
            <span class="bread-current">{{ trans('site.company_aims') }}</span>
        </li>
    </ol>
</div>
<!-- end breadcrumb -->

<!-- about-section -->
<div class="about-us-section">
    <div class="container">
        @if ($company_aims !== null)
        <div class="about-us-content wow fadeInDown">
            <img class="img-fluid about-us-image" src="{{ asset('storage/' . $company_aims->id . '/' . $company_aims->file_name) }}" alt="about us img" />
            <h2 class="about-us-title">
                @if(app()->getLocale() == 'ar' && $company_aims->title_ar != null)
                {{ $company_aims->title_ar }}
                @elseif(app()->getLocale() == 'en' && $company_aims->title_en != null)
                {{ $company_aims->title_en }}
                @elseif(app()->getLocale() == 'fr' && $company_aims->title_fr != null)
                {{ $company_aims->title_fr }}
                @elseif(app()->getLocale() == 'zh' && $company_aims->title_zh != null)
                {{ $company_aims->title_zh }}
                @elseif(app()->getLocale() == 'de' && $company_aims->title_de != null)
                {{ $company_aims->title_de }}
                @else
                {{ $company_aims->title_en }}
                @endif
            </h2>
            <p class="about-us-paragraph">
                @if(app()->getLocale() == 'ar'&& $company_aims->description_ar != null)
                {!! $company_aims->description_ar !!}
                @elseif(app()->getLocale() == 'en' && $company_aims->description_en != null)
                {!! $company_aims->description_en !!}
                @elseif(app()->getLocale() == 'fr' && $company_aims->description_fr != null)
                {!! $company_aims->description_fr !!}
                @elseif(app()->getLocale() == 'zh' && $company_aims->description_zh != null)
                {!! $company_aims->description_zh !!}
                @elseif(app()->getLocale() == 'de' && $company_aims->description_de != null)
                {!! $company_aims->description_de !!}
                @else
                {!! $company_aims->description_en !!}
                @endif
            </p>
        </div>
        @endif
    </div>
</div>
@endsection

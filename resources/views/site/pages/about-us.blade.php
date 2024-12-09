@extends('site.layouts.master')
@section('page_title', ' / ' . __('site.about_us'))
@section('body_class', 'inner-page')
@section('content')
<!-- breadcrumb -->
<div class="breadcrumb-section">
    <h2 class="breadcrumb-head">{{ trans('site.about_us') }}</h2>
    <ol class="breadcrumb">
        <li class="item-home">
            <a class="bread-link bread-home " href="{{ route('index') }}">{{ trans('site.home') }}</a>
        </li>

        <li class="active item-23">
            <span class="bread-current">{{ trans('site.about_us') }}</span>
        </li>
    </ol>
</div>
<!-- end breadcrumb -->

<!-- about-section -->
<div class="about-us-section">
    <div class="container">
        <div class="about-us-content wow fadeInDown">
            @if ($about_us !== null)
            <img class="img-fluid about-us-image" src="{{ asset('storage/' . $about_us->id . '/' . $about_us->file_name) }}" alt="about us img" />
            <h2 class="about-us-title">
                @if(app()->getLocale() == 'ar'&& $about_us->title_ar != null)
                {{ $about_us->title_ar}}
                @elseif(app()->getLocale() == 'en' && $about_us->title_en != null)
                {{ $about_us->title_en}}
                @elseif(app()->getLocale() == 'fr' && $about_us->title_fr != null)
                {{ $about_us->title_fr}}
                @elseif(app()->getLocale() == 'zh' && $about_us->title_zh != null)
                {{ $about_us->title_zh}}
                @elseif(app()->getLocale() == 'de' && $about_us->title_de != null)
                {{ $about_us->title_de}}
                @else
                {{ $about_us->title_en}}
                @endif

            </h2>
            <p class="about-us-paragraph">
                @if(app()->getLocale() == 'ar'&& $about_us->description_ar != null)
                {!! $about_us->description_ar !!}
                @elseif(app()->getLocale() == 'en' && $about_us->description_en != null)
                {!! $about_us->description_en !!}
                @elseif(app()->getLocale() == 'fr' && $about_us->description_fr != null)
                {!! $about_us->description_fr !!}
                @elseif(app()->getLocale() == 'zh' && $about_us->description_zh != null)
                {!! $about_us->description_zh !!}
                @elseif(app()->getLocale() == 'de' && $about_us->description_de != null)
                {!! $about_us->description_de !!}
                @else
                {!! $about_us->description_en !!}
                @endif
            </p>
            @endif
            <div class="counter-section wow fadeInDown" id="counter">
                <div class="count">
                    <h3 class="counter-number">{{ $years_of_experience }}</h3>
                    <div class="counter-name-div">
                        <span class="counter-name"> {{ $years_of_experience_text[app()->getLocale()] ?? $years_of_experience_text['en'] }} </span>
                    </div>
                </div>
                <div class="count">
                    <h3 class="counter-number"> {{ $successful_pleadings }} </h3>
                    <div class="counter-name-div">
                        <span class="counter-name"> {{ $successful_pleadings_text[app()->getLocale()] ?? $years_of_experience_text['en']  }} </span>
                    </div>
                </div>
                <div class="count">
                    <h3 class="counter-number"> {{ $legal_experts }}</h3>
                    <div class="counter-name-div">
                        <span class="counter-name"> {{ $legal_experts_text[app()->getLocale()] ?? $years_of_experience_text['en']  }} </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

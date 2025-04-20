@extends('site.layouts.master')
@section('page_title',' / ' . __('site.services'))
@section('body_class', app()->getLocale() == 'ar' ? 'inner-page rtl' : 'inner-page')
@section('content')

<!-- breadcrumb -->
<div class="breadcrumb-section" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <h2 class="breadcrumb-head">
        @if(app()->getLocale() == 'ar' && $our_service['title_ar'] != null)
            {{ $our_service['title_ar'] }}
        @elseif(app()->getLocale() == 'en' && $our_service['title_en'] != null)
            {{ $our_service['title_en'] }}
        @elseif(app()->getLocale() == 'fr' && $our_service['title_fr'] != null)
            {{ $our_service['title_fr'] }}
        @elseif(app()->getLocale() == 'zh' && $our_service['title_zh'] != null)
            {{ $our_service['title_zh'] }}
        @elseif(app()->getLocale() == 'de' && $our_service['title_de'] != null)
            {{ $our_service['title_de'] }}
        @else
            {{ $our_service['title_en'] }}
        @endif
    </h2>
    <ol class="breadcrumb">
        <li class="item-home" >
            <a class="bread-link bread-home" href="{{ route('index') }}">{{ trans('site.home') }}</a>
        </li>
        <li class=" item-23">
            <span class="bread-current">{{ trans('site.services') }}</span>
        </li>
        <li class="active item-23">
            <span class="bread-current">
                @if(app()->getLocale() == 'ar' && $our_service['title_ar'] != null)
                    {{ $our_service['title_ar'] }}
                @elseif(app()->getLocale() == 'en' && $our_service['title_en'] != null)
                    {{ $our_service['title_en'] }}
                @elseif(app()->getLocale() == 'fr' && $our_service['title_fr'] != null)
                    {{ $our_service['title_fr'] }}
                @elseif(app()->getLocale() == 'zh' && $our_service['title_zh'] != null)
                    {{ $our_service['title_zh'] }}
                @elseif(app()->getLocale() == 'de' && $our_service['title_de'] != null)
                    {{ $our_service['title_de'] }}
                @else
                    {{ $our_service['title_en'] }}
                @endif
            </span>
        </li>
    </ol>
</div>

<!-- about-us-section -->
<div class="about-us-section" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="container">
        <div class="about-us-content wow fadeInDown">
            <img class="img-fluid about-us-image" src="{{$our_service->getFirstMediaUrl('default', 'card') }}" alt="service img" />
            <h2 class="breadcrumb-head" style="color: var(--main-hover)">
                @if(app()->getLocale() == 'ar' && $our_service['title_ar'] != null)
                    {{ $our_service['title_ar'] }}
                @elseif(app()->getLocale() == 'en' && $our_service['title_en'] != null)
                    {{ $our_service['title_en'] }}
                @elseif(app()->getLocale() == 'fr' && $our_service['title_fr'] != null)
                    {{ $our_service['title_fr'] }}
                @elseif(app()->getLocale() == 'zh' && $our_service['title_zh'] != null)
                    {{ $our_service['title_zh'] }}
                @elseif(app()->getLocale() == 'de' && $our_service['title_de'] != null)
                    {{ $our_service['title_de'] }}
                @else
                    {{ $our_service['title_en'] }}
                @endif
            </h2>
            <p class="about-us-paragraph" style="    margin-right: 9%;">
                @if(app()->getLocale() == 'ar' && $our_service['description_ar'] != null)
                    {!! $our_service['description_ar'] !!}
                @elseif(app()->getLocale() == 'en' && $our_service['description_en'] != null)
                    {!! $our_service['description_en'] !!}
                @elseif(app()->getLocale() == 'fr' && $our_service['description_fr'] != null)
                    {!! $our_service['description_fr'] !!}
                @elseif(app()->getLocale() == 'zh' && $our_service['description_zh'] != null)
                    {!! $our_service['description_zh'] !!}
                @elseif(app()->getLocale() == 'de' && $our_service['description_de'] != null)
                    {!! $our_service['description_de'] !!}
                @else
                    {!! $our_service['description_en'] !!}
                @endif
            </p>
        </div>
    </div>
</div>

@endsection

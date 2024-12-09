@extends('site.layouts.master')
@section('page_title',' / ' . __('site.services'))
@section('body_class', 'inner-page')
@section('content')
<!-- breadcrumb -->
<div class="breadcrumb-section">
    <h2 class="breadcrumb-head">{{ trans('site.services') }}</h2>
    <ol class="breadcrumb">
        <li class="item-home">
            <a class="bread-link bread-home" href="{{ route('index') }}">{{ trans('site.home') }}</a>
        </li>

        <li class="active item-23">
            <span class="bread-current">{{ trans('site.services') }}</span>
        </li>
    </ol>
</div>

<div class="about-us-section">
    <div class="container">
        <div class="services-grid">
            @if ($services->count() > 0)
            @foreach ($services as $service)
            <a href="{{ route('service.details', $service['id']) }}">
                <div class="service-block">
                    <img class="img-fluid service-img" src="{{ $service->getFirstMediaUrl('default', 'thumb') }}" alt="service image">
                </div>
                <div class="service-block-cover">
                    <h2 class="service-title">
                        @if(app()->getLocale() == 'ar'&& $service['title_ar'] != null)
                        {{ $service['title_ar']}}
                        @elseif(app()->getLocale() == 'en' && $service['title_en'] != null)
                        {{ $service['title_en']}}
                        @elseif(app()->getLocale() == 'fr' && $service['title_fr'] != null)
                        {{ $service['title_fr']}}
                        @elseif(app()->getLocale() == 'zh' && $service['title_zh'] != null)
                        {{ $service['title_zh']}}
                        @elseif(app()->getLocale() == 'de' && $service['title_de'] != null)
                        {{ $service['title_de']}}
                        @else
                        {{ $service['title_en']}}
                        @endif
                    </h2>
                </div>
            </a>
            @endforeach
            @endif
        </div>
        <ul class="services-pagination">
            {{ $services->links() }}
        </ul>
    </div>
</div>

@endsection

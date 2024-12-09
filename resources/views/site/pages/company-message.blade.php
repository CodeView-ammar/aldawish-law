@extends('site.layouts.master')
@section('page_title',   ' / ' . __('site.company_message'))
@section('body_class', 'inner-page')
@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-section">
        <h2 class="breadcrumb-head">{{ trans('site.company_message') }}</h2>
        <ol class="breadcrumb">
            <li class="item-home">
                <a class="bread-link bread-home " href="{{ route('index') }}">{{ trans('site.home') }}</a>
            </li>

            <li class="active item-23">
                <span class="bread-current">{{ trans('site.company_message') }}</span>
            </li>
        </ol>
    </div>
    <!-- end breadcrumb -->

    <!-- about-section -->
    <div class="about-us-section">
        <div class="container">
            @if (($company_message) !== null)
            <div class="about-us-content wow fadeInDown">
                <img class="img-fluid about-us-image"
                    src="{{ asset('storage/' . $company_message->id . '/' . $company_message->file_name) }}"
                    alt="about us img" />
                <h2 class="about-us-title">
                    @if(app()->getLocale() == 'ar'&& $company_message->title_ar  != null)
                        {{ $company_message->title_ar }}
                        @elseif(app()->getLocale() == 'en' && $company_message->title_en  != null)
                        {{ $company_message->title_en }}
                        @elseif(app()->getLocale() == 'fr' && $company_message->title_fr  != null)
                        {{ $company_message->title_fr }}
                        @elseif(app()->getLocale() == 'zh' && $company_message->title_zh  != null)
                        {{ $company_message->title_zh }}
                        @elseif(app()->getLocale() == 'de' && $company_message->title_de  != null)
                        {{ $company_message->title_de }}
                        @else
                        {{ $company_message->title_en }}
                        @endif
                     </h2>
                <p class="about-us-paragraph">
                    @if(app()->getLocale() == 'ar'&& $company_message->description_ar  != null)
                    {!! $company_message->description_ar !!}
                    @elseif(app()->getLocale() == 'en' && $company_message->description_en  != null)
                    {!! $company_message->description_en !!}
                    @elseif(app()->getLocale() == 'fr' && $company_message->description_fr  != null)
                    {!! $company_message->description_fr !!}
                    @elseif(app()->getLocale() == 'zh' && $company_message->description_zh  != null)
                    {!! $company_message->description_zh !!}
                    @elseif(app()->getLocale() == 'de' && $company_message->description_de  != null)
                    {!! $company_message->description_de !!}
                    @else
                    {!! $company_message->description_en !!}
                    @endif


                </p>
            </div>
            @endif
        </div>
    </div>
@endsection

@extends('site.layouts.master')
@section('page_title', ' / ' . __('site.team_mission'))
@section('body_class', 'inner-page')
@section('content')
<!-- breadcrumb -->
<div class="breadcrumb-section">
    <h2 class="breadcrumb-head">{{ trans('site.team_mission') }}</h2>
    <ol class="breadcrumb">
        <li class="item-home">
            <a class="bread-link bread-home" href="{{ route('index') }}">{{ trans('site.home') }}</a>
        </li>
        <li class="active item-23">
            <span class="bread-current">{{ trans('site.team_mission') }}</span>
        </li>
    </ol>
</div>
<!-- end breadcrumb -->

<!-- about-section -->
<div class="about-us-section">
    <div class="container">
        @if ($team_mission !== null)
        <div class="about-us-content wow fadeInDown">
            <img class="img-fluid about-us-image" src="{{ asset('storage/' . $team_mission->id . '/' . $team_mission->file_name) }}" alt="about us img" />
            <h2 class="about-us-title"> @if(app()->getLocale() == 'ar'&& $team_mission->title_ar != null)
                {{ $team_mission->title_ar }}
                @elseif(app()->getLocale() == 'en' && $team_mission->title_en != null)
                {{ $team_mission->title_en }}
                @elseif(app()->getLocale() == 'fr' && $team_mission->title_fr != null)
                {{ $team_mission->title_fr }}
                @elseif(app()->getLocale() == 'zh' && $team_mission->title_zh != null)
                {{ $team_mission->title_zh }}
                @elseif(app()->getLocale() == 'de' && $team_mission->title_de != null)
                {{ $team_mission->title_de }}
                @else
                {{ $team_mission->title_en }}
                @endif

            </h2>
            <p class="about-us-paragraph">
                @if(app()->getLocale() == 'ar'&& $team_mission->description_ar != null)
                {!! $team_mission->description_ar !!}
                @elseif(app()->getLocale() == 'en' && $team_mission->description_en != null)
                {!! $team_mission->description_en !!}
                @elseif(app()->getLocale() == 'fr' && $team_mission->description_fr != null)
                {!! $team_mission->description_fr !!}
                @elseif(app()->getLocale() == 'zh' && $team_mission->description_zh != null)
                {!! $team_mission->description_zh !!}
                @elseif(app()->getLocale() == 'de' && $team_mission->description_de != null)
                {!! $team_mission->description_de !!}
                @else
                {!! $team_mission->description_en !!}
                @endif



            </p>
        </div>
        @endif
    </div>
</div>
@endsection

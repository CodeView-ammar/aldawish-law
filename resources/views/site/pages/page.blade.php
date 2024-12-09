@extends('site.layouts.master')
@section('page_title', ' / ' . $page->title)
@section('body_class', 'inner-page')
@section('content')
<!-- breadcrumb -->
<div class="breadcrumb-section">
    <h2 class="breadcrumb-head">{{ $page->title}}</h2>
    <ol class="breadcrumb">
        <li class="item-home">
            <a class="bread-link bread-home " href="{{ route('index') }}">{{ trans('site.home') }}</a>
        </li>

        <li class="active item-23">
            <span class="bread-current">{{ $page->title}}</span>
        </li>
    </ol>
</div>
<!-- end breadcrumb -->

<!-- about-section -->
<div class="about-us-section">
    <div class="container">
            {!! $page->description!!}
    </div>
</div>
@endsection

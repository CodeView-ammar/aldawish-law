@extends('site.layouts.master')
@section('page_title', '')
@section('content')
    @include('site.pages.home.banner')
    <!-- main slider -->
    <!-- about-section -->
    @if($aboutUs != null)
    @include('site.pages.home.aboutUs')
    @endif
    <!-- end about section -->
    <!-- services-section -->
    @include('site.pages.home.services')
    <!-- end services-section -->
    <!-- partners-swiper-section -->
    @include('site.pages.home.partners')
@endsection
@push('scripts')
    <script>
        @if (session('success'))
            toastr["success"]("{{ __(session('success')) }}");
        @endif
        @if (session('error'))
            toastr["error"]("{{ __(session('error')) }}");
        @endif
    </script>
@endpush

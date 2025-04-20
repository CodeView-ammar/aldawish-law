@extends('site.layouts.master')
@section('page_title', ' / ' . __('site.bloger'))
@section('body_class', 'inner-page')
@section('metaDescription',  $post->metaTitle )
@section('content')

<div class="container d-flex justify-content-center align-items-center mt-5 mb-5">
    <div class="col-md-10 col-lg-8"style="margin-top: 115px;">
        <div class="post-card border rounded shadow-lg p-4 bg-white">
            
            <!-- عنوان المقال -->
            <h1 class="post-title text-center fw-bold mb-3">{{ $post->title }}</h1>
            
            <!-- الميتا -->
            <h5 class="post-meta text-center text-muted">{{ $post->metaTitle }}</h5>
            
            <!-- الفئات -->
            <h5 class="post-categories text-center text-danger fw-bold small mt-2">
                @foreach($categories as $category)
                    <span class="badge bg-danger text-white">{{ $category->title }}</span>
                @endforeach
            </h5>

            <!-- صورة المقال -->
            <div class="post-image mt-4 text-center">
                <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid rounded shadow-sm" alt="{{ $post->title }}">
            </div>

            <!-- تاريخ النشر -->
            <div class="post-date mt-3 text-center text-muted">
                <small>📅 نشر في: {{ \Carbon\Carbon::parse($post->createdAt)->format('d M Y') }}</small>
            </div>

            <!-- ملخص المقال -->
            <div class="post-summary mt-4 p-3 bg-light rounded">
                <p class="text-dark">{{ $post->summary }}</p>
            </div>

            <!-- محتوى المقال -->
            <div class="post-content mt-4">
                {!! $post->content !!} 
            </div>
        </div>

        <!-- زر الرجوع -->
        <div class="mt-4 text-center">
            <a href="{{ route('bloger') }}" class="btn btn-lg btn-primary shadow-sm px-4 consultation-link"> رجوع إلى القائمة</a>
            <a href="https://aldawishlaw.com.sa/ar/login" class="btn btn-lg btn-primary shadow-sm px-4 consultation-link">اطلب استشارتك اونلاين</a>
        </div>
    </div>
</div>

@endsection

@extends('site.layouts.master')
@section('page_title', ' / ' . __('site.bloger'))
@section('body_class', 'inner-page')
@section('content')
<style>
    .post-card {
        transition: transform 0.3s, box-shadow 0.3s; /* تأثيرات التحويل */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* ظل خفيف */
    }

    .post-card:hover {
        transform: translateY(-5px); /* رفع البطاقة قليلاً عند التمرير */
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* ظل أقوى عند التمرير */
    }

    .post-content {
        padding: 15px; /* مسافة داخلية */
    }

    .text-blue {
        color: #007bff; /* لون نص أزرق */
    }

    .bg-blue-soft {
        background-color: rgba(0, 123, 255, 0.1); /* خلفية زرقاء فاتحة */
        border-radius: 5px; /* زوايا دائرية للخلفية */
    }

    .img-fluid {
        border-radius: 0.5rem; /* زوايا دائرية للصورة */
    }
</style>

<div class="about-us-section">
    <div class="container"style="margin-top: 133px;">
        <div class="about-us-content wow fadeInDown">
            {{-- <div class="header-section">
                <h1 class="elementor-heading-title elementor-size-default">المدونة</h1>
            </div> --}}
            
            <main class="container">
            <h1 class="display-4 " style="text-align: center;">مدونة ثقافة قانونية</h1>
                {{-- <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
                    <div class="col-lg-6 px-0">
                        <p class="lead my-3">مرحباً بك في صفحة الثقافة القانونية, حيث نهدف إلى تقديم المعرفة القانونية بطرق سهلة ومبسطة. استكشافك لهذه الصفحة سيعطيك فهماً أعمق للقوانين التي تؤثر على حياتنا اليومية وأعمالنا.</p>
                    </div>
                </div> --}}

                <div class="categories-section text-center mb-4">
                    <h4 class="fw-bold mb-3">{{ trans('site.category') }}</h4>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <!-- خيار "الكل" -->
                        <a href="{{ route('bloger') }}" class="category-icon {{ request('category') ? 'btn-outline-secondary' : 'btn-primary' }}">
                            <i class="fas fa-th-large"></i> {{ trans('site.all') }}
                        </a>
                    
                        <!-- عرض الفئات -->
                        @foreach($categories as $category)
                            <a href="{{ url()->current() }}?category={{ $category->slug }}" class="category-icon {{ request('category') == $category->slug ? 'btn-primary' : 'btn-outline-secondary' }}">
                                <i class="fas fa-folder"></i> 
                                @if(app()->getLocale() == 'ar'&& $category->title_ar  != null)
                                {{ $category->title_ar }}
                                @elseif(app()->getLocale() == 'en' && $category->title_en  != null)
                                {{ $category->title_en }}
                                @elseif(app()->getLocale() == 'fr' && $category->title_fr  != null)
                                {{ $category->title_fr }}
                                @elseif(app()->getLocale() == 'zh' && $category->title_zh  != null)
                                {{ $category->title_zh }}
                                @elseif(app()->getLocale() == 'de' && $category->title_de  != null)
                                {{ $category->title_de }}
                                @else
                                {{ $category->title_en }}
                                @endif
                                
                            </a>
                        @endforeach
                    </div>
                </div>
                
                <!-- تنسيقات CSS -->
                <style>
                    .category-icon {
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        padding: 4px 3px;
                        border-radius: 15px;
                        text-decoration: none;
                        font-size: 16px;
                        transition: all 0.3s ease-in-out;
                        border: 2px solid transparent;
                    }
                    
                    .category-icon i {
                        margin-right: 5px;
                    }
                
                    .category-icon.btn-primary {
                        background-color: #007bff;
                        color: white;
                    }
                
                    .category-icon.btn-outline-secondary {
                        background-color: #f8f9fa;
                        color: #6c757d;
                        border-color: #6c757d;
                    }
                
                    .category-icon:hover {
                        transform: scale(1.1);
                    }
                </style>
                
                

                @if($posts->isEmpty())
                    <p>لا توجد بوستات متاحة.</p>
                @else
                    <div class="row mb-2">
                        @foreach($posts as $post)
                        <div class="col-lg-4 col-md-6 mb-5">
                            <a tabindex="0" class="d-block rounded-3 lift lift-lg mb-3 pointer post-card" href="bloger/posts/@if(app()->getLocale() == 'ar' && $post->slug_ar != null){{ $post->slug_ar }}@elseif(app()->getLocale() == 'en' && $post->slug_en != null){{ $post->slug_en }}@elseif(app()->getLocale() == 'fr' && $post->slug_fr != null){{ $post->slug_fr }}@elseif(app()->getLocale() == 'zh' && $post->slug_zh != null){{ $post->slug_zh }}@elseif(app()->getLocale() == 'de' && $post->slug_de != null){{ $post->slug_de }}@else{{ $post->slug_en }}@endif">
                                <picture>
                                    <source type="image/webp" srcset="{{ asset('storage/' . $post->image) }}" alt="@if(app()->getLocale() == 'ar' && $post->slug_ar != null){{ $post->slug_ar }}@elseif(app()->getLocale() == 'en' && $post->slug_en != null){{ $post->slug_en }}@elseif(app()->getLocale() == 'fr' && $post->slug_fr != null){{ $post->slug_fr }}@elseif(app()->getLocale() == 'zh' && $post->slug_zh != null){{ $post->slug_zh }}@elseif(app()->getLocale() == 'de' && $post->slug_de != null){{ $post->slug_de }}@else{{ $post->slug_en }}@endif">
                                    <source type="image/jpeg" srcset="{{ asset('storage/' . $post->image) }}" alt="@if(app()->getLocale() == 'ar' && $post->slug_ar != null){{ $post->slug_ar }}@elseif(app()->getLocale() == 'en' && $post->slug_en != null){{ $post->slug_en }}@elseif(app()->getLocale() == 'fr' && $post->slug_fr != null){{ $post->slug_fr }}@elseif(app()->getLocale() == 'zh' && $post->slug_zh != null){{ $post->slug_zh }}@elseif(app()->getLocale() == 'de' && $post->slug_de != null){{ $post->slug_de }}@else{{ $post->slug_en }}@endif">
                                    <img loading="lazy" fetchpriority="low" class="img-fluid rounded-3" src="{{ asset('storage/' . $post->image) }}" alt="@if(app()->getLocale() == 'ar' && $post->title_ar != null){{ $post->title_ar }}@elseif(app()->getLocale() == 'en' && $post->title_en != null){{ $post->title_en }}@elseif(app()->getLocale() == 'fr' && $post->title_fr != null){{ $post->title_fr }}@elseif(app()->getLocale() == 'zh' && $post->title_zh != null){{ $post->title_zh }}@elseif(app()->getLocale() == 'de' && $post->title_de != null){{ $post->title_de }}@else{{ $post->title_en }}@endif" 
                                    style="width: -webkit-fill-available;">
                                </picture>
                                <div class="post-content d-flex justify-content-between align-items-center">
                                    <div class="post-info">
                                        <div class="h6 mb-0">
                                            @if(app()->getLocale() == 'ar' && $post->title_ar != null)
                                                {{ $post->title_ar }}
                                            @elseif(app()->getLocale() == 'en' && $post->title_en != null)
                                                {{ $post->title_en }}
                                            @elseif(app()->getLocale() == 'fr' && $post->title_fr != null)
                                                {{ $post->title_fr }}
                                            @elseif(app()->getLocale() == 'zh' && $post->title_zh != null)
                                                {{ $post->title_zh }}
                                            @elseif(app()->getLocale() == 'de' && $post->title_de != null)
                                                {{ $post->title_de }}
                                            @else
                                                {{ $post->title_en }}
                                            @endif
                                        </div>
                                        <div class="small text-muted">
                                            @if(app()->getLocale() == 'ar' && $post->metaTitle_ar != null)
                                                {{ $post->metaTitle_ar }}
                                            @elseif(app()->getLocale() == 'en' && $post->metaTitle_en != null)
                                                {{ $post->metaTitle_en }}
                                            @elseif(app()->getLocale() == 'fr' && $post->metaTitle_fr != null)
                                                {{ $post->metaTitle_fr }}
                                            @elseif(app()->getLocale() == 'zh' && $post->metaTitle_zh != null)
                                                {{ $post->metaTitle_zh }}
                                            @elseif(app()->getLocale() == 'de' && $post->metaTitle_de != null)
                                                {{ $post->metaTitle_de }}
                                            @else
                                                {{ $post->metaTitle_en }}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="text-end flex-shrink-0">
                                        <div class="badge bg-blue-soft text-blue">{{ \Carbon\Carbon::parse($post->createdAt)->format('d M Y') }}</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                @endif
            </main>
        </div>
    </div>
</div>
@endsection
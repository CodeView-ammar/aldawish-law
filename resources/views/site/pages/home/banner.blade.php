<main class="main-slider">
    <div class="swiper-cont">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @if ($banners->count() > 0)
                    @foreach ($banners as $banner)
                        <div class="swiper-slide">
                            <div class="main">

                                <div class="main-slider-img">
                                    <a href="{{ $banner->link ?? '' }}" target="_blanck">

                                        <img src="{{ $banner['image_' . app()->getLocale()] }}"
                                            class="img-fluid main-slider-image" alt="slider img" onclick="window.location.replace('')"/>
                                    </a>
                                </div>
                                <div class="main-slider-img-cover">
                                    <div class="main-caption-div">
                                        <div class="main-caption">
                                            <h2 class="caption-title">{{ $banner->title ?? '' }}</h2>
                                            <p class="caption-text">
                                                {{ $banner->description ?? '' }}
                                            </p>
                                            @if (auth()->guard('customer')->user())
                                                <a href="{{ route('site.request-consultation') }}"
                                                    class="consultation-link">
                                                    {{ trans('site.Request_consultation') }} </a>
                                            @else
                                                <a href="{{ route('login') }}" class="consultation-link">
                                                    {{ trans('site.Request_consultation') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
    <div class="swiper-btn-prev swiper-btn">
        <i class="fa-thin fa-chevron-right"></i>
    </div>
    <div class="swiper-btn-next swiper-btn">
        <i class="fa-thin fa-chevron-left"></i>
    </div>
</main>

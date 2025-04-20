<div class=" partners-section wow fadeInDown">
    <div class="container">
        <span class="small-title mb20">
            {{ trans('site.our_partners') }}
        </span>
        <h2 class=" services-title">
            {{ trans('site.honored_serve_partners') }}
        </h2>
        <div class="partners">
            <div class="partners-slider">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @if ($partners->count() > 0)
                            @foreach ($partners as $partner)
                                <div class="swiper-slide">
                                        <div class="partner-img-block">
                                            <img class=" img-fluid" src="{{ $partner['default'] }}" alt="partner img">
                                        </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-btn-prev swiper-btn">
                    <i class="fa-thin fa-chevron-right"></i>
                </div>
                <div class="swiper-btn-next swiper-btn">
                    <i class="fa-thin fa-chevron-left"></i>
                </div>
            </div>
        </div>
    </div>
</div>

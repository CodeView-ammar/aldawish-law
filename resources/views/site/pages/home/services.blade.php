<div class="services-section wow fadeInDown">
    <div class="container">
        <div class="service-title-bar">
            <div class="services-title-text">
                <span class="small-title mb16">
                    {{ trans('site.what_we_offer') }}
                </span>
                <h2 class=" services-title">
                    {{ trans('site.our_legal_services') }}
                </h2>
            </div>


        </div>
        <div class="services-grid">
            @if ($home_services->count() > 0)
            @foreach ($home_services as $service)
            <a href="{{ route('service.details', $service->id) }}">
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
            <a href="" class="" ></a>
            <a href="{{ route('services') }}" class="consultation-link" style="">
                {{ trans('site.show_all_services') }}
            </a>
            <!-- <a href="{{ route('site.request-consultation') }}" class="consultation-link">{{ trans('site.request_service') }}</a> -->
        </div>
    </div>
</div>

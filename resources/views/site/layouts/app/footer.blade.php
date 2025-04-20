<footer class="footer">
    <div class="footer-content">

        <div class="container">

            <div class="footer-caption mb107">
                <h2 class="caption-title"> {{ trans('site.need_legal_advice') }}</h2>
                <p class="caption-text">
                    {{ trans('site.provide_online_legal') }}

                </p>
                @if (auth()->guard('customer')->user())
                    <a href="{{ route('site.request-consultation') }}" class="consultation-link">
                        {{ trans('site.Request_consultation') }} </a>
                @else
                    <a href="{{ route('login') }}" class="consultation-link"> {{ trans('site.Request_consultation') }}
                    </a>
                @endif

            </div>
            <div class="justify-center d-flex flex-column justify-content-center align-content-center" >
                <div class="footer-nav-bar ">
                <a  href="{{ route('index') }}">
                    <img class="logo footer-logo" src="{{ asset('storage/' . $app_logo) }}" alt="logo"/>
                </a>
                </div>
                <div class="footer-nav-bar ">

                    <ul class="big-menu list-unstyled">
                        <li>
                            <a href="{{ route('about-us') }}"> {{ trans('site.about_company') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('terms-condition') }}"> {{ trans('site.terms_conditions') }} </a>
                        </li>
                        <li>
                            <a href="{{ route('privacy-policy') }}"> {{ trans('site.privacy_policy') }} </a>
                        </li>

                        <li>
                            <a href="{{ route('career') }}"> {{ trans('site.careers') }} </a>
                        </li>
                        @php ($page_ids=collect((new \Tasawk\Settings\GeneralSettings())->app_pages)->values())
                        @foreach(\Tasawk\Models\Content\Page::enabled()->whereNotIn("id",$page_ids)->get() as $page)
                            <li>
                                <a href="{{ route('pages.show',$page->id) }}">{{$page->title}}</a>
                            </li>
                        @endforeach
                        <li>
                            <a href="{{ route('contact-us') }}">{{ trans('site.contact_us') }} </a>
                        </li>
                    </ul>

                </div>
                <div class="footer-nav-bar">
                    <ul class="social-list">
                        @foreach ($social_media as $media)
                            <li class="social-list-link">
                                <a href="{{ $media['link'] }}" target="_blank">
                                    <i class="fa-brands fa-{{ $media['icon'] }} social-icon"></i>
                                    <span style="display: none;">شركة عثمان بن أحمد الدويش</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>

    </div>
    <div class="container">
        <div class="copy-rights">
            <div class="copy-right">{{ trans('site.footer_desc') }} </div>
            <div class="copy-right">{{ trans('site.design_development') }}
ammar wadood              

            </div>
        </div>
    </div>
</footer>
	
<script>
const element = document.querySelector('.fa-brands.fa-fa-map-marker.social-icon');

// التحقق من وجود الكلاسات
if (element && 
    element.classList.contains('fa-brands') && 
    element.classList.contains('fa-fa-map-marker') && 
    element.classList.contains('social-icon')) {
    
    // استبدال الكلاسات
    element.className = 'fa fa-map-marker social-icon'; // استخدام className
}
</script>
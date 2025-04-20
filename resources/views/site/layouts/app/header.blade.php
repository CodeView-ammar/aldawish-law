<header>
@if($topBars->count() > 0) <!-- التحقق من وجود رسائل -->

<div class="top-bar news-ticker">
    <div class="news-content">
        @foreach($topBars as $key => $topBar)
            <p>{{ $topBar->content }}</p>
            @if($key < $topBars->count() - 1) <!-- لا تضيف الفاصل بعد الرسالة الأخيرة -->
                <p class="separator">|</p> <!-- فاصل بين الرسائل -->
            @endif
        @endforeach
    </div>
</div>
@endif
<div class="top-header">
    
<!-- CSS -->
<style>
    .news-ticker {
    background-color: #3498db; /* لون الخلفية */
    color: white; /* لون النص */
    overflow: hidden; /* لإخفاء المحتوى الزائد */
    white-space: nowrap; /* منع التفاف النص */
    position: relative;
}

.news-content {
    display: inline-block;
    padding: 0px;
    animation: ticker 15s linear infinite; /* سرعة الحركة */
}

@keyframes ticker {
    0% {
        transform: translateX(100%); /* بداية من خارج الشاشة من اليمين */
    }
    100% {
        transform: translateX(-100%); /* نهاية عند الخروج من الشاشة من اليسار */
    }
}
.top-bar {
    margin-right: 0px;
    background-color: #106793; /* خلفية الشريط */
    color: #fff; /* النص باللون الأبيض */
    padding: 5px 0;
    text-align: center;
    font-size: 16px; /* حجم النص */
    font-weight: bold;
    position: relative;
    overflow: hidden;
    
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* إضافة ظل لطيف */
    width: 104vw; /* التأكد من أن الشريط يمتد كامل العرض */
    left: 0; /* محاذاة إلى اليسار */
}

.marquee {
    display: inline-block;
    white-space: nowrap;
    animation: marquee 15s linear infinite; /* الحركة بشكل مستمر */
}

/* تعريف الحركة */


/* تنسيق النص داخل الشريط */
.marquee span {
    margin: 0 0px; /* إضافة مسافة صغيرة بين النص وحدود الشريط */
    display: inline-block;
}

/* التأثير عند التمرير: لتغيير لون النص عند التمرير */
.marquee span:hover {
    color: #106793; /* تغيير اللون عند التمرير */
    cursor: pointer;
}
</style>
        <!-- start nav-header -->
        <div class="nav-header">
            <!-- logo section -->
            <div class="img-logo">
                <a href="{{ route('index') }}">
                    <img src="{{ asset('storage/' . $app_logo) }}" class="img-fluid logo" alt="logo" />
                </a>
            </div>
            <!-- end logo section -->
            <!-- start menu -->
            <div class="navgition">
                <div class="dropdown language-anchor d-lg-none">
                    <button class="dropbtn">

                        <span class="guest-link">
                            <div class="flag-div">
                                @if(LaravelLocalization::getCurrentLocale() == 'ar')
                                <img src="{{ asset('site/images/flags/sa-flag.png') }}" alt="saudi arabia flag">
                                @elseif(LaravelLocalization::getCurrentLocale() == 'de')
                                <img src="{{ asset('site/images/flags/du-flag.png') }}" alt="du flag">
                                @elseif(LaravelLocalization::getCurrentLocale() == 'en')
                                <img src="{{ asset('site/images/flags/us-flag.png') }}" alt="en flag">
                                @elseif(LaravelLocalization::getCurrentLocale() == 'fr')
                                <img src="{{ asset('site/images/flags/fr-flag.png') }}" alt="fr flag">
                                @elseif(LaravelLocalization::getCurrentLocale() == 'zh')
                                <img src="{{ asset('site/images/flags/ch-flag.png') }}" alt="china flag">
                                @endif

                            </div>
                            {{ LaravelLocalization::getCurrentLocaleNative() }}
                        </span>
                    </button>
                    <div class="dropdown-content">
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <a hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            <div class="flag-div">
                                {{-- Add logic to fetch the appropriate flag image based on the locale --}}
                                @if($localeCode == 'ar')
                                <img src="{{ asset('site/images/flags/sa-flag.png') }}" alt="saudi arabia flag">
                                @elseif($localeCode == 'de')
                                <img src="{{ asset('site/images/flags/du-flag.png') }}" alt="du flag">
                                @elseif($localeCode == 'en')
                                <img src="{{ asset('site/images/flags/us-flag.png') }}" alt="en flag">
                                @elseif($localeCode == 'fr')
                                <img src="{{ asset('site/images/flags/fr-flag.png') }}" alt="fr flag">
                                @elseif($localeCode == 'zh')
                                <img src="{{ asset('site/images/flags/ch-flag.png') }}" alt="china flag">
                                @endif
                            </div>
                            {{ $properties['native'] }}
                        </a>

                        @endforeach


                    </div>
                </div>
                <div class="nav-head"></div>
                <ul class="big-menu list-unstyled">
                    <li>
                        <a href="{{ route('index') }}">{{ trans('site.home') }}</a>
                    </li>
                    <li class="">
                        <a href="{{ route('about-us') }}">{{ trans('site.about_company') }}</a>
                        <!-- <ul class="sub-menu about-menu">
                            <li>
                                <a href="{{ route('about-us') }}">{{ trans('site.about_us') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('company-message') }}">{{ trans('site.company_message') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('company-aims') }}">{{ trans('site.company_aims') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('company-vision') }}">{{ trans('site.company_vision') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('our-values') }}">{{ trans('site.our_values') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('scientific-experiences') }}">{{ trans('site.scientific_practical_experiences') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('relevant-company') }}">{{ trans('site.relevant_skills') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('team-mission') }}">{{ trans('site.team_mission') }}</a>
                            </li>
                        </ul> -->
                    </li>
                    <li >
                        <a href="{{ route('services') }}">{{ trans('site.services') }}</a>
                        {{-- <ul class="sub-menu services-menu">
                            @if ($services->count() > 0)
                            @foreach ($services as $service)
                            <li>
                                <a href="{{ route('service.details', $service['id']) }}"><i class="fa-regular fa-{{ $service['icon'] }} services-menu-icon"></i>
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
                                </a>
                            </li>
                            @endforeach
                            @endif

                        </ul> --}}
                    </li>
                    {{-- <li>
                        <a href="{{ route('partners') }}">{{ trans('site.partners') }}</a>
                    </li> --}}
                    <li>
                        <a href="{{ route('contact-us') }}">{{ trans('site.contact_us') }}</a>
                    </li>
                    {{-- <li>
                        <a href="{{ route('bloger') }}">{{ trans('site.bloger') }}</a>
                    </li> --}}

                    

                </ul>

            </div>
            <!-- end menu -->
            @if (auth()->guard('customer')->user())
            <div class="guest-ask-section">

                <div class="dropdown language-anchor">

                    <button class="dropbtn">
                        <span class="guest-link">
                            <div class="flag-div">
                                @if(LaravelLocalization::getCurrentLocale() == 'ar')
                                <img src="{{ asset('site/images/flags/sa-flag.png') }}" alt="saudi arabia flag">
                                @elseif(LaravelLocalization::getCurrentLocale() == 'de')
                                <img src="{{ asset('site/images/flags/du-flag.png') }}" alt="du flag">
                                @elseif(LaravelLocalization::getCurrentLocale() == 'en')
                                <img src="{{ asset('site/images/flags/us-flag.png') }}" alt="en flag">
                                @elseif(LaravelLocalization::getCurrentLocale() == 'fr')
                                <img src="{{ asset('site/images/flags/fr-flag.png') }}" alt="fr flag">
                                @elseif(LaravelLocalization::getCurrentLocale() == 'zh')
                                <img src="{{ asset('site/images/flags/ch-flag.png') }}" alt="china flag">
                                @endif

                            </div>
                            {{ LaravelLocalization::getCurrentLocaleNative() }}
                        </span>
                    </button>
                    <div class="dropdown-content">
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                        <a class="language-anchor @if($localeCode == LaravelLocalization::getCurrentLocale()) d-none @endif" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            <div class="flag-div">
                                {{-- Add logic to fetch the appropriate flag image based on the locale --}}
                                @if($localeCode == 'ar')
                                <img src="{{ asset('site/images/flags/sa-flag.png') }}" alt="saudi arabia flag">
                                @elseif($localeCode == 'de')
                                <img src="{{ asset('site/images/flags/du-flag.png') }}" alt="du flag">
                                @elseif($localeCode == 'en')
                                <img src="{{ asset('site/images/flags/us-flag.png') }}" alt="en flag">
                                @elseif($localeCode == 'fr')
                                <img src="{{ asset('site/images/flags/fr-flag.png') }}" alt="fr flag">
                                @elseif($localeCode == 'zh')
                                <img src="{{ asset('site/images/flags/ch-flag.png') }}" alt="china flag">
                                @endif
                            </div>
                            {{ $properties['native'] }}
                        </a>
                        @endforeach

                    </div>
                </div>
                <a href="{{route('site.profile.notifications')}}" class="guest-link for-user">
                    <i class="fa-regular fa-bell user-icon notifications-icon">
                        <span class="dot @if(auth("customer")->user()->unreadNotifications()->count()) bg-danger @endif"></span>
                    </i>
                    <span class="notification-account-word">{{ trans('site.notifications') }}</span>
                </a>
                <div class="dropdown">
                    <button class="dropbtn">
                        <i class="fa-regular fa-user user-icon"></i>
                        <span class="guest-link">{{ trans('site.my_account') }}</span>
                    </button>
                    <div class="dropdown-content">
                        <a href="{{ route('site.profile') }}">{{ trans('site.edit_account') }}</a>
                        <a href="{{ route('site.profile.changePassword') }}">{{ trans('site.change_password') }}</a>
                        <a href="{{ route('site.profile.myOrders') }}">{{ trans('site.my_orders') }}</a>
                        <a href="{{ route('site.profile.payments') }}">{{ trans('site.payments') }}</a>
                        <a href="{{ route('site.profile.notifications') }}">{{ trans('site.notifications') }}</a>
                        <a href="{{ route('site.profile.logout') }}">{{ trans('site.logout') }}</a>
                    </div>

                    <!-- consultation-link -->
                    <!-- end consultation-link -->
                </div>
                <!-- consultation-link -->
                <a href="{{ route('site.request-consultation') }}" class="consultation-link">{{ trans('site.Request_consultation') }}</a>

                <div class="show-icons">
                    <a class="menu-bars" id="menu-id" href="#!">.
                        <i class="fa-regular fa-bars bar show-icon"></i>
                        <i class="fa-regular fa-xmark times hide-icon"></i>
                    </a>
                </div>
            </div>
            <!-- end consultation-link -->
        </div>
        @else
        <div class="guest-ask-section">

        <div class="dropdown language-anchor">
    <button class="dropbtn">
        <span class="guest-link">
            <div class="flag-div">
                @if(LaravelLocalization::getCurrentLocale() == 'ar')
                    <img src="{{ asset('site/images/flags/sa-flag.png') }}" alt="saudi arabia flag">
                @elseif(LaravelLocalization::getCurrentLocale() == 'en')
                    <img src="{{ asset('site/images/flags/us-flag.png') }}" alt="en flag">
                @elseif(LaravelLocalization::getCurrentLocale() == 'de')
                    <img src="{{ asset('site/images/flags/du-flag.png') }}" alt="du flag">
                @elseif(LaravelLocalization::getCurrentLocale() == 'fr')
                    <img src="{{ asset('site/images/flags/fr-flag.png') }}" alt="fr flag">
                @elseif(LaravelLocalization::getCurrentLocale() == 'zh')
                    <img src="{{ asset('site/images/flags/ch-flag.png') }}" alt="china flag">
                @endif
            </div>
            {{ LaravelLocalization::getCurrentLocaleNative() }}
        </span>
    </button>
    <div class="dropdown-content">
        {{-- إضافة اللغة العربية أولاً --}}
        <a class="language-anchor @if('ar' == LaravelLocalization::getCurrentLocale()) d-none @endif" rel="alternate" hreflang="ar" href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}">
            <div class="flag-div">
                <img src="{{ asset('site/images/flags/sa-flag.png') }}" alt="saudi arabia flag">
            </div>
            {{ LaravelLocalization::getSupportedLocales()['ar']['native'] }}
        </a>

        {{-- إضافة اللغة الإنجليزية ثانياً --}}
        <a class="language-anchor @if('en' == LaravelLocalization::getCurrentLocale()) d-none @endif" rel="alternate" hreflang="en" href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">
            <div class="flag-div">
                <img src="{{ asset('site/images/flags/us-flag.png') }}" alt="en flag">
            </div>
            {{ LaravelLocalization::getSupportedLocales()['en']['native'] }}
        </a>

        {{-- إضافة باقي اللغات --}}
        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            @if ($localeCode != 'ar' && $localeCode != 'en') {{-- استبعاد العربية والإنجليزية --}}
                <a class="language-anchor @if($localeCode == LaravelLocalization::getCurrentLocale()) d-none @endif" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                    <div class="flag-div">
                        @if($localeCode == 'de')
                            <img src="{{ asset('site/images/flags/du-flag.png') }}" alt="du flag">
                        @elseif($localeCode == 'fr')
                            <img src="{{ asset('site/images/flags/fr-flag.png') }}" alt="fr flag">
                        @elseif($localeCode == 'zh')
                            <img src="{{ asset('site/images/flags/ch-flag.png') }}" alt="china flag">
                        @endif
                    </div>
                    {{ $properties['native'] }}
                </a>
            @endif
        @endforeach
    </div>
</div>
            </div>
            <a href="{{ route('login') }}" class="guest-link">
                <i class="fa-regular fa-user user-icon"></i>@lang('site.sign in')</a>

            <a href="{{ route('login') }}" class="consultation-link">{{ trans('site.Request_consultation') }}</a>

            <div class="show-icons">
                <a class="menu-bars" id="menu-id" href="#!">
                    <i class="fa-regular fa-bars bar show-icon"></i>
                    <i class="fa-regular fa-xmark times hide-icon"></i>
                </a>
            </div>

        </div>
        @endif
        <!-- end nav-header -->
        <!-- menu-icon-for-mobile -->
        {{-- <div class="show-icons">
                <a class="menu-bars" id="menu-id" href="#!">
                    <i class="fa-regular fa-bars bar show-icon"></i>
                    <i class="fa-regular fa-xmark times hide-icon"></i>
                </a>
            </div> --}}
        <!-- end menu-icon-for-mobile -->
    </div>

</header>

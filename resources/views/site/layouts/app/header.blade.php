<header>
    <div class="top-header">
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
                    <li class="menu-item-has-children">
                        <a href="#">{{ trans('site.about_company') }}</a>
                        <ul class="sub-menu about-menu">
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
                        </ul>
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
                    <li>
                        <a href="{{ route('partners') }}">{{ trans('site.partners') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('contact-us') }}">{{ trans('site.contact_us') }}</a>
                    </li>


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
                    <a class="menu-bars" id="menu-id" href="#!">
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

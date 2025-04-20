<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}" dir={{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@lang('site.project_name')  @yield('page_title')</title>
    


    <meta name="description" content="@if(isset($metaDescription) && $metaDescription){{ $metaDescription }}@else{{ "شركة عثمان بن أحمد الدويش هي شركة متخصصة في المحاماة وتقديم الاستشارات القانونية، تقدم خدمات قانونية شاملة تشمل الترافع والاستشارات عن بُعد، لضمان تحقيق العدالة ودعم عملائها بكفاءة واحترافية." }}@endif">
    <meta name="keywords" content="قانون, محاماة, استشارات قانونية, أنظمة السعودية">
    <meta name="author" content="مدونة القانون">
    
    <meta property="og:title" content="@yield('metaDescription')">
    <meta property="og:description" content="@yield('metaDescription')">
    <meta property="og:type" content="website">
    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('page_title')">
    <meta name="twitter:description" content="@yield('metaDescription')">


    {{-- search google. --}}
    <meta name="google-site-verification" content="a8707UVEOmFW50GqnHLENo2WVwNgizqK3zncSUQtqk0" />
    
    @include('site.layouts.app.style')
    @stack('style')
    @routes
    @livewireStyles

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-7MEF7J4PD0"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-7MEF7J4PD0');
    </script>
    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-WG49SFNV');</script>
    <!-- End Google Tag Manager -->
</head>

<body class="@yield('body_class')">
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WG49SFNV"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    @include('site.layouts.app.preloader')

    @include('site.layouts.app.header')
    @yield('breadcrumb')
    @yield('content')
    @include('site.layouts.app.footer')
    @include('site.layouts.app.arrow')
    @include('site.layouts.app.footer-js')
    @livewire('wire-elements-modal')
@livewireScripts
    @stack('scripts')
</body>

</html>

<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}" dir={{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@lang('site.project_name')  @yield('page_title')</title>
    @include('site.layouts.app.style')
    @stack('style')
    @routes
    @livewireStyles
</head>

<body class="@yield('body_class')">
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

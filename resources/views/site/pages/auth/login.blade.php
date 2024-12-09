@extends('site.layouts.master')
@section('page_title', __('site.sign in'))
@section('meta_title', __('site.sign in'))
@section('body_class' , 'inner-page')
@section('content')

    @include('site.layouts.app.breadcrumb')

    <div class="about-us-section">
        <div class="container">
            <div class="careers-section">
                <h2 class="sign-in-title">
                    @lang('site.do not have an account?')
                    <a href="{{ route('register') }}" class="register-link">
                        @lang('site.register now')
                    </a>
                </h2>
                <livewire:login />
            </div>

        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function togglePassword() {

            var x = document.getElementById("pass");
            var eyeSlash = document.getElementById("eye-slash");
            var eye = document.getElementById("eye");
            if (x.type === "password") {
                x.type = "text";
                eyeSlash.style.display = "none";
                eye.style.display = "block";

            } else {
                x.type = "password";
                eyeSlash.style.display = "block";
                eye.style.display = "none";
            }
        }
    </script>
@endpush

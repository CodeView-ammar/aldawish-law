@extends('site.layouts.master')
@section('page_title', __('site.new registration'))
@section('meta_title', __('site.new registration'))
@section('body_class' , 'inner-page')
@section('content')

    @include('site.layouts.app.breadcrumb')

    <div class="about-us-section">
        <div class="container">
            <div class="careers-section">
                <h2 class="sign-in-title">
                    @lang('site.already have an account?')
                    <a href="{{ route('login') }}" class="register-link">
                        @lang('site.login now')
                    </a>
                </h2>
                <livewire:register />
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

        function togglePassword2() {

            var xx = document.getElementById("pass2");
            var eyeSlashh = document.getElementById("eye-slash2");
            var eyee = document.getElementById("eye2");
            if (xx.type === "password") {
                xx.type = "text";
                eyeSlashh.style.display = "none";
                eyee.style.display = "block";

            } else {
                xx.type = "password";
                eyeSlashh.style.display = "block";
                eyee.style.display = "none";
            }
        }
    </script>
@endpush

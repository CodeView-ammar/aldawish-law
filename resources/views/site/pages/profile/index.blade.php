@extends('site.layouts.master')
@section('page_title', __('site.update profile'))
@section('meta_title', __('site.update profile'))
@section('body_class', 'inner-page')
@section('content')

    @include('site.layouts.app.breadcrumb')

    <div class="about-us-section">
        <div class="container">
            <div class="careers-section">
                <div class="edit-account-section">
                    @include('site.layouts.app.profile_menue')
                    <livewire:edit-profile />
                </div>
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

@extends('site.layouts.master')
@section('page_title', __('site.change password'))
@section('meta_title', __('site.change password'))
@section('body_class', 'inner-page')
@section('content')

    @include('site.layouts.app.breadcrumb')

    <div class="about-us-section">
        <div class="container">
            <div class="careers-section">
                <div class="edit-account-section">
                    @include('site.layouts.app.profile_menue')
                    <livewire:edit-password />
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

        function togglePassword3() {

            var xxx = document.getElementById("pass3");
            var eyeSlashhh = document.getElementById("eye-slash3");
            var eyeee = document.getElementById("eye3");
            if (xxx.type === "password") {
                xxx.type = "text";
                eyeSlashhh.style.display = "none";
                eyeee.style.display = "block";

            } else {
                xxx.type = "password";
                eyeSlashhh.style.display = "block";
                eyeee.style.display = "none";
            }
        }
    </script>
@endpush

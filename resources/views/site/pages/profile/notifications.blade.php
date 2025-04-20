@extends('site.layouts.master')
@section('page_title', __('site.notifications'))
@section('meta_title', __('site.notifications'))
@section('body_class', 'inner-page')
@section('content')

    @include('site.layouts.app.breadcrumb')

    <div class="about-us-section">
        <div class="container">
            <div class="careers-section">
                <div class="edit-account-section">
                    @include('site.layouts.app.profile_menue')
                    <div class="careers-form-section w-848">
                        <div class="notifications-title-bar">
                            <h2 class="sign-in-success-title text-start w-auto ">
                                @lang('site.notifications')
                            </h2>
                            @if ($notifications->count() > 0)
                                <a href="{{ route('site.profile.notifications.delete') }}" class="delete-notifications">
                                    @lang('site.delete all notifications')
                                </a>
                            @endif
                        </div>
                        @if ($notifications->count() > 0)
                            @foreach ($notifications as $notification)
                                <div class="notification-block">
                                    <div class="small-logo">
                                        <img src="{{ asset('site/images/small-logo.png') }}"   alt="small logo">
                                        {{-- <img src="{{ asset('storage/' . $app_logo) }}" style="width: 40px;height:40px;"   alt="small logo"> --}}
                                    </div>
                                    <div class="notification-text">
                                        <p class="notification-content">
                                            {{ $notification->body ?? '' }}
                                        </p>
                                        <span class="notification-date">
                                            {{ $notification->created_at ?? '' }}
                                        </span>
                                    </div>
                                </div>

                            @endforeach
                            @else
                            <div class="about-us-section height-auto">
                                <div class="container">
                                    <div class="careers-section">
                                        <p class="success-text">
                                            @lang('site.noti_empty')
                                        </p>
                                    </div>
                                </div>
                            </div>
                           
                        @endif
                    </div>
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
    </script>
@endpush

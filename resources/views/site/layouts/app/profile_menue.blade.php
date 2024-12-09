<ul class="my-account-list">
    <li class="name">
       @lang("site.hello_name",["NAME"=> auth()->guard('customer')->user()->name ?? '' ])
    </li>
    <li class="my-account-link @if (\Route::currentRouteName() === 'site.profile') active @endif">
        <a href="{{ route('site.profile') }}">
            <i class="fa-regular fa-pen-to-square my-account-icon"></i>
            @lang('site.update profile')
        </a>
    </li>
    <li class="my-account-link @if (\Route::currentRouteName() === 'site.profile.changePassword') active @endif">
        <a href="{{ route('site.profile.changePassword') }}">
            <i class="fa-regular fa-lock my-account-icon"></i>
            @lang('site.change password')
        </a>
    </li>
    <li class="my-account-link @if (\Route::currentRouteName() === 'site.profile.myOrders') active @endif">
        <a href="{{ route('site.profile.myOrders') }}">
            <i class="fa-regular fa-square-list my-account-icon"></i>
            @lang('site.my orders')
        </a>
    </li>
    <li class="my-account-link @if (\Route::currentRouteName() === 'site.profile.payments') active @endif">
        <a href="{{ route('site.profile.payments') }}">
            <i class="fa-regular fa-credit-card my-account-icon"></i>
            @lang('site.payments')
        </a>
    </li>
    <li class="my-account-link @if (\Route::currentRouteName() === 'site.profile.notifications') active @endif">
        <a href="{{ route('site.profile.notifications') }}">
            <i class="fa-regular fa-bell my-account-icon"></i>
            @lang('site.notifications')
        </a>
    </li>
    <li class="my-account-link @if (\Route::currentRouteName() === 'site.profile.logout') active @endif">
        <a href="{{ route('site.profile.logout') }}">
            <i class="fa-regular fa-arrow-right-from-bracket my-account-icon"></i>
            @lang('site.logout')
        </a>
    </li>
</ul>

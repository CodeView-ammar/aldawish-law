<?php

namespace Tasawk\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Spatie\Permission\Models\Role;
use Tasawk\Models\Content\Banner;
use Tasawk\Models\Content\Contact;
use Tasawk\Models\Content\Page;
use Tasawk\Models\Customer;
use Tasawk\Policies\Content\BannerPolicy;
use Tasawk\Policies\Content\ContactPolicy;
use Tasawk\Policies\Content\PagePolicy;
use Tasawk\Policies\CustomerPolicy;
use Tasawk\Policies\RolePolicy;

class AuthServiceProvider extends ServiceProvider {
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Customer::class => CustomerPolicy::class,
        Page::class => PagePolicy::class,
        Banner::class => BannerPolicy::class,
        Contact::class => ContactPolicy::class,
        Role::class=>RolePolicy::class,


    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void {
        //
    }
}

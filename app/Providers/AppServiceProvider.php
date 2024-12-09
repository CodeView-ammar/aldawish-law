<?php

namespace Tasawk\Providers;

use App\Settings\DeveloperSetting;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification as BaseNotification;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentView;
use Filament\Tables\Columns\Column;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use MyFatoorah\Library\PaymentMyfatoorahApiV2;
use Spatie\Translatable\Facades\Translatable;
use Statikbe\FilamentTranslationManager\FilamentTranslationManager;
use Tasawk\Filament\Pages\Settings\ManageDeveloper;
use Tasawk\Lib\Cart;
use Tasawk\Models\Pages\OurService;
use Tasawk\Notifications\Notification;
use Tasawk\Settings\GeneralSettings;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     */
    public function register(): void {
        $this->app->bind(PaymentMyfatoorahApiV2::class, function () {
            return new PaymentMyfatoorahApiV2(
                config('myfatoorah.api_key'),
                config('myfatoorah.country_iso'),
                config('myfatoorah.test_mode')
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        FilamentTranslationManager::setLocales(['ar', 'en', 'fr', 'de', 'zh']);
        if (Schema::hasTable('settings')) {
            $generalSettings = new GeneralSettings();
            $app_logo = $generalSettings->app_logo;
            View::share('app_logo', $app_logo);
            $social_media = $generalSettings->social_links;
            View::share('social_media', $social_media);
            $app_whatsapp = $generalSettings->app_whatsapp;
            View::share('app_whatsapp', $app_whatsapp);

            // $years_of_experience_text = $generalSettings->years_of_experience_text;
            // View::share('years_of_experience_text', $years_of_experience_text);
            // $successful_pleadings_text = $generalSettings->successful_pleadings_text;
            // View::share('successful_pleadings_text', $successful_pleadings_text);
            // $legal_experts_text = $generalSettings->legal_experts_text;
            // View::share('legal_experts_text', $legal_experts_text);
            // $settings = new DeveloperSetting();
            // config()->set("app.debug", $settings->debug_mode);
        }
        if (Schema::hasTable('page_contents')) {
            $services = OurService::
            select('id', 'title->ar  as title_ar', 'title->fr  as title_fr','title->de  as title_de','title->zh  as title_zh','title->en  as title_en', 'description->ar  as description_ar','description->fr  as description_fr','description->de  as description_de','description->zh  as description_zh',  'description->en  as description_en', 'icon')
            ->where('status', 1)
            ->orderBy('sort','asc')
            ->get();
            View::share('services', $services);
        }
        Translatable::fallback(
            fallbackAny: true,
        );
//        $settings = new DeveloperSetting();
//
//        config()->set("app.debug", $settings->debug_mode);


        $this->app->bind(BaseNotification::class, Notification::class);
        $this->translateLabels();
        $this->cart();
        FilamentView::registerRenderHook(
            'panels::scripts.after',
            fn(): string => Blade::render('filament.firebase-initialization'),
        );
        FilamentView::registerRenderHook(
            'panels::body.start',
            fn(): string => Blade::render('filament.hooks.body-start'),
        );

        Paginator::useBootstrap();

        FilamentAsset::register([
            Css::make('fontawesome', asset('https://pro.fontawesome.com/releases/v5.10.0/css/all.css')),
            Css::make('agora', asset('assets/css/agora.css')),
            Js::make('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js'),
        ]);

        FilamentView::registerRenderHook(
            'panels::head.end',
            fn(): string => Blade::render('filament.hooks.head-end'),
        );


    }

    private function cart() {
        $this->app->singleton('cart', function ($app) {
            $storageClass = config('shopping_cart.storage');
            $eventsClass = config('shopping_cart.events');
            $storage = $storageClass ? new $storageClass() : $app['session'];
            $events = $eventsClass ? new $eventsClass() : $app['events'];
            $instanceName = 'cart';
            if (!session()->has('cart_id')) {
                session(['cart_id' => uniqid()]);
            }
            $session_key = session('cart_id');
            return new Cart(
                $storage,
                $events,
                $instanceName,
                $session_key,
                config('shopping_cart')
            );
        });
        app('events')->listen('cart.cleared', function ($cart) {
            /** @var Cart $coreCart */
            $coreCart = $this->app['cart'];
            session(['cart_id' => uniqid()]);
            $session_key = session('cart_id');
            $coreCart->session($session_key);
        });
    }


    private function translateLabels(): void {
        $translateLabelsComponents = [
            Field::class,
            Filter::class,
            SelectFilter::class,
        ];
        foreach ($translateLabelsComponents as $component) {
            $component::configureUsing(function ($c): void {
                $c->label(__('forms.fields.' . $c->getName()));
            });
        }
        Field::macro('translatable', function () {
            return $this->hint(__('forms.fields.translatable'))
                ->hintIcon('heroicon-m-language');
        });

        Table::configureUsing(function (Table $table): void {
            $table->modifyQueryUsing(function (Builder $query): void {
                if ($query->getColumns()->getModel()->getCreatedAtColumn()) {
                    $query->latest();
                }

            });
        });

        TextEntry::configureUsing(function (TextEntry $field): void {
            $field->label(__('forms.fields.' . Str::replace('.', '_', $field->getName())));
        });

        Section::configureUsing(function (Section $section): void {
            $section
                ->collapsible()
                ->heading(__('sections.' . Str::lower($section->getHeading())));

        });
        Column::configureUsing(function ($c): void {
            $c->label(fn($column): string => __("forms.fields." . Str::replace('.', '_', $column->getName())))
                ->translateLabel()
                ->toggleable();
        });

        \Filament\Infolists\Components\Section::configureUsing(function (\Filament\Infolists\Components\Section $section): void {
            $section->collapsible()->heading(__('sections.' . Str::lower($section->getHeading())));

       });


    }

}
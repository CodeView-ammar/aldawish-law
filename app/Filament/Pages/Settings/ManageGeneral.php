<?php

namespace Tasawk\Filament\Pages\Settings;

use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Text;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Illuminate\Contracts\Support\Htmlable;
use Tasawk\Forms\Components\SelectFontAwesomeIcon;
use Tasawk\Models\Content\Page;
use Tasawk\Settings\GeneralSettings;

class ManageGeneral extends SettingsPage
{
    use HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = GeneralSettings::class;

    protected static ?string $slug = 'settings/general';

    protected static ?int $navigationSort = 1;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('General')->schema([
                    Tabs::make('Label')
                        ->tabs([
                            Tabs\Tab::make(__('panel.languages.arabic'))
                                ->schema([
                                    Textarea::make('app_location.ar')
                                        ->label(__('forms.fields.address'))
                                        ->minLength(3)
                                        ->required(),
                                    Textarea::make('years_of_experience_text.ar')
                                        ->label(__('forms.fields.years_of_experience_text'))
                                        ->minLength(3),
                                    // ->required(),
                                    TextInput::make('years_of_experience')
                                        ->label(__('forms.fields.years_of_experience'))
                                        ->type('number')
                                        ->rules(['numeric'])
                                        ->required(),
                                    Textarea::make('successful_pleadings_text.ar')
                                        ->label(__('forms.fields.successful_pleadings_text'))
                                        ->minLength(3),
                                    // ->required(),
                                    TextInput::make('successful_pleadings')
                                        ->label(__('forms.fields.successful_pleadings'))
                                        ->type('number')
                                        ->rules(['numeric'])
                                        ->required(),
                                    Textarea::make('legal_experts_text.ar')
                                        ->label(__('forms.fields.legal_experts_text'))
                                        ->minLength(3),
                                    // ->required(),
                                    TextInput::make('legal_experts')
                                        ->label(__('forms.fields.legal_experts'))
                                        ->type('number')
                                        ->rules(['numeric'])
                                        ->required(),
                                    TextInput::make('account_number')
                                        ->label(__('forms.fields.account_number'))
                                        ->required(),
                                    TextInput::make('iban_number')
                                        ->label(__('forms.fields.iban_number'))
                                        ->required(),
                                ]),
                            Tabs\Tab::make(__('panel.languages.english'))
                                ->schema([
                                    Textarea::make('app_location.en')
                                        ->label(__('forms.fields.address'))
                                        ->minLength(3)
                                        ->required(),
                                    Textarea::make('years_of_experience_text.en')
                                        ->label(__('forms.fields.years_of_experience_text'))
                                        ->minLength(3)
                                        ->required(),
                                    TextInput::make('years_of_experience')
                                        ->label(__('forms.fields.years_of_experience'))
                                        ->type('number')
                                        ->rules(['numeric'])
                                        ->required(),
                                    Textarea::make('successful_pleadings_text.en')
                                        ->label(__('forms.fields.successful_pleadings_text'))
                                        ->minLength(3)
                                        ->required(),
                                    TextInput::make('successful_pleadings')
                                        ->label(__('forms.fields.successful_pleadings'))
                                        ->type('number')
                                        ->rules(['numeric'])
                                        ->required(),
                                    Textarea::make('legal_experts_text.en')
                                        ->label(__('forms.fields.legal_experts_text'))
                                        ->minLength(3)
                                        ->required(),
                                    TextInput::make('legal_experts')
                                        ->label(__('forms.fields.legal_experts'))
                                        ->type('number')
                                        ->rules(['numeric'])
                                        ->required(),
                                ]),
                            Tabs\Tab::make(__('panel.languages.german'))
                                ->schema([
                                    Textarea::make('app_location.de')
                                        ->label(__('forms.fields.address'))
                                        ->minLength(3)
                                        ->required(),
                                    Textarea::make('years_of_experience_text.de')
                                        ->label(__('forms.fields.years_of_experience_text'))
                                        ->minLength(3)
                                        ->required(),
                                    TextInput::make('years_of_experience')
                                        ->label(__('forms.fields.years_of_experience'))
                                        ->type('number')
                                        ->rules(['numeric'])
                                        ->required(),
                                    Textarea::make('successful_pleadings_text.de')
                                        ->label(__('forms.fields.successful_pleadings_text'))
                                        ->minLength(3)
                                        ->required(),
                                    TextInput::make('successful_pleadings')
                                        ->label(__('forms.fields.successful_pleadings'))
                                        ->type('number')
                                        ->rules(['numeric'])
                                        ->required(),
                                    Textarea::make('legal_experts_text.de')
                                        ->label(__('forms.fields.legal_experts_text'))
                                        ->minLength(3)
                                        ->required(),
                                    TextInput::make('legal_experts')
                                        ->label(__('forms.fields.legal_experts'))
                                        ->type('number')
                                        ->rules(['numeric'])
                                        ->required(),
                                ]),
                            Tabs\Tab::make(__('panel.languages.french'))
                                ->schema([
                                    Textarea::make('app_location.fr')
                                        ->label(__('forms.fields.address'))
                                        ->minLength(3)
                                        ->required(),
                                    Textarea::make('years_of_experience_text.fr')
                                        ->label(__('forms.fields.years_of_experience_text'))
                                        ->minLength(3)
                                        ->required(),
                                    TextInput::make('years_of_experience')
                                        ->label(__('forms.fields.years_of_experience'))
                                        ->type('number')
                                        ->rules(['numeric'])
                                        ->required(),
                                    Textarea::make('successful_pleadings_text.fr')
                                        ->label(__('forms.fields.successful_pleadings_text'))
                                        ->minLength(3)
                                        ->required(),
                                    TextInput::make('successful_pleadings')
                                        ->label(__('forms.fields.successful_pleadings'))
                                        ->type('number')
                                        ->rules(['numeric'])
                                        ->required(),
                                    Textarea::make('legal_experts_text.fr')
                                        ->label(__('forms.fields.legal_experts_text'))
                                        ->minLength(3)
                                        ->required(),
                                    TextInput::make('legal_experts')
                                        ->label(__('forms.fields.legal_experts'))
                                        ->type('number')
                                        ->rules(['numeric'])
                                        ->required(),
                                ]),
                            Tabs\Tab::make(__('panel.languages.chinese'))
                                ->schema([
                                    Textarea::make('app_location.zh')
                                        ->label(__('forms.fields.address'))
                                        ->minLength(3)
                                        ->required(),
                                    Textarea::make('years_of_experience_text.zh')
                                        ->label(__('forms.fields.years_of_experience_text'))
                                        ->minLength(3)
                                        ->required(),
                                    TextInput::make('years_of_experience')
                                        ->label(__('forms.fields.years_of_experience'))
                                        ->type('number')
                                        ->rules(['numeric'])
                                        ->required(),
                                    Textarea::make('successful_pleadings_text.zh')
                                        ->label(__('forms.fields.successful_pleadings_text'))
                                        ->minLength(3)
                                        ->required(),
                                    TextInput::make('successful_pleadings')
                                        ->label(__('forms.fields.successful_pleadings'))
                                        ->type('number')
                                        ->rules(['numeric'])
                                        ->required(),
                                    Textarea::make('legal_experts_text.zh')
                                        ->label(__('forms.fields.legal_experts_text'))
                                        ->minLength(3)
                                        ->required(),
                                    TextInput::make('legal_experts')
                                        ->label(__('forms.fields.legal_experts'))
                                        ->type('number')
                                        ->rules(['numeric'])
                                        ->required(),
                                ]),
                        ]),
                    FileUpload::make('app_logo'),
                    TextInput::make('app_name')
                        ->required(),
                    TextInput::make('app_email')
                        ->email()
                        ->required(),
                    TextInput::make('app_phone')
                        ->type('number')
                        ->numeric()
                        ->required(),
                    TextInput::make('app_whatsapp')
                        ->type('number')
                        ->numeric()
                        ->required(),
                    Select::make('forget_verification')
                        ->options([
                            'phone' => __('forms.fields.phone'),
                            'email' => __('forms.fields.email'),
                        ])
                        ->label(__('forms.fields.forget_verification'))
                        ->required(),
                    // TextInput::make('taxes')
                    //     ->label(__("forms.fields.taxes"))
                    //     ->type('number')
                    //     ->suffix("%")
                    //     ->rules(['numeric', 'min:1', 'max:100'])
                    //     ->required(),
                    // TextInput::make('years_of_experience_text')
                    //     ->label(__("forms.fields.years_of_experience_text"))
                    //     ->type('text')
                    //     ->required(),

                    // TextInput::make('successful_pleadings_text')
                    //     ->label(__("forms.fields.successful_pleadings_text"))
                    //     ->type('text')
                    //     ->required(),

                    // TextInput::make('legal_experts_text')
                    //     ->label(__("forms.fields.legal_experts_text"))
                    //     ->type('text')
                    //     ->required(),

                ]),
                Forms\Components\Section::make('applications_links')->schema([
                    TextInput::make('applications_links.google_play_link')
                        ->label(__('forms.fields.google_play_link'))
                        ->url()
                        ->required(),
                    TextInput::make('applications_links.apple_store_link')
                        ->label(__('forms.fields.apple_store_link'))
                        ->url()
                        ->required(),
                ])->columns(1),
                Forms\Components\Section::make('app_pages')->schema([
                    Select::make('app_pages.terms_and_conditions')
                        ->options(Page::pluck('title', 'id')->toArray())
                        ->label(__('forms.fields.terms_and_conditions'))
                        ->required(),
                    Select::make('app_pages.privacy_policy')
                        ->options(Page::pluck('title', 'id')->toArray())
                        ->label(__('forms.fields.privacy_policy'))
                        ->required(),
                ])->columns(1)
                    ->collapsible(),
                Forms\Components\Section::make('social_links')->schema([
                    Repeater::make('social_links')
                        ->label('')
                        ->schema([
                            SelectFontAwesomeIcon::make('icon')
                                ->searchable()
                                ->allowHtml(),
                            TextInput::make('link')
                                ->url(),
                        ]),
                ])->collapsible(),
                Forms\Components\Section::make('working_days')->schema([
                    static::workingDaysSchema(),
                ]),
            ]);
    }

    public static function getNavigationLabel(): string
    {
        return __('menu.general');
    }

    public function getHeading(): string|Htmlable
    {
        return __('sections.global_settings');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('menu.settings');
    }

    public function getTitle(): string|Htmlable
    {
        return __('sections.global_settings');
    }

    public function workingDaysSchema(): Repeater
    {
        $schema = [];
        foreach (['saturday', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday'] as $day) {

            $schema[] = Group::make([
                Checkbox::make("$day.status")->label(__("forms.fields.weekdays.$day")),
                Hidden::make("$day.day_name")->default($day),
                TextInput::make("$day.from")->type('time')->label('')->default('00:00'),
                TextInput::make("$day.to")->type('time')->label('')->default('23:59'),
            ])->columns(3);
        }

        return Repeater::make('working_days')
            ->schema($schema)
            ->reorderable(false)
            ->deletable(false)
            ->minItems(1)
            ->maxItems(1);
    }

    public function getBreadcrumbs(): array
    {
        return [
            null => static::getNavigationGroup(),
            static::getUrl() => static::getNavigationLabel(),
        ];
    }
}
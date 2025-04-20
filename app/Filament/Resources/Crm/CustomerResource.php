<?php

namespace Tasawk\Filament\Resources\Crm;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Tasawk\Models\Customer;
use Tasawk\Rules\NumberRule;
use Tasawk\Models\Nationality;
use Tasawk\Rules\KSAPhoneRule;
use Doctrine\DBAL\Schema\Schema;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Tasawk\Filament\Resources\Crm;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\Grid;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rules\Password;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Concerns\Translatable;
use Tasawk\Traits\Filament\HasTranslationLabel;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms\Components\DatePicker;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Ysfkaya\FilamentPhoneInput\Tables\PhoneColumn;
use Ysfkaya\FilamentPhoneInput\Infolists\PhoneEntry;
// use Ysfkaya\FilamentPhoneInput\Infolists\PhoneInputNumberType;
use libphonenumber\PhoneNumberType;
use Ysfkaya\FilamentPhoneInput\PhoneInputNumberType;

class CustomerResource extends Resource implements HasShieldPermissions
{
    use Translatable;
    use HasTranslationLabel;

    protected static ?string $model = Customer::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'name';
    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'email', 'phone'];
    }

    // public static function getGlobalSearchResultDetails(Model $record): array
    // {
    //     return [
    //         __('forms.fields.name') => $record->name,
    //         __('forms.fields.email') => $record->email,
    //         __('forms.fields.phone') => $record->phone,
    //     ];
    // }

    // public static function getGlobalSearchResultTitle(Model $record): string {
    //     return $record->name;
    // }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\Section::make("basic_information")
                    // ->schema([
                        TextInput::make('name')
                            ->columnSpan(['sm' => 1])
                            ->required(),
                        TextInput::make('email')
                            ->required()
                            ->email()
                            ->autocomplete("off")
                            ->columnSpan(['sm' => 1])
                            ->unique(ignoreRecord: true),
                        PhoneInput::make('phone')
                            ->required()
                            ->columnSpan(['sm' => 1])
                            ->live()
                            ->defaultCountry('SA')
                            ->validateFor(
                                type: PhoneNumberType::MOBILE,
                                lenient: true
                            )
                            ->unique(ignoreRecord: true)
                            ->displayNumberFormat(PhoneInputNumberType::E164),
                        Select::make('gender')
                            ->options([
                                'male' => __('forms.fields.male'),
                                'female' => __('forms.fields.female'),
                            ])
                            ->required()
                            ->columnSpan(['sm' => 1]),
                        DatePicker::make('birthday')
                            ->rules(["required"])
                            ->columnSpan(['sm' => 1]),
                            Textarea::make('address')
                            ->required()
                            ->columnSpan(['sm' => 1]),
                            TextInput::make('nationality')
                            ->label(__('forms.fields.nationality_name'))
                            ->required()
                            // ->options(Nationality::pluck('name', 'id'))
                            // ->searchable(['name->ar', 'name->en'])
                            ->columnSpan(['sm' => 1]),
                        // TextInput::make('id_number')
                        // ->label(__('site.id number'))
                        // ->required()
                        // ->columnSpan(1),


                            // ->rules([ new NumberRule()])
                        // TextInput::make('passport_number')
                        //     ->columnSpan(['sm' => 2, 'xl' => 1]),


                        TextInput::make('password')
                            ->password()
                            ->rules([
                                Password::min(8)
                                    ->mixedCase()
                                    ->letters()
                                    ->numbers()
                                    ->symbols()
                            ])
                            ->required(fn (string $operation): bool => $operation === 'create')
                            ->confirmed()
                            ->autocomplete("off"),
                        TextInput::make('password_confirmation')
                            ->password()
                            ->required(fn (string $operation): bool => $operation === 'create')
                            ->autocomplete("off"),

                        Toggle::make('active')->default(1)
                            ->onColor('success')
                            ->offColor('danger')

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->translateLabel(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->copyable()
                    ->copyMessage('Email address copied')
                    ->copyMessageDuration(1500)
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Phone address copied')
                    ->copyMessageDuration(1500),
                IconColumn::make('active')
                    ->boolean()
                    ->action(
                        Action::make('Active')
                            ->label(fn (Model $record): string => $record->active ? __('panel.messages.deactivate') : __('panel.messages.activate'))
                            ->disabled(fn (Model $record): bool => !auth()->user()->can('update', static::getModel()))
                            ->requiresConfirmation()
                            ->disabled(fn (Model $record): bool => !auth()->user()->can('update', static::getModel()))
                            ->action(fn (Model $record) => $record->toggleActive())


                    )
            ])
            ->filters([
                Filter::make('ID')
                    ->form([
                        TextInput::make('id'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when($data['id'], fn (Builder $query, $date): Builder => $query->where('id', $data['id']));
                    })
                    ->indicateUsing(function (array $data): ?string {
                        if (!$data['id']) {
                            return null;
                        }

                        return __('forms.fields.id') . " " . $data['id'];
                    }),
                Filter::make('active')
                    ->query(fn (Builder $query): Builder => $query->where('active', 1))
                    ->toggle(),
            ])
            ->actions([


                // Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->striped();
    }

    static public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Grid::make()->schema([
                    Section::make("basic_information")
                        ->schema([
                            TextEntry::make('id'),
                            TextEntry::make('name'),
                            TextEntry::make('email'),
                            PhoneEntry::make('phone'),
                            TextEntry::make('active')->badge(),
                        ])->columns(1),

                ])->columns(2)
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // RelationGroup::make(__('sections.orders'), [
            //     OrdersRelationManager::class,
            // ]),
            // RelationGroup::make(__('sections.address_book'), [
            //     AddressBookRelationManager::class
            // ]),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Crm\CustomerResource\Pages\ListCustomers::route('/'),
            'view' => Crm\CustomerResource\Pages\ViewCustomers::route('/{record}/view'),
        ];
    }


    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            __('forms.fields.name') => $record->name,
            __('forms.fields.email') => $record->email,
            __('forms.fields.phone') => $record->phone,
        ];
    }
    public static function getPermissionPrefixes(): array
    {
        return [
            'view_any',
            'view',
            'create',
            'update',
            'delete',
            'delete_any',
        ];
    }
}

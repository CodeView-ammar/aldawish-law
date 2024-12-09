<?php

namespace Tasawk\Filament\Resources\Employees;

use Filament\Forms;
use Filament\Tables;
use Tasawk\Models\User;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Tasawk\Enum\ModelStatus;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Tasawk\Traits\Filament\HasTranslationLabel;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Illuminate\Validation\Rules\Password;
use Tasawk\Rules\KSAPhoneRule;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Ysfkaya\FilamentPhoneInput\Tables\PhoneColumn;
use Ysfkaya\FilamentPhoneInput\Infolists\PhoneEntry;
// use Ysfkaya\FilamentPhoneInput\Infolists\PhoneInputNumberType;
use libphonenumber\PhoneNumberType;
use Ysfkaya\FilamentPhoneInput\PhoneInputNumberType;

class UserResource extends Resource  implements HasShieldPermissions
{
    use HasTranslationLabel;

    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {

        return $form->schema([
            Forms\Components\Section::make("basic_information")
                ->schema([
                    SpatieMediaLibraryFileUpload::make('avatar')
                        ->columnSpan(['xl' => 2])
                        ->rules(["nullable", 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']),

                    TextInput::make('name')
                        ->required(),

                    TextInput::make('email')
                        ->required()
                        ->email()
                        ->autocomplete("off")
                        ->columnSpan(['sm' => 2, 'xl' => 1])
                        ->unique(ignoreRecord: true),

                    PhoneInput::make('phone')
                        ->required()
                        ->live()
                        ->defaultCountry('SA')
                        ->validateFor(
                            type: PhoneNumberType::MOBILE,
                            lenient: true
                        )
                        ->unique(ignoreRecord: true)
                        ->displayNumberFormat(PhoneInputNumberType::E164),

                    TextInput::make('password')
                        // ->password()
                        ->rules([
                            Password::min(8)
                                ->mixedCase()
                                ->letters()
                                ->numbers()
                                ->symbols()
                        ])
                        ->required(fn (string $operation): bool => $operation === 'create')
                        ->confirmed()
                        ->autocomplete("new-password"),
                    TextInput::make('password_confirmation')
                        // ->password()
                        ->required(fn (string $operation): bool => $operation === 'create')
                        ->autocomplete("off"),

                    Select::make("role")
                        ->relationship("roles", "name", fn (Builder $query) => $query->whereNotIn('name', ['customer', 'manager', 'operator', 'panel_user', 'super_admin']))
                        ->required()
                        ->columnSpan(2)
                        ->preload(),

                    Toggle::make('active')->default(1)
                        ->onColor('success')
                        ->offColor('danger')
                ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->whereHas('roles', fn ($q) => $q->whereNotIn('name', ['customer', 'manager', 'operator', 'panel_user', 'super_admin'])))
            ->columns([
                TextColumn::make('id')->searchable(),

                TextColumn::make('name')->searchable(),
                TextColumn::make('email')
                    ->copyable()
                    ->copyMessage('Email address copied')
                    ->copyMessageDuration(1500)
                    ->searchable(),
                TextColumn::make('roles.name')
                    ->default("N/A")
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
                SelectFilter::make('active')
                    ->options(ModelStatus::class)
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => UserResource\Pages\ListUsers::route('/'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::whereHas('roles', fn ($q) => $q->whereNotIn('name', ['customer', 'manager', 'operator', 'panel_user', 'super_admin']))->count();
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

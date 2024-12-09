<?php

namespace Tasawk\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Tasawk\Models\Nationality;
use Tasawk\Enum\ModelStatus;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Concerns\Translatable;
use Tasawk\Traits\Filament\HasTranslationLabel;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Tasawk\Filament\Resources\NationalityResource\Pages;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Tasawk\Filament\Resources\NationalityResource\RelationManagers;


class NationalityResource extends Resource implements HasShieldPermissions
{
    use Translatable;
    use HasTranslationLabel;
    protected static ?string $model = Nationality::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

       protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make("basic_information")
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->columnSpan(['xl' => 2])
                            ->translateLabel(),
                        Toggle::make('status')->default(1)
                            ->onColor('success')
                            ->offColor('danger')
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('name'),
                IconColumn::make('status')
                    ->boolean()
                    ->action(
                        Action::make('Active')
                            ->label(fn (Nationality $record): string => $record->status ? __('panel.messages.deactivate') : __('panel.messages.activate'))
                            // ->disabled(fn(Nationality $record): bool => !auth()->user()->can('update', $record))
                            ->requiresConfirmation()
                            ->action(fn (Nationality $record) => $record->toggleStatus())

                    )
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(ModelStatus::class)
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->before(function (Tables\Actions\DeleteAction $action, Nationality $nationality) {
                        if ($nationality->id == 1) {
                            Notification::make()
                                ->warning()
                                ->title(__('panel.messages.warning'))
                                ->body(__('panel.messages.saudi_nationality_cannot_be_deleted'))
                                ->persistent()
                                ->send();
                            $action->cancel();
                        }
                        if ($nationality->users()->count()) {
                            Notification::make()
                                ->warning()
                                ->title(__('panel.messages.warning'))
                                ->body(__('panel.messages.Nationality_has_many_users', ['Nationality' => $nationality->name]))
                                ->persistent()
                                ->send();
                            $action->cancel();
                        }
                    }),
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
            'index' => Pages\ListNationalities::route('/'),
            'create' => Pages\CreateNationality::route('/create'),
            'edit' => Pages\EditNationality::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationGroup(): ?string
    {
        return __('menu.nationality');
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

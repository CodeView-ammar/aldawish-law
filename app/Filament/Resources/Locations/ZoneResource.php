<?php

namespace Tasawk\Filament\Resources\Locations;

use Filament\Forms;
use Filament\Tables;
use Tasawk\Models\Zone;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Tasawk\Enum\ModelStatus;
use Filament\Resources\Resource;
use Tasawk\Models\Catalog\Option;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Tasawk\Filament\Resources\Locations;
use Filament\Tables\Filters\SelectFilter;
use Filament\Resources\Concerns\Translatable;
use Tasawk\Traits\Filament\HasTranslationLabel;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;

class ZoneResource extends Resource  implements HasShieldPermissions
{
    use Translatable;
    use HasTranslationLabel;

    protected static ?string $model = Zone::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form {
        return $form
            ->schema([
                Forms\Components\Section::make('basic_information')
                    ->schema([
                        TextInput::make('name')->required(),
                        Toggle::make('status')->default(1)
                            ->onColor('success')
                            ->offColor('danger')
                    ])

            ]);
    }

    public static function table(Table $table): Table {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('name'),
                IconColumn::make('status')
                    ->boolean()
                    ->action(
                        Action::make('Active')
                            ->label(fn(Zone $record): string => $record->status ? __('panel.messages.deactivate') : __('panel.messages.activate'))
                            ->disabled(fn(Model $record): bool => !auth()->user()->can('update', $record))
                            ->requiresConfirmation()
                            ->action(fn(Zone $record) => $record->toggleStatus())

                    )

            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(ModelStatus::class)
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array {
        return [
            //
        ];
    }

    public static function getPages(): array {
        return [
            'index' => Locations\ZoneResource\Pages\ListZones::route('/'),
            'create' => Locations\ZoneResource\Pages\CreateZone::route('/create'),
            'edit' => Locations\ZoneResource\Pages\EditZone::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string {
        return __('menu.settings');
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
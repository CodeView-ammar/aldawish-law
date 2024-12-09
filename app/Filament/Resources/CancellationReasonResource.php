<?php

namespace Tasawk\Filament\Resources;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Tasawk\Enum\CancellationReasonFor;
use Tasawk\Enum\ModelStatus;
use Tasawk\Enum\ReasonFor;
use Tasawk\Models\CancellationReason;
use Tasawk\Traits\Filament\HasTranslationLabel;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;

class CancellationReasonResource extends Resource  implements HasShieldPermissions {
    use Translatable, HasTranslationLabel;

    protected static ?string $model = CancellationReason::class;

    protected static ?string $navigationIcon = 'heroicon-o-x-circle';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->columnSpan(['xl' => 2])
                    ->translateLabel(),
                Toggle::make('status')->default(1)
                    ->onColor('success')
                    ->offColor('danger')
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
                            ->label(fn(Model $record): string => $record->status ? __('panel.messages.deactivate') : __('panel.messages.activate'))
                            ->disabled(fn(Model $record): bool => !auth()->user()->can('update', $record))
                            ->requiresConfirmation()
                            ->action(fn(Model $record) => $record->toggleStatus())

                    )
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(ModelStatus::class)
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => \Tasawk\Filament\Resources\CancellationReasonResource\Pages\ListCancellationReasons::route('/'),
            'create' => \Tasawk\Filament\Resources\CancellationReasonResource\Pages\CreateCancellationReason::route('/create'),
            'view' => \Tasawk\Filament\Resources\CancellationReasonResource\Pages\ViewCancellationReason::route('/{record}'),
            'edit' => \Tasawk\Filament\Resources\CancellationReasonResource\Pages\EditCancellationReason::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string {
        return __('menu.content');
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

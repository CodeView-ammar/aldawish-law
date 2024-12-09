<?php

namespace Tasawk\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Tasawk\Enum\ModelStatus;
use Tasawk\Models\CaseParty;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
 
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Concerns\Translatable;
use Tasawk\Traits\Filament\HasTranslationLabel;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Tasawk\Filament\Resources\CasePartyResource\Pages;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Tasawk\Filament\Resources\CasePartyResource\RelationManagers;

class CasePartyResource extends Resource implements HasShieldPermissions
{
    use Translatable;
    use HasTranslationLabel;
    protected static ?string $model = CaseParty::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                            ->label(fn (CaseParty $record): string => $record->status ? __('panel.messages.deactivate') : __('panel.messages.activate'))
                            // ->disabled(fn(CaseType $record): bool => !auth()->user()->can('update', $record))
                            ->requiresConfirmation()
                            ->action(fn (CaseParty $record) => $record->toggleStatus())

                    )
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(ModelStatus::class)
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                ->before(function (Tables\Actions\DeleteAction $action, CaseParty $caseParty) {
                    if ($caseParty->orders()->count()) {
                        Notification::make()
                            ->warning()
                            ->title(__('panel.messages.warning'))
                            ->body(__('panel.messages.caseParty_has_many_order', ['caseParty' => $caseParty->name]))
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
            'index' => Pages\ListCaseParties::route('/'),
            'create' => Pages\CreateCaseParty::route('/create'),
            'edit' => Pages\EditCaseParty::route('/{record}/edit'),
        ];
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationGroup(): ?string
    {
        return __('menu.cases');
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

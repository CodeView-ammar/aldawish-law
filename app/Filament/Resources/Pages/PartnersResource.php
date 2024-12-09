<?php

namespace Tasawk\Filament\Resources\Pages;

use Tasawk\Filament\Resources\Pages\PartnersResource\Pages;
use Tasawk\Filament\Resources\Pages\PartnersResource\RelationManagers;
use Tasawk\Models\Pages\Partner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components;
use Tasawk\Traits\Filament\HasTranslationLabel;
use Filament\Resources\Concerns\Translatable;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\Action;
use Tasawk\Enum\PageStatus;
use Tasawk\Enum\SectionStatus;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Tasawk\Enum\ModelStatus;

class PartnersResource extends Resource implements HasShieldPermissions
{
    use HasTranslationLabel;
    use Translatable;
    protected static ?string $model = Partner::class;
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationIcon = 'heroicon-o-user-plus';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('basic_information')->schema([
                    TextInput::make('title')
                        ->label(__('forms.fields.name'))
                        ->columnSpan([
                            'xl' => 2,
                        ])->required()->translateLabel(),
                    Hidden::make('page_id')
                        ->default(PageStatus::PARTNER),
                    TextInput::make('link')
                    ->label(__('forms.fields.link'))
                        ->url()
                        ->columnSpan([
                            'xl' => 2,
                        ]),
                    SpatieMediaLibraryFileUpload::make('image')
                        ->collection('default')
                        ->required(),
                ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('index')->rowIndex(),
                Tables\Columns\TextColumn::make('title')
                    ->label(__('forms.fields.name')),
                // Tables\Columns\SpatieMediaLibraryImageColumn::make('image'),
                IconColumn::make('status')
                    ->boolean()
                    ->color(fn (Model $record): string => $record->status ? 'success' : 'danger')
                    ->action(
                        Action::make('Active')
                            ->label(fn (Partner $record): string => $record->status == 'active'  ? __('panel.messages.deactivate') : __('panel.messages.activate'))
                            ->requiresConfirmation()
                            ->color(fn (Partner $record): string => $record->status == '1'  ? 'danger' : 'success')
                            ->action(fn (Partner $record) => $record->toggleStatus())

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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPartners::route('/'),
            'create' => Pages\CreatePartners::route('/create'),
            'edit' => Pages\EditPartners::route('/{record}/edit'),
        ];
    }
    public static function getNavigationGroup(): ?string
    {
        return __('menu.content');
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
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

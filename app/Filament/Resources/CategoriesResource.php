<?php

namespace Tasawk\Filament\Resources;

use Tasawk\Filament\Resources\CategoriesResource\Pages;
use Tasawk\Filament\Resources\CategoriesResource\RelationManagers;
use Tasawk\Models\Blogger\Categories;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Concerns\Translatable;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Tasawk\Traits\Filament\HasTranslationLabel;

class CategoriesResource extends Resource implements HasShieldPermissions
{   
    use Translatable;
    use HasTranslationLabel;
    protected static ?string $model = Categories::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(75)
                    ->translateLabel(),
                Forms\Components\TextInput::make('metaTitle')
                    ->nullable()
                    ->maxLength(100)
                    ->translateLabel(),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(100)
                    ->translateLabel(),
                Forms\Components\Textarea::make('content')
                    ->nullable()
                    ->translateLabel(),
                Forms\Components\Select::make('parentId')
                    ->relationship('parent', 'id') // يشير إلى العلاقة الأب
                    ->getOptionLabelFromRecordUsing(function ($record) {
                        $locale = app()->getLocale(); // الحصول على اللغة الحالية
                        return $record->getTranslation('title', $locale); // ترجمة العنوان حسب اللغة
                    })
                    ->nullable()
                    ->translateLabel(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->sortable()->searchable(),
                // Tables\Columns\TextColumn::make('metaTitle')->nullable(),
                Tables\Columns\TextColumn::make('slug')->sortable()->searchable(),
                // Tables\Columns\TextColumn::make('created_at')->label('Created At')->sortable(),
                // Tables\Columns\TextColumn::make('updated_at')->label('Updated At')->sortable(),
            ])
            ->filters([
                //
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
    public static function getNavigationGroup(): ?string {
        return __('menu.bloger');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategories::route('/create'),
            'edit' => Pages\EditCategories::route('/{record}/edit'),
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
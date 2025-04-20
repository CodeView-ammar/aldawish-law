<?php

namespace Tasawk\Filament\Resources\Pages;

use Tasawk\Filament\Resources\Pages\OurServicesResource\Pages;
use Tasawk\Filament\Resources\Pages\OurServicesResource\RelationManagers;
use Tasawk\Models\Pages\OurService;
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
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Tasawk\Enum\ModelStatus;
use Tasawk\Forms\Components\SelectFontAwesomeIcon;

class OurServicesResource extends Resource implements HasShieldPermissions
{
    use HasTranslationLabel;
    use Translatable;

    protected static ?string $model = OurService::class;
    protected static ?int $navigationSort = 3;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('basic_information')->schema([
                    TextInput::make('title')
                        ->label(__('forms.fields.name'))
                        ->required()
                        ->translateLabel(),
                    Forms\Components\RichEditor::make('description')
                        ->label(__('forms.fields.description'))
                        ->required()
                        ->translateLabel(),
                    Hidden::make('page_id')
                        ->default(PageStatus::OURSERVICE),
                    SelectFontAwesomeIcon::make('icon')
                        ->label(__('forms.fields.icon'))
                        ->setMode('all')
                        ->searchable()
                        ->required()
                        ->allowHtml(),
                    TextInput::make('sort')
                        ->label(__('forms.fields.sort'))
                        ->integer()
                        ->required(),
                    SpatieMediaLibraryFileUpload::make('image')
                        ->collection('default') // media collection name
                        ->label(__('forms.fields.image'))
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
                // Tables\Columns\SpatieMediaLibraryImageColumn::make('image')
                //     ->label(__('forms.fields.image')),
                IconColumn::make('status')
                    ->boolean()
                    ->color(fn(Model $record): string => $record->status ? 'success' : 'danger')
                    ->action(
                        Action::make('Active')
                            ->label(fn(OurService $record): string => $record->status == 'active' ? __('panel.messages.deactivate') : __('panel.messages.activate'))
                            ->requiresConfirmation()
                            ->color(fn(OurService $record): string => $record->status == '1' ? 'danger' : 'success')
                            ->action(fn(OurService $record) => $record->toggleStatus())

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
            'index' => Pages\ListOurServices::route('/'),
            'create' => Pages\CreateOurServices::route('/create'),
            'edit' => Pages\EditOurServices::route('/{record}/edit'),
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

<?php

namespace Tasawk\Filament\Resources\Content;

use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Tasawk\Enum\ModelStatus;
use Tasawk\Models\Content\Page;
use Doctrine\DBAL\Schema\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Toggle;
use Tasawk\Filament\Resources\Content;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Resources\Concerns\Translatable;
use Tasawk\Traits\Filament\HasTranslationLabel;
use Tasawk\Filament\Resources\PageResource\Pages;
use Tasawk\Filament\Resources\PageResource\RelationManagers;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;

class PageResource extends Resource implements HasShieldPermissions {
    use Translatable;
    use HasTranslationLabel;

    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard';
    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form {
        return $form
            ->schema([
                Forms\Components\Section::make("basic_information")
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->columnSpan([
                                'xl' => 2,
                            ])
                            ->translateLabel(),
                        RichEditor::make('description')
                            ->required()
                            ->columnSpan([
                                'xl' => 2,
                            ])
                            ->translateLabel(),
                        Toggle::make('status')->default(1)
                            ->onColor('success')
                            ->offColor('danger')

                    ])
            ]);
    }

    public static function table(Table $table): Table {
        return $table
            ->columns([
                TextColumn::make('id')->searchable(),
                TextColumn::make('title')->searchable(),
                IconColumn::make('status')
                    ->boolean()
                    ->action(
                        Action::make('Active')
                            ->label(fn(Page $record): string => $record->status ? __('panel.messages.deactivate') : __('panel.messages.activate'))
                            ->disabled(fn(Model $record): bool => !auth()->user()->can('update', $record))
                            ->requiresConfirmation()
                            ->action(fn(Page $record) => $record->toggleStatus())


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
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array {
        return [
            //
        ];
    }

    public static function getPages(): array {
        return [
            'index' => Content\PageResource\Pages\ListPages::route('/'),
            'create' => Content\PageResource\Pages\CreatePage::route('/create'),
            'edit' => Content\PageResource\Pages\EditPage::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string {
        return __('menu.content');
    }

    public static function getPermissionPrefixes(): array {
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

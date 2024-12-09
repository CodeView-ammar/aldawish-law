<?php

namespace Tasawk\Filament\Resources\Content;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Actions;
use Tasawk\Enum\ModelStatus;
use Filament\Resources\Resource;
use Tasawk\Models\Content\Banner;
use Filament\Forms\Components\Toggle;
use Tasawk\Filament\Resources\Content;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Resources\Concerns\Translatable;
use Tasawk\Traits\Filament\HasTranslationLabel;
use Tasawk\Filament\Resources\BannerResource\Pages;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Tasawk\Filament\Resources\BannerResource\RelationManagers;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;

class BannerResource extends Resource implements HasShieldPermissions
{
    use HasTranslationLabel;
    use Translatable;

    protected static ?string $model = Banner::class;
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationIcon = 'heroicon-o-photo';

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Forms\Components\Section::make("basic_information")
                    ->schema([
                        TextInput::make('title')
                            ->columnSpan([
                                'xl' => 2,
                            ])->required()->translateLabel(),
                        Textarea::make('description')
                            ->columnSpan([
                                'xl' => 2,
                            ])->required()
                            ->translateLabel(),

                        TextInput::make('link')
                            ->url()
                            ->columnSpan([
                                'xl' => 2,
                            ])
                            ->nullable(),
                        SpatieMediaLibraryFileUpload::make('image_ar')
                            ->label(__('forms.fields.image_ar'))
                            ->collection('image_ar')
                            ->columnSpan([
                                'xl' => 2,
                            ])
                            ->required(),
                        SpatieMediaLibraryFileUpload::make('image_en')
                            ->label(__('forms.fields.image_en'))
                            ->collection('image_en')
                            ->columnSpan([
                                'xl' => 2,
                            ])
                            ->required(),
                        SpatieMediaLibraryFileUpload::make('image_fr')
                            ->label(__('forms.fields.image_fr'))
                            ->collection('image_fr')
                            ->columnSpan([
                                'xl' => 2,
                            ])
                            ,
                        SpatieMediaLibraryFileUpload::make('image_zh')
                            ->label(__('forms.fields.image_zh'))
                            ->collection('image_zh')
                            ->columnSpan([
                                'xl' => 2,
                            ])
                           ,
                        SpatieMediaLibraryFileUpload::make('image_de')
                            ->label(__('forms.fields.image_de'))
                            ->collection('image_de')
                            ->columnSpan([
                                'xl' => 2,
                            ])
                            ,

                        Toggle::make('status')->default(1)
                            ->onColor('success')
                            ->offColor('danger')
                            ->translateLabel()
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('title')->translateLabel(),
                // SpatieMediaLibraryImageColumn::make('image_' . app()->getLocale())
                //     ->label(__('forms.fields.image'))
                // ->collection(app()->getLocale()),
                IconColumn::make('status')
                    ->boolean()
                    ->action(
                        \Filament\Tables\Actions\Action::make('Active')
                            ->label(fn(Banner $record): string => $record->status ? __('panel.messages.deactivate') : __('panel.messages.activate'))
                            ->disabled(fn(Model $record): bool => !auth()->user()->can('update', $record))
                            ->requiresConfirmation()
                            ->action(fn(Banner $record) => $record->toggleStatus())
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Content\BannerResource\Pages\ListBanners::route('/'),
            'create' => Content\BannerResource\Pages\CreateBanner::route('/create'),
            'edit' => Content\BannerResource\Pages\EditBanner::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
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

<?php

namespace Tasawk\Filament\Resources\Pages;

use Tasawk\Filament\Resources\Pages\PagesResource\Pages;
use Tasawk\Filament\Resources\Pages\PagesResource\RelationManagers;
use Tasawk\Models\Pages\PageContent;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Tasawk\Enum\PageStatus;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Tasawk\Traits\Filament\HasTranslationLabel;
use Filament\Resources\Concerns\Translatable;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;

class PagesResource extends Resource implements HasShieldPermissions
{
    use HasTranslationLabel;
    use Translatable;
    protected static ?string $model = PageContent::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make("basic_information")
                    ->schema([
                        Select::make('page_id')
                            ->label(__('forms.fields.page_select'))
                            ->options(function ($record) {
                                $all_pages = [
                                    'aboutus' => __('menu.about_us'),
                                    'company-message' => __('menu.company_message'),
                                    'company-goals' => __('menu.company_goals'),
                                    'company-vision' => __('menu.company_vision'),
                                    'our-values' => __('menu.our_values'),
                                    'scientific-experiences' => __('menu.scientific_experiences'),
                                    'relevant-company' => __('menu.relevant-company'),
                                    'team-mission' => __('menu.team_mission'),
                                ];
                                $pages = PageContent::where('page_id', '!=', $record?->page_id)
                                    ->get()->pluck('page_id')
                                    ->map(
                                        fn ($page) => $page->value
                                    )->toArray();

                                $pages = array_diff(array_keys($all_pages), $pages);
                                $avilable_pages = [];
                                foreach ($pages as $page) {
                                    $avilable_pages[$page] =  trans('menu.' . $page);
                                }
                                return $avilable_pages;
                            })
                            // ->relationship('page', 'id', fn ($query, $record) => $query->orWhere('id', $record?->page_id))
                            ->disabled(fn (string $operation): bool => $operation === 'edit')
                            // ->formatStateUsing(fn($record) => __('menu.' . $record->page_id->value))
                            ->columns(1)
                            ->required(),
                        TextInput::make('title')
                            ->label(__('forms.fields.title'))
                            ->required(),
                        Forms\Components\RichEditor::make('description')
                            ->label(__('forms.fields.description'))
                            ->required(),
                        SpatieMediaLibraryFileUpload::make('image')
                            ->label(__('forms.fields.image'))
                            ->required(),


                    ])->columns(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn ($query) => $query->whereNotIn('page_id', ['terms-condition', 'privacy-policy', 'contact-us', 'faq', 'career', 'partner',"topbar", 'ourservice']))
            ->columns([
                Tables\Columns\TextColumn::make('page_id')
                    ->default(function ($value) {
                        return __('menu.' . $value);
                    })
                    ->label(__('forms.fields.page')),
                // Tables\Columns\SpatieMediaLibraryImageColumn::make('image'),
                Tables\Columns\TextColumn::make('title')
                    ->label(__('forms.fields.address')),

            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePages::route('/create'),
            // 'view' => Pages\ViewPages::route('/{record}'),
            'edit' => Pages\EditPages::route('/{record}/edit'),

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

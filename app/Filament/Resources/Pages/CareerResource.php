<?php

namespace Tasawk\Filament\Resources\Pages;

use Tasawk\Filament\Resources\Pages\CareerResource\Pages;
use Tasawk\Filament\Resources\Pages\CareerResource\RelationManagers;
use Tasawk\Models\Career;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Tasawk\Traits\Filament\HasTranslationLabel;
use Filament\Resources\Concerns\Translatable;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;


class CareerResource extends Resource implements HasShieldPermissions
{
    use HasTranslationLabel;
    use Translatable;
    protected static ?string $model = Career::class;
    protected static ?int $navigationSort = 4;

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('forms.fields.name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label(__('forms.fields.phone')),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('forms.fields.email')),
                Tables\Columns\TextColumn::make('job_title')
                    ->label(__('forms.fields.job_title')),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    static public function infolist(Infolist $infolist): Infolist {
        return $infolist
            ->schema([
                Grid::make()->schema([
                    Section::make("basic_information")
                        ->schema([
                            TextEntry::make('id'),
                            TextEntry::make('name'),
                            TextEntry::make('email'),
                            TextEntry::make('phone'),
                            TextEntry::make('address'),
                            TextEntry::make('gender_text')->label(__('forms.fields.gender')),
                            TextEntry::make('age'),
                            TextEntry::make('job_title'),
                            TextEntry::make('position'),
                            TextEntry::make('cv')
                                ->url(fn (Career $record) => $record->cv , true)
                                ->color('primary')
                                ->label(__('site.cv')),
                        ])->columns(3),

                ])->columns(2)
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
            'index' => Pages\ListCareers::route('/'),
            'create' => Pages\CreateCareer::route('/create'),
            'view' => Pages\ViewCareer::route('/{record}'),
            'edit' => Pages\EditCareer::route('/{record}/edit'),
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
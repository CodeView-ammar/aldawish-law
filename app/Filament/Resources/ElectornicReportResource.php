<?php

namespace Tasawk\Filament\Resources;

use Tasawk\Filament\Resources\ElectornicReportResource\Pages;
use Tasawk\Filament\Resources\ElectornicReportResource\RelationManagers;
use Tasawk\Models\ElectornicReport;
use Tasawk\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Tasawk\Traits\Filament\HasTranslationLabel;
use Filament\Resources\Concerns\Translatable;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Illuminate\Database\Eloquent\Model;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;

class ElectornicReportResource extends Resource implements HasShieldPermissions
{
    use HasTranslationLabel;
    use Translatable;
    protected static ?string $model = ElectornicReport::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                TextColumn::make('index')->rowIndex(),
                TextColumn::make('order_number')
                    ->label(__('forms.fields.order_number')),
                TextColumn::make('date')
                    ->date()
                    ->label(__('forms.fields.date')),
                TextColumn::make('client_name')
                    ->label(__('forms.fields.customer_name')),
                TextColumn::make('phone_number')
                    ->label(__('forms.fields.phone')),
                TextColumn::make('ristrict_name')
                    ->label(__('forms.fields.ristrict')),
                TextColumn::make('total')
                    // ->money('SAR')
                    ->label(__('forms.fields.total')),

            ])
            ->filters([
                Filter::make('date')
                    ->form([
                        DatePicker::make('created_from')
                            ->label(__('forms.fields.created_from')),
                        DatePicker::make('created_until')
                            ->label(__('forms.fields.created_until')),
                    ])->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('date', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('date', '<=', $date),
                            );
                    })
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    static public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                \Filament\Infolists\Components\Grid::make()->schema([
                    \Filament\Infolists\Components\Section::make("basic_information")
                        ->schema([
                            TextEntry::make('order_number'),
                            TextEntry::make('client_name'),
                            TextEntry::make('email'),
                            TextEntry::make('phone_number')
                                ->label(__('forms.fields.phone')),
                            // TextEntry::make('id_number'),
                            TextEntry::make('address'),
                            TextEntry::make('caseType.name')
                                ->label(__('forms.fields.case_type'))
                                ->visible(fn($record) => $record->ristrict == 'cases'),
                            TextEntry::make('case_status_name')
                                ->label(__('forms.fields.case_status'))
                                ->visible(fn($record) => $record->ristrict == 'cases'),
                            TextEntry::make('court')
                                ->label(__('forms.fields.court'))
                                ->visible(fn($record) => $record->ristrict == 'cases'),
                            TextEntry::make('caseParty.name')
                                ->label(__('forms.fields.party_in_the_case')),
                            TextEntry::make('case_summary')
                                ->label(__('forms.fields.case_summary')),
                            TextEntry::make('date_text')
                                ->label(__('forms.fields.date')),
                            TextEntry::make('total'),
                            TextEntry::make('duration_text')
                                ->label(__('forms.fields.duration')),
                                
                            TextEntry::make('status'),
                            TextEntry::make(('payment_status')),
                            TextEntry::make('payment_type')
                                ->visible(fn($record) => $record->payment_type != null)
                                ->label(__('forms.fields.payment_type')),
                            TextEntry::make('payment_data.invoiceURL')
                                ->visible(fn($record) => $record->payment_data != null)
                                ->url(fn(Order $record) => $record->payment_data['invoiceURL'] ?? '')
                                ->openUrlInNewTab()
                                ->color('primary')
                                ->label(__('forms.fields.invoiceURL')),


                        ])->columns(3),
                ])->columns(2),
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
            'index' => Pages\ListElectornicReports::route('/'),
            'create' => Pages\CreateElectornicReport::route('/create'),
            'edit' => Pages\EditElectornicReport::route('/{record}/edit'),
            'view' => Pages\ViewElectornicReport::route('/{record}'),
        ];
    }

    public static function getPermissionPrefixes(): array
    {
        return [
            'view_any',
            'view',
        ];
    }
    public static function getNavigationGroup(): ?string
    {
        return __('menu.settings');
    }
}

<?php

namespace Tasawk\Filament\Widgets;

use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Model;
use Tasawk\Models\Career;

class Careers extends BaseWidget {
    use HasWidgetShield;

    protected static ?int $sort = 11;

    public function table(Table $table): Table {
        return $table
            ->heading(__('sections.latest_careers'))
            ->query(
                Career::orderBy('created_at', 'desc')->limit(10)
            )
            ->
            columns([
                TextColumn::make('id')->rowIndex()->toggleable(false),
                TextColumn::make('name')
                    ->toggleable(false),
                TextColumn::make('email')
                    ->copyable()
                    ->copyMessage('Email address copied')
                    ->copyMessageDuration(1500)
                    ->toggleable(false),
                TextColumn::make('phone')
                    ->toggleable(false)
                    ->copyable()
                    ->copyMessage('Phone address copied')
                    ->copyMessageDuration(1500),
                TextColumn::make('job_title')
                    ->toggleable(false),


            ])->actions([
               

            ]);
    }

    public function getTableHeading(): ?string {
        return __('sections.latest_careers');
    }
}

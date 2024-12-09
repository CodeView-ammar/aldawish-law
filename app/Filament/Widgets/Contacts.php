<?php

namespace Tasawk\Filament\Widgets;

use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Model;
use Tasawk\Models\Content\Contact;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Ysfkaya\FilamentPhoneInput\Tables\PhoneColumn;
use Ysfkaya\FilamentPhoneInput\Infolists\PhoneEntry;
use Ysfkaya\FilamentPhoneInput\Infolists\PhoneInputNumberType;

class Contacts extends BaseWidget
{
    use HasWidgetShield;

    protected static ?int $sort = 11;

    public function table(Table $table): Table
    {
        return $table
            ->heading(__('sections.latest_contacts'))
            ->query(
                Contact::where('seen', 0)->orderBy('created_at', 'desc')->limit(10)
            )
            ->
            columns([
                TextColumn::make('id')->rowIndex()->toggleable(false),
                TextColumn::make('name')
                    ->formatStateUsing(fn(Model $record): string => $record->user->name ?? $record->name)
                    ->toggleable(false),
                TextColumn::make('email')
                    ->formatStateUsing(fn(Model $record): string => $record->user->email ?? $record->email)
                    ->copyable()
                    ->copyMessage('Email address copied')
                    ->copyMessageDuration(1500)
                    ->toggleable(false),

                TextColumn::make('phone')
                    ->formatStateUsing(fn(Model $record): string => $record->user->phone ?? $record->phone)
                    ->toggleable(false)
                    ->copyable()
                    ->copyMessage('Phone address copied')
                    ->copyMessageDuration(1500),


            ])->actions([
                    Action::make('seen')
                        ->visible(fn(Model $record) => !$record->seen)
                        ->label(__('forms.fields.mark_as_seen'))
                        ->action(fn(Model $record) => $record->update(['seen' => 1])),

                    Tables\Actions\ViewAction::make()
                        ->modalHeading(__("menu.contact"))
                        ->form([

                            Textarea::make('message')
                                ->rows(10),


                            // Select::make("user_id")
                            //     ->relationship("user", 'name'),

                            TextInput::make('name')
                                ->formatStateUsing(fn(Model $record): string => $record->user->name ?? $record->name)

                                ->required(),

                            TextInput::make('email')
                                ->formatStateUsing(fn(Model $record): string => $record->user->email ?? $record->email)
                                ->required()
                                ->email()
                                ->autocomplete("off")
                                ->unique(ignoreRecord: true),

                            PhoneInput::make('phone_number')
                                ->formatStateUsing(fn(Model $record): string => $record->user->phone ?? $record->phone)
                                ->required()
                                ->unique(ignoreRecord: true)
                            ,
                            TextInput::make('contactType.name')
                                ->formatStateUsing(fn(Model $record): string => $record?->contactType?->name == null ? " " : $record?->contactType?->name)
                                ->label(__("forms.fields.contact_type")),
                            Toggle::make('seen')->default(1)
                                ->onColor('success')
                                ->offColor('danger')
                        ])
                ]);
    }

    public function getTableHeading(): ?string
    {
        return __('sections.latest_contacts');
    }
}

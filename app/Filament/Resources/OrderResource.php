<?php

namespace Tasawk\Filament\Resources;

use Com\Tecnick\Pdf\Text;
use Tasawk\Filament\Resources\OrderResource\Pages;
use Tasawk\Filament\Resources\OrderResource\RelationManagers;
use Tasawk\Models\Order;
use Tasawk\Models\CaseType;
use Tasawk\Models\CaseParty;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Tasawk\Settings\GeneralSettings;
use Tasawk\Traits\Filament\HasTranslationLabel;
use Filament\Infolists\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Concerns\Translatable;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Illuminate\Support\Facades\Notification;
use Filament\Notifications\Notification as FilamentNotification;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\ActionGroup;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Carbon\Carbon;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\TextEntry;
use Tasawk\Enum\OrderStatus;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Tasawk\Notifications\Customer\ChangeOrderStatusNotification;
use Tasawk\Models\User;
use Closure;
use Filament\Forms\Set;
use Filament\Forms\Get;
use Illuminate\Validation\ValidationException;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;

class OrderResource extends Resource implements HasShieldPermissions
{
    use Translatable;
    use HasTranslationLabel;
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('ristrict')
                    ->options([
                        'arbitration' => __('forms.fields.arbitration'),
                        'cases' => __('forms.fields.cases'),
                    ])
                    ->live()
                    ->required()
                    ->columnSpan(['xl' => 1])
                    ->translateLabel(),
                TextInput::make('order_number')
                    ->columnSpan(['xl' => 1])
                    ->translateLabel(),
                TextInput::make('client_name')
                    ->label(__('forms.fields.name'))
                    ->columnSpan(['xl' => 1])
                    ->translateLabel(),
                TextInput::make('email')
                    ->columnSpan(['xl' => 1])
                    ->translateLabel(),
                TextInput::make('phone_number')
                    ->label(__('forms.fields.phone'))
                    ->columnSpan(['xl' => 1])
                    ->translateLabel(),
                TextInput::make('id_number')
                    ->label(__('forms.fields.id_number'))
                    ->columnSpan(['xl' => 1])
                    ->translateLabel(),
                TextInput::make('address')
                    ->columnSpan(['xl' => 1])
                    ->translateLabel(),
                Select::make('case_type')
                    ->options(CaseType::where('status', '1')->pluck('name', 'id'))
                    ->visible(fn($get) => $get('ristrict') === 'arbitration')
                    ->required()
                    ->columnSpan(['xl' => 1])
                    ->translateLabel(),
                Select::make('case_status')
                    ->options([
                        'new' => __('forms.fields.new'),
                        'existing' => __('forms.fields.existing'),
                    ])
                    ->visible(fn($get) => $get('ristrict') === 'arbitration')
                    ->required()
                    ->columnSpan(['xl' => 1])
                    ->translateLabel(),
                TextInput::make('court')
                    ->columnSpan(['xl' => 1])
                    ->visible(fn($get) => $get('ristrict') === 'arbitration')
                    ->translateLabel(),
                Select::make('party_in_the_case')
                    ->options(CaseParty::where('status', '1')->pluck('name', 'id'))
                    ->required()
                    ->columnSpan(['xl' => 1])
                    ->translateLabel(),
                TextInput::make('case_summary')
                    ->columnSpan(['xl' => 1])
                    ->required()
                    ->translateLabel(),
                DateTimePicker::make('date')
                    ->columnSpan(['xl' => 1])
                    ->required()
                    ->seconds(false)
                    ->translateLabel(),
                TextInput::make('total')
                    ->default(0)
                    ->columnSpan(['xl' => 1])
                    ->translateLabel(),
                Select::make('duration')
                    ->options([
                        '15' => __('forms.fields.15m'),
                        '30' => __('forms.fields.30m'),
                        '45' => __('forms.fields.45m'),
                        '60' => __('forms.fields.60m'),
                    ])
                    ->label(__('forms.fields.duration'))
                    ->columnSpan(['xl' => 2])
                    ->required()
                    ->translateLabel(),
                SpatieMediaLibraryFileUpload::make('file')
                    ->label(__('forms.fields.case_documents'))
                    ->collection('consultation')
                    ->columnSpan(['xl' => 2])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')->rowIndex(),
                TextColumn::make('order_number')
                    ->copyable(),
                TextColumn::make('client_name')->label(__('forms.fields.name')),
                TextColumn::make('email')->label(__('forms.fields.email')),
                TextColumn::make('ristrict_name')->label(__('forms.fields.ristrict')),
                TextColumn::make('payment_type_text')
                    ->label(__('forms.fields.payment_type')),
                TextColumn::make('payment_status'),
                TextColumn::make('date_text')
                    ->label(__('forms.fields.date')),
                TextColumn::make('price_text')
                    ->label(__('forms.fields.total')),
                TextColumn::make('status')
                    ->color(fn($state) => $state->getColor())
                    ->label(__('forms.fields.status')),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(OrderStatus::class),
                Filter::make('ristrict')
                    ->label(__('forms.fields.ristrict'))
                    ->form([
                        Select::make('ristrict')
                            ->options([
                                "arbitration" => __('site.arbitration'),
                                "cases" => __('site.cases')
                            ]),
                    ])->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['ristrict'] == 'arbitration',
                                fn(Builder $query, $date): Builder => $query->where('ristrict', 'arbitration'),
                            )
                            ->when(
                                $data['ristrict'] == 'cases',
                                fn(Builder $query, $date): Builder => $query->where('ristrict', 'cases'),
                            );
                    }),
                Filter::make('ID')
                    ->label(__('forms.fields.order_number'))
                    ->form([
                        TextInput::make('id'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when($data['id'], fn(Builder $query, $date): Builder => $query->where('id', ($data['id'])));
                    })
                    ->indicateUsing(function (array $data): ?string {
                        if (!$data['id']) {
                            return null;
                        }

                        return __('forms.fields.id') . " " . $data['id'];
                    }),

            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\Action::make('status')
                        ->label(__('panel.messages.change_status'))
                        ->color('primary')
                        ->icon('heroicon-o-shield-check')
                        ->form([
                            Select::make('status')
                                ->options([
                                    'new' => __('forms.fields.new'),
                                    'pending' => __('forms.fields.pending'),
                                    'rejected' => __('forms.fields.rejected'),
                                    'completed' => __('forms.fields.completed'),
                                ])
                                ->formatStateUsing(fn($record) => ($record?->status))
                                ->required(),
                        ])
                        ->modalSubmitActionLabel(__('panel.messages.change_status'))
                        ->action(function (Model $record, array $data) {
                            $record->update([
                                'status' => $data['status'],
                            ]);

                            Notification::send($record->customer, new ChangeOrderStatusNotification($record->status->value, $record));
                            Notification::send(User::whereHas("roles", fn($q) => $q->where('name', 'super_admin'))->first(), new ChangeOrderStatusNotification($record->status->value, $record));
                            FilamentNotification::make()
                                ->success()
                                ->title(__('panel.messages.success'))
                                ->body(__('panel.messages.change_status'))
                                ->persistent()
                                ->send();
                        }),
                    Tables\Actions\Action::make('accept_request')
                        ->label(__('panel.messages.accept_request'))
                        ->hidden(fn($record) => ($record->date != null && Carbon::parse($record->date)->addMinutes($record->duration) < Carbon::now()))
                        ->color('success')
                        ->icon('heroicon-o-check-circle')
                        ->form([
                            DateTimePicker::make('date')
                                ->required()
                                ->seconds(false)
                                ->default(now())
                                ->rules([
                                    fn(): Closure => function (string $attribute, $value, Closure $fail) {
                                        $setting = new GeneralSettings();
                                        $working_days = $setting->working_days;
                                        $selectedDate = Carbon::parse($value);
                                        $selectedDay = strtolower($selectedDate->format('l'));
                                        $selectedTime = $selectedDate->format('H:i');
                                        $isWorkingDay = false;
                                        $valid = '';
                                        foreach ($working_days as $days) {
                                            foreach ($days as $day) {
                                                if ($day['day_name'] === $selectedDay && $day['status']) {
                                                    $valid = __('panel.messages.invalid_working_day:from:to', [
                                                        'from' => Carbon::createFromFormat('H:i', $day['from'])->format('g:i A'),
                                                        'to' => Carbon::createFromFormat('H:i', $day['to'])->format('g:i A')
                                                    ]);
                                                    if ($selectedTime >= $day['from'] && $selectedTime <= $day['to']) {
                                                        $isWorkingDay = true;
                                                        break;
                                                    }
                                                }
                                            }
                                        }
                                        if (!$isWorkingDay) {
                                            $valid == '' ? $valid = __('panel.messages.invalid_working_day') : __('panel.messages.invalid_working_day:from:to', [
                                                'from' => Carbon::createFromFormat('H:i', $day['from'])->format('g:i A'),
                                                'to' => Carbon::createFromFormat('H:i', $day['to'])->format('g:i A')
                                            ]);
                                            $fail($valid);
                                        }
                                    },
                                ])
                                ->helperText(function ($state) {
                                    $selectedDay = strtolower(Carbon::parse($state)->format('l'));

                                    $period = collect((new GeneralSettings())->working_days[0])->values()->where('status', true)->where('day_name', $selectedDay)->first();

                                    return
                                        $period ?
                                        __('panel.messages.invalid_working_day:from:to', [
                                            'from' => Carbon::createFromFormat('H:i', $period['from'])->translatedFormat('g:i A'),
                                            'to' => Carbon::createFromFormat('H:i', $period['to'])->translatedFormat('g:i A')
                                        ]) : __("panel.messages.no_available_time");
                                })
                                ->afterStateUpdated(function (Set $set, $record, Get $get, ?string $state) {
                                })
                                ->live()
                                ->formatStateUsing(fn($record) => $record?->date)
                                ->translateLabel(),

                            TextInput::make('total')
                                ->default(0)
                                ->disabled(fn($record) => ($record->payment_status->value == 'paid'))
                                ->formatStateUsing(fn($record) => ($record?->total))
                                ->integer()
                                ->required()
                                ->translateLabel(),
                            Select::make('duration')
                                ->options([
                                    '15' => __('menu.15m'),
                                    '30' => __('menu.30m'),
                                    '45' => __('menu.45m'),
                                    '60' => __('menu.60m'),
                                ])
                                ->formatStateUsing(fn($record) => ($record?->duration))
                                ->label(__('forms.fields.duration'))
                                ->required()
                                ->translateLabel(),
                        ])
                        ->modalSubmitActionLabel(__('panel.messages.accept_request'))
                        ->action(function (Model $record, array $data) {
                            $record->update([
                                'date' => $data['date'],
                                'total' => $data['total'],
                                'duration' => $data['duration'],
                            ]);

                            FilamentNotification::make()
                                ->success()
                                ->title(__('panel.messages.success'))
                                ->body(__('panel.messages.accept_request'))
                                ->persistent()
                                ->send();
                        }),

                    Tables\Actions\Action::make('cancel-order')
                        ->label(__('forms.fields.cancel_order'))
                        ->color('danger')
                        ->icon('heroicon-o-x-circle')
                        ->form([
                            TextInput::make('notes')
                                ->label(__("forms.fields.reason"))
                                ->required(),
                        ])
                        ->hidden(fn(Order $record) => ($record->status->value == OrderStatus::COMPLETED->value || !$record?->cancellation))
                        ->action(
                            function (Order $order, array $data) {
                                $order->cancellation()->create([
                                    "order_id" => $order->id,
                                    "cancellation_reason_id" => 0,
                                    "notes" => $data['notes'] ?? null,
                                    'user_id' => auth()->id(),
                                ]);
                                if ($order->payment_status == 'paid') {
                                    auth()->user()->deposit($order?->total?->formatByDecimal());
                                }
                                $order->update(['status' => OrderStatus::REJECTED->value]);
                                Notification::send($order->customer, new ChangeOrderStatusNotification($order->status->value, $order));
                                Notification::send(User::whereHas("roles", fn($q) => $q->where('name', 'super_admin'))->first(), new ChangeOrderStatusNotification($order->status->value, $order));
                            }
                        ),
                    Tables\Actions\Action::make('confirm-bank_transfer')
                        ->label(__('forms.fields.confirm-bank_transfer'))
                        ->color('success')
                        ->icon('heroicon-o-check')
                        ->visible(fn(Order $record) => ($record->payment_type == "bank_transfer_receipt" && $record->payment_status->value != 'paid'))
                        ->action(function (Model $record, array $data) {
                            $record->update([
                                'payment_status' => 'paid',
                            ]);
                            // dd($record);
                            FilamentNotification::make()
                                ->success()
                                ->title(__('panel.messages.success'))
                                ->body(__('panel.messages.confirm-bank_transfer'))
                                ->persistent()
                                ->send();
                        }),
                    Tables\Actions\Action::make('the_advisor_replied')
                        ->label(__('panel.messages.the_advisor_replied'))
                        ->color('warning')
                        ->icon('heroicon-o-chat-bubble-oval-left')
                        ->form([
                            Textarea::make('comment')
                                ->required()
                                ->translateLabel(),
                            SpatieMediaLibraryFileUpload::make('attachment')
                                ->label(__('forms.fields.case_documents'))
                                ->collection('attachment')
                                ->columnSpan(['xl' => 2])
                                ->required(),
                        ])
                        ->visible(fn($record) => $record->status->value == 'completed')
                        ->modalSubmitActionLabel(__('panel.messages.the_advisor_replied'))
                        ->action(function (Model $record, array $data) {
                            $record->update([
                                'comment' => $data['comment'],
                            ]);
                            FilamentNotification::make()
                                ->success()
                                ->title(__('panel.messages.success'))
                                ->body(__('panel.messages.the_advisor_replied'))
                                ->persistent()
                                ->send();
                        }),
                    Tables\Actions\ViewAction::make(),
                    // Tables\Actions\EditAction::make(),
                ])->label(__('panel.actions.actions'))
                    ->color('primary')
                    ->button(),
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
                Grid::make()->schema([
                    Section::make("basic_information")
                        ->schema([
                            TextEntry::make('order_number'),
                            TextEntry::make('client_name'),
                            TextEntry::make('email'),
                            TextEntry::make('phone_number')
                                ->label(__('forms.fields.phone')),
                            TextEntry::make('id_number'),
                            TextEntry::make('address'),
                            TextEntry::make('caseType.name')
                                ->label(__('forms.fields.case_type'))
                                ->visible(fn($record) => $record->ristrict == 'cases'),
                            TextEntry::make('case_status_name')
                                ->label(__('forms.fields.case_status'))
                                ->visible(fn($record) => $record->ristrict == 'cases'),
                            TextEntry::make('case_number')
                                ->label(__('site.case_number'))
                                ->visible(fn($record) => $record?->case_status == 'existing'),
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

//                            TextEntry::make('payment_type_text')
//                                ->visible(fn($record) => $record->payment_type != null)
//                                ->label(__('forms.fields.payment_type')),
//                                TextEntry::make(('account_number'))
//                                ->label(__('site.account_number'))
//                                ->visible(fn($record) => $record->payment_type == 'bank_transfer_receipt'),
//
//                                TextEntry::make(('iban_number'))
//                                ->label(__('site.iban_number'))
//                                ->visible(fn($record) => $record->payment_type == 'bank_transfer_receipt'),

                            SpatieMediaLibraryImageEntry::make('bank_transfer_receipt')
                                ->label(__('forms.fields.bank_transfer_receipt_im'))
                                ->visible(fn($record) => $record->payment_type == 'bank_transfer_receipt')
                                ->collection('bank_transfer_receipt')
                                ->columnSpan(1),

                            TextEntry::make('payment_data.invoiceURL')
                                ->visible(fn($record) => $record->payment_data != null)
                                ->url(fn(Order $record) => $record->payment_data['invoiceURL'] ?? '')
                                ->openUrlInNewTab()
                                ->columnSpan(2)
                                ->color('primary')
                                ->label(__('forms.fields.invoiceURL')),
                            Section::make("cancellation_reason")
                                ->schema([
                                    TextEntry::make('cancellation.notes')
                                        ->visible(fn(Order $record) => ($record?->cancellation?->cancellation_reason_id == 0))
                                        ->label(__('forms.fields.reason'))
                                        ->columnSpan(1),
                                    TextEntry::make('cancellation.reason.name')
                                        ->visible(fn(Order $record) => ($record?->cancellation?->cancellation_reason_id == 1))
                                        ->label(__('forms.fields.reason'))
                                        ->columnSpan(1),
                                    TextEntry::make('cancellation.created_at')
                                        ->date('Y-m-d')
                                        ->label(__('forms.fields.date'))
                                        ->columnSpan(2),
                                    TextEntry::make('cancellation.user.name')
                                        ->label(__('forms.fields.canceld_by'))
                                        ->columnSpan(2),
                                ])
                                ->visible(fn(Order $record) => isset ($record->cancellation) && $record->cancellation)
                                ->columns(3),
                            TextEntry::make('comment')
                                ->visible(fn($record) => $record->comment != null)
                                ->label(__('forms.fields.the_advisor_replied')),
                            TextEntry::make('attachment')
                                ->visible(fn($record) => $record->comment != null)
                                ->url(fn(Order $record) => $record->attachment)
                                ->openUrlInNewTab()
                                ->columnSpan(2)
                                ->color('primary')
                                ->label(__('forms.fields.attachment')),
                            TextEntry::make('file')
                                ->listWithLineBreaks()
                                ->bulleted()
                                ->color('primary')
                                ->label(__('forms.fields.case_documents'))
                                ->getStateUsing(fn(Model $record) => $record->getMedia('consultation')->map(fn($media) => <<<Blade
    <a target="_blank" href="{$media->getUrl()}">$media->name</a>
    Blade))
                                ->html(),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationGroup(): ?string
    {
        return __('menu.cases');
    }

    public static function getPermissionPrefixes(): array
    {
        return [
            'view_any',
            'view',
            'create',
            // 'update',
            // 'export',
            // 'delete',
            // 'delete_any',
        ];
    }
}

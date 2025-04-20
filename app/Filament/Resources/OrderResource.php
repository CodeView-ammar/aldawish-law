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
use Tasawk\Actions\SendTextMessageAction;

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
                        'general_consultation' => __('forms.fields.general_consultation'),
                        'arbitration' => __('forms.fields.arbitration'),
                        'cases' => __('forms.fields.cases'),
                    ])
                    ->live()
                    ->required()
                    ->columnSpan(['xl' => 1])
                    ->translateLabel(),
    
                // الحقول الأساسية
                TextInput::make('client_name')
                    ->label(__('forms.fields.name'))
                    ->columnSpan(['xl' => 1])
                    ->translateLabel(),
    
                // TextInput::make('id_number')
                //     ->label(__('forms.fields.id_number'))
                //     ->columnSpan(['xl' => 1])
                //     ->translateLabel(),
    
                TextInput::make('phone_number')
                    ->label(__('forms.fields.phone'))
                    ->columnSpan(['xl' => 1])
                    ->translateLabel(),
    
                TextInput::make('email')
                    ->columnSpan(['xl' => 1])
                    ->translateLabel(),
    
                TextInput::make('address')
                    ->columnSpan(['xl' => 1])
                    ->translateLabel(),
    
                // الحقول الخاصة بالاستشارة العامة
                TextInput::make('consultation_subject')
                    ->label(__('forms.fields.consultation_subject'))
                    ->visible(fn($get) => $get('ristrict') === 'general_consultation')
                    ->columnSpan(['xl' => 1])
                    ->translateLabel(),
    
                TextInput::make('case_summary')
                    ->label(__('forms.fields.case_summary'))
                    ->visible(fn($get) => $get('ristrict') === 'general_consultation')
                    ->columnSpan(['xl' => 1])
                    ->translateLabel(),
    
                SpatieMediaLibraryFileUpload::make('file')
                    ->label(__('forms.fields.case_documents'))
                    ->collection('consultation')
                    ->columnSpan(['xl' => 2])
                    ->required()
                    ->visible(fn($get) => $get('ristrict') === 'general_consultation'),
    
                // الحقول الخاصة بالقضايا
                Select::make('case_type')
                    ->options(CaseType::where('status', '1')->pluck('name', 'id'))
                    ->visible(fn($get) => $get('ristrict') === 'cases')
                    ->required()
                    ->columnSpan(['xl' => 1])
                    ->translateLabel(),
    
                Select::make('case_status')
                    ->options([
                        'new' => __('forms.fields.new'),
                        'existing' => __('forms.fields.existing'),
                    ])
                    ->visible(fn($get) => $get('ristrict') === 'cases')
                    ->required()
                    ->columnSpan(['xl' => 1])
                    ->translateLabel(),
    
                Select::make('party_in_the_case')
                    ->options(CaseParty::where('status', '1')->pluck('name', 'id'))
                    ->visible(fn($get) => $get('ristrict') === 'cases' || $get('ristrict') === 'arbitration')
                    ->columnSpan(['xl' => 1])
                    ->translateLabel(),
    
                TextInput::make('case_summary')
                    ->columnSpan(['xl' => 1])
                    ->required(fn($get) => $get('ristrict') === 'cases' || $get('ristrict') === 'arbitration') // اجعل الحقل إجباريًا
                    ->translateLabel(),
    
                // الحقول الخاصة بالتحكيم
                SpatieMediaLibraryFileUpload::make('file')
                    ->label(__('forms.fields.case_documents'))
                    ->collection('consultation')
                    ->columnSpan(['xl' => 2])
                    // ->required()
                    ->visible(fn($get) => $get('ristrict') === 'arbitration'),
            ]);
    }
    
    public static function table(Table $table): Table
    {
        $user = auth()->user(); 
        return $table
        ->modifyQueryUsing(function (Builder $query) {
            if (!auth()->user()->hasRole('admin') && !auth()->user()->hasRole('super_admin')) {
                $query->where('responsible_user_id', auth()->id());
            }
        })
            ->columns([
                TextColumn::make('index')->rowIndex(),
                TextColumn::make('order_number')
                    ->copyable(),
                TextColumn::make('client_name')->label(__('forms.fields.name')),
                TextColumn::make('email')->label(__('forms.fields.email')),
                TextColumn::make('ristrict_name')->label(__('forms.fields.ristrict')),
                TextColumn::make('payment_type_text')
                    ->label(__('forms.fields.payment_type')),
                TextColumn::make('responsibleUser.name') // استخدام العلاقة هنا
                    ->label(__('forms.fields.responsible_user')),
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
                                "general_consultation" => __('site.general_consultation'),
                                "arbitration" => __('site.arbitration'),
                                "cases" => __('site.cases'),
                                
                            ]),
                    ])->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['ristrict'] == 'general_consultation',
                                fn(Builder $query, $date): Builder => $query->where('ristrict', 'general_consultation'),
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
                                'status' => 'pending',
                            ]);
                            $previousStatus = $record->status->value;
                            // إرسال رسالة نصية إلى رقم محدد
                            
                            $phone = $record->customer->phone;
                            $cleaned_phone = str_replace(["+9660", "+966"], "", $phone);
                            if ($previousStatus === 'pending')
                            {
                                $messageForAdmin =  "  السيد/ة:" . $record->customer->name."تم قبول الطلب رقم :".$record->customer->id." يجب عليكم العودة للطلب وإكمال عملية الدفع لإتمام الطلب \n";
                                SendTextMessageAction::run($messageForAdmin, "+966".$cleaned_phone); // إرسال رسالة للإدارة
                            }
                            if($previousStatus === 'completed') {
                                $messageForAdmin =  "  السيد/ة:" . $record->customer->name."\n تم الإنتهاء من الطلب الطلب مكتمل ";
                                SendTextMessageAction::run($messageForAdmin, "+966".$cleaned_phone); // إرسال رسالة للإدارة
                            }
                            Notification::send($record->customer, new ChangeOrderStatusNotification($record->status->value, $record));
                            Notification::send(User::whereHas("roles", fn($q) => $q->where('name', 'super_admin'))->first(), new ChangeOrderStatusNotification($record->status->value, $record));
                             FilamentNotification::make()
                                ->success()
                                ->title(__('panel.messages.success'))
                                ->body(__('panel.messages.change_status'))
                                ->persistent()
                                ->send();
                            }),
                            
                            Tables\Actions\Action::make('editdate_request')
                            ->label(__('panel.messages.editdate_request'))
                            // إظهار الإجراء فقط إذا كان التاريخ غير فارغ
                            ->hidden(fn($record) => $record->date == null)
                            ->color('success')
                            
                            ->icon('heroicon-o-check-circle')
                            ->form([
                                DateTimePicker::make('date')
                                    ->required()
                                    ->seconds(false)
                                    ->default(now()) // اجعل القيمة الافتراضية الآن في حالة عدم وجود تاريخ
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
                                            if (!$isWorkingDay) {
                                                $valid == '' ? $valid = __('panel.messages.invalid_working_day') : __('panel.messages.invalid_working_day:from:to', [
                                                    'from' => Carbon::createFromFormat('H:i', $day['from'])->format('g:i A'),
                                                    'to' => Carbon::createFromFormat('H:i', $day['to'])->format('g:i A')
                                                ]);
                                                $fail($valid);
                                            }
                                    
                                        },
                                    ])
                                    // تعبئة حقل التاريخ في المودال بالتاريخ الموجود في السجل
                                    ->formatStateUsing(fn($record) => $record->date ? Carbon::parse($record->date)->format('Y-m-d H:i') : null)
                                    ->translateLabel(),
                            ])
                            ->modalSubmitActionLabel(__('panel.messages.editdate_request'))

                            ->action(function (Model $record, array $data) {
                                // عند تحديث التاريخ، سيتم التحديث في قاعدة البيانات
                                $record->update([
                                    'date' => Carbon::parse($data['date'])->format('Y-m-d H:i:s'),  // تأكد من تنسيق التاريخ بشكل صحيح
                                ]);
                        
                                FilamentNotification::make()
                                    ->success()
                                    ->title(__('panel.messages.success'))
                                    ->body(__('panel.messages.editdate_request'))
                                    ->persistent()
                                    ->send();
                            }),
                        
                    



                    Tables\Actions\Action::make('accept_request')
                        ->label(fn($record) => __('panel.messages.accept_request') )
                        ->hidden(fn($record) => ($record->date != null && Carbon::parse($record->date)->addMinutes($record->duration) < Carbon::now()))
                        ->visible(fn () => auth()->user()->hasRole('admin') || auth()->user()->hasRole('super_admin'))
                        ->color('success')
                        ->hidden(fn($record) => $record->status->value !== 'new')

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
                                
                                ->hidden(fn($record) => $record->status === 'pending')
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
                    Forms\Components\Select::make('responsible_user_id')
                            ->label(__('forms.fields.responsible_user'))
                            ->relationship('responsibleUser', 'name') // افترض أن العلاقة موجودة في النموذج
                            ->nullable() // يسمح بالقيمة null
                            ->required() // إذا كنت ترغب في جعله مطلوبًا، يمكنك إزالة هذا السطر
                            ->visible(fn () => auth()->user()->hasRole('admin') || auth()->user()->hasRole('super_admin'))
                           
                            ->translateLabel(),
                                ])
                        ->modalSubmitActionLabel(__('panel.messages.accept_request'))
                        ->action(function (Model $record, array $data) {
                            $record->update([
                                'date' => $data['date'],
                                'total' => $data['total'],
                                'duration' => $data['duration'],
                            ]);
                            $customerPhone = $record->customer->phone ?? null; // تأكد من وجود رقم هاتف العميل
                            if ($customerPhone) {
                                $messageForCustomer = "تم قبول طلبك رقم: " . $record->id . ". موعد الحجز: " . Carbon::parse($data['date'])->format('Y-m-d H:i')."قم بالدخول إلى لوحة التحكم لإتمام الدفع";
                                SendTextMessageAction::run($messageForCustomer, $customerPhone);
                            } 
            
                            FilamentNotification::make()
                                ->success()
                                ->title(__('panel.messages.success'))
                                ->body(__('panel.messages.accept_request'))
                                ->persistent()
                                ->send();
                        }),

                    Tables\Actions\Action::make('change_responsible_user')
                        ->label(__('panel.messages.change_responsible_user'))
                        ->color('primary')
                        ->icon('heroicon-o-user-group')
                        ->form([
                            Select::make('responsible_user_id')
                                ->label(__('forms.fields.responsible_user'))
                                ->relationship('responsibleUser', 'name') // افترض أن العلاقة موجودة في النموذج
                                ->nullable() // يسمح بالقيمة null
                                ->required() // إذا كنت ترغب في جعله مطلوبًا، يمكنك إزالة هذا السطر
                                ->translateLabel(),
                        ])
                        ->modalSubmitActionLabel(__('panel.messages.change_responsible_user'))
                        ->action(function (Model $record, array $data) {
                            $record->update([
                                'responsible_user_id' => $data['responsible_user_id'],
                            ]);
                            FilamentNotification::make()
                                ->success()
                                ->title(__('panel.messages.success'))
                                ->body(__('panel.messages.change_responsible_user'))
                                ->persistent()
                                ->send();
                        }),  
                    Tables\Actions\Action::make('cancel-order')
                        ->label(__('forms.fields.cancel_order'))
                        ->color('danger')
                        ->icon('heroicon-o-x-circle')
                        ->visible(fn () => auth()->user()->hasRole('admin') || auth()->user()->hasRole('super_admin'))
                        ->form([
                            TextInput::make('notes')
                                ->label(__("forms.fields.reason"))
                                ->required()
                                
                                ])
                        ->extraAttributes(['style' => 'cursor: pointer;'])
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
                        ->visible(fn () => auth()->user()->hasRole('admin') || auth()->user()->hasRole('super_admin'))
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
                        ->visible(fn () => auth()->user()->hasRole('admin') || auth()->user()->hasRole('super_admin'))

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
                    
                ])->label(__('panel.actions.actions'))
                    ->color('primary')
                    ->button()
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
                            // باقي الحقول السابقة
                            TextEntry::make('order_number'),
                            TextEntry::make('client_name'),
                            TextEntry::make('email'),
                            TextEntry::make('phone_number')
                                ->label(__('forms.fields.phone')),
                            // TextEntry::make('id_number'),
                            TextEntry::make('address'),
                            TextEntry::make('caseType.name')
                                ->label(__('forms.fields.case_type'))
                                ->visible(fn($record) => $record->ristrict == 'general_consultation'),
                            TextEntry::make('case_status_name')
                                ->label(__('forms.fields.case_status'))
                                ->visible(fn($record) => $record->ristrict == 'general_consultation'),
                            TextEntry::make('case_number')
                                ->label(__('site.case_number'))
                                ->visible(fn($record) => $record?->case_status == 'existing'),
                            TextEntry::make('court')
                                ->label(__('forms.fields.court'))
                                ->visible(fn($record) => $record->ristrict == 'general_consultation'),
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
                            TextEntry::make('payment_status'),
                            TextEntry::make('meeting_link')
                            ->visible(fn($record) => $record->meeting_link != null)
                            ->url(fn($record) => $record->meeting_link ?? 'لا يوجد رابط إجتماع بعد')  // جلب الرابط من الحقل
                            ->openUrlInNewTab()
                            ->columnSpan(2)
                            ->color('primary')
                            ->label(__('site.enter meeting'))
                            ->icon('heroicon-o-link')  ,


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
    
                            // باقي الحقول
                        ])
                        ->columns(3),
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


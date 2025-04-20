<?php

namespace Tasawk\Filament\Resources;

use Tasawk\Filament\Resources\PostsResource\Pages;
use Tasawk\Models\Blogger\Posts;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Concerns\Translatable;
use Tasawk\Traits\Filament\HasTranslationLabel;
use Illuminate\Support\Facades\App;
class PostsResource extends Resource
{
    use Translatable;
    use HasTranslationLabel;
    protected static ?string $model = Posts::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                ->label(__("forms.fields.title"))
                    ->required()
                    ->maxLength(75), // جعل الحقل يعرض كامل العرض
                
                Forms\Components\TextInput::make('metaTitle')
                ->label(__("forms.fields.metaTitle"))
                    ->nullable()
                    ->maxLength(100),
                
                Forms\Components\TextInput::make('slug')
                ->label(__("forms.fields.slug"))
                    ->required()
                    ->unique(Posts::class, 'slug', ignoreRecord: true)
                    ->maxLength(100),
                
                Forms\Components\Textarea::make('summary')
                ->label(__("forms.fields.summary"))
                    ->nullable(),
                
                Forms\Components\Checkbox::make('published')
                    ->label(__("forms.fields.published"))
                    ->default(false)
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        if ($state) {
                            $set('publishedAt', now());
                        } else {
                            $set('publishedAt', null); // يمكن حذف هذا السطر إذا كنت تريد الاحتفاظ بالتاريخ حتى بعد إلغاء التفعيل
                        }
                    }),
                Forms\Components\DateTimePicker::make('publishedAt')
                    ->label(__("forms.fields.publishedAt"))
                    ->nullable()
                    ->reactive()
                    ->visible(fn (callable $get) => $get('published') === true)
                    ->default(null),
                Forms\Components\RichEditor::make('content')
                ->label(__("forms.fields.content"))
                    ->nullable()
                    ->columnSpanFull(),
                
                Forms\Components\Hidden::make('authorId')
                    ->default(fn() => Auth::id()),
                
                // حقل createdAt
                Forms\Components\TextInput::make('createdAt')
                    ->disabled()
                    ->hidden()
                    ->default(now()->format('Y-m-d H:i:s')),
                
                // حقل updatedAt
                Forms\Components\TextInput::make('updatedAt')
                    ->disabled()
                    ->hidden()
                    ->default(now()->format('Y-m-d H:i:s')),
                
                // حقل الصورة في الأسفل
                Forms\Components\FileUpload::make('image')
                    ->label(__("forms.fields.image"))
                    ->image()
                    ->directory('posts')
                    ->nullable(), // جعل الحقل يعرض كامل العرض
                
                // إضافة حقل التصنيفات
                Forms\Components\Select::make('categories')
                ->label(__('forms.fields.categories'))
                ->multiple()
                ->relationship('categories', 'title') // نستخدم 'id' فقط للربط
                ->getOptionLabelFromRecordUsing(function ($record) {
                    $locale = App::getLocale(); // الحصول على اللغة الحالية
                    return $record->getTranslation('title', $locale); // ترجمة الاسم حسب اللغة
                })
                ->required()
                ->translateLabel(),
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('user.name') // عرض اسم الكاتب
                    ->label('Author')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('slug') // عرض اسم الكاتب
                    ->label('slug')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\BooleanColumn::make('published') // عمود حالة المنشور
                    ->label('Published')
                    ->sortable(),
            ])
            ->filters([ 
                // يمكنك إضافة فلاتر هنا إذا كنت ترغب في ذلك
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            // يمكنك إضافة أي علاقات هنا
        ];
    }
    public static function getNavigationGroup(): ?string {
        return __('menu.bloger');
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePosts::route('/create'),
            'edit' => Pages\EditPosts::route('/{record}/edit'),
        ];
    }
}

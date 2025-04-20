<?php 
namespace Tasawk\Filament\Pages;

use Filament\Pages\Page;

class BlogPage extends Page
{
    protected static string $view = 'filament.pages.blog.blog';

    protected static ?string $navigationLabel = 'مدونة'; // يمكنك تغيير الاسم حسب الحاجة
    protected static ?string $navigationIcon = 'heroicon-o-newspaper'; // يمكنك اختيار أي أيقونة
    protected static ?int $navigationSort = 6; // تحديد ترتيب ظهور الرابط

    public function mount()
    {
        // يمكنك إضافة أي بيانات هنا
    }
}

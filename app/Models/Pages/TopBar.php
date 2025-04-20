<?php
namespace Tasawk\Models\Pages;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class TopBar extends Model
{
    use HasFactory;

    protected $table = 'topbar'; // اسم الجدول
    protected $fillable = ['content', 'link', 'status']; // الحقول القابلة للتعبئة
}
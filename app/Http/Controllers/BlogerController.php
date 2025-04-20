<?php

namespace Tasawk\Http\Controllers;

use AnourValar\EloquentSerialize\Service;
use DB;
use Illuminate\Http\Request;
use Tasawk\Models\Pages\Partner;
use Tasawk\Models\Pages\OurService;
use Tasawk\Settings\GeneralSettings;
use Tasawk\Enum\PageStatus;
use Tasawk\Models\ContactType;
use Tasawk\Models\Faq;
use Tasawk\Models\Blogger\Posts;

use Tasawk\Models\Content\Page;
use Tasawk\Models\Pages\TopBar;

// use Tasawk\Services\MarkdownService;


class BlogerController extends Controller {
    // protected $markdownService;

    // public function __construct(MarkdownService $markdownService)
    // {
    //     $this->markdownService = $markdownService;
    // }
    protected function getTopBars() {
        return TopBar::where('status', 1)->get();
    }
    public function bloger()
    {
        // جلب بيانات التوب بار
        $topBars = $this->getTopBars();
    
        // جلب قائمة البوستات
        $posts = \DB::table('posts')
    ->select(
        'id',
        'title->ar as title_ar',
        'title->en as title_en',
        'title->fr as title_fr',
        'title->zh as title_zh',
        'title->de as title_de',
        'metaTitle->ar as metaTitle_ar',
        'metaTitle->en as metaTitle_en',
        'metaTitle->fr as metaTitle_fr',
        'metaTitle->zh as metaTitle_zh',
        'metaTitle->de as metaTitle_de',
        "slug",
        "title",
        "metaTitle",
        "summary",
        'slug->ar as slug_ar',
        'slug->en as slug_en',
        'slug->fr as slug_fr',
        'slug->zh as slug_zh',
        'slug->de as slug_de',
        'summary->ar as summary_ar',
        'summary->en as summary_en',
        'summary->fr as summary_fr',
        'summary->zh as summary_zh',
        'summary->de as summary_de',
        'content->ar as content_ar',
        'content->en as content_en',
        'content->fr as content_fr',
        'content->zh as content_zh',
        'content->de as content_de',
        'image',
        'published',
        'publishedAt',
        'createdAt'
    )
    ->where('published', 1) // فقط البوستات المنشورة
    ->whereNull('deleted_at')
    ->orderBy('publishedAt', 'desc')
    ->get();
        // جلب الفئات
        $categories = \DB::table('categories')
            ->select('id', 
            'title->ar  as title_ar',
            'title->en  as title_en',
            'title->fr  as title_fr',
            'title->zh  as title_zh',
            'title->de  as title_de',
            'metaTitle',
            'slug',
            'content',
            'parentId')
            ->whereNull('deleted_at') // تحقق من أن السجل غير محذوف
            ->get();
        // إعادة عرض المعلومات في الصفحة
        return view('site.pages.bloger.index', compact(
            'topBars',
            'posts',
            'categories'
        ));
    }
    public function filterByCategory($slug)
    {
        // جلب بيانات التوب بار
        $topBars = $this->getTopBars();
    
        // جلب الفئة بناءً على الـ slug
        $category = \DB::table('categories')->where('slug', $slug)->whereNull('deleted_at')->first();
    
        // التحقق مما إذا كانت الفئة موجودة
        if (!$category) {
            return redirect()->route('bloger')->with('error', 'الفئة غير موجودة.');
        }
    
        // جلب قائمة البوستات المرتبطة بالفئة
        $posts = Posts::where('published', 1) // فقط البوستات المنشورة
            ->whereHas('categories', function($query) use ($category) {
                $query->where('categoryId', $category->id); // تأكد من استخدام معرف الفئة
            })
            ->orderBy('publishedAt', 'desc')
            ->get();
    
        // جلب الفئات
        $categories = \DB::table('categories')
        ->select('id', 'title', 'metaTitle', 'slug', 'content', 'parentId')
        ->whereNull('deleted_at') // تحقق من أن السجل غير محذوف
        ->get();
        // إعادة عرض المعلومات في الصفحة
        return view('site.pages.bloger.index', compact(
            'topBars',
            'posts',
            'categories'
        ));
    }

    
    public function show($slug)
    {
        $topBars = $this->getTopBars();
        $locale = app()->getLocale();
    
        // استعلام البوست
        $post = \DB::table('posts')
            ->select(
                'id',
                'title->' . $locale . ' as title',
                'metaTitle->' . $locale . ' as metaTitle',
                'slug->' . $locale . ' as slug',
                'summary->' . $locale . ' as summary',
                'content->' . $locale . ' as content',
                'image',
                'published',
                'publishedAt',
                'createdAt'
            )
            ->where("slug->{$locale}", $slug)
            ->where('published', 1)
            ->whereNull('deleted_at')
            ->first();
    
        // لو ما حصل البوست
        if (!$post) {
            abort(404);
        }
    
        // استعلام الفئات المرتبطة بالبوست
        $categories = \DB::table('categories')
            ->join('post_category', 'categories.id', '=', 'post_category.categoryId')
            ->where('post_category.postId', $post->id)
            ->select('id', 'title->' . $locale . ' as title')
            ->get();
    
        return view('site.pages.bloger.show', compact('post', 'categories', 'topBars'));
    }
    
    
    public function companyVision() {
        $company_vision = \DB::table('media')
            ->join('page_contents', 'media.model_id', 'page_contents.id')
            ->where([
                'page_id' => PageStatus::COMPANYVISION->value,
                'media.collection_name' => 'default'
            ])->select('title->ar  as title_ar', 'title->en  as title_en', 'title->fr  as title_fr', 'title->de  as title_de', 'title->zh  as title_zh', 'description->ar  as description_ar', 'description->fr  as description_fr', 'description->de  as description_de', 'description->zh  as description_zh', 'description->en  as description_en', 'media.*')->first();
            $topBars = $this->getTopBars();
            return view('site.pages.company-vision', compact('company_vision',"topBars"));
    }

    
    public function topbars() {
        $topBars = $this->getTopBars();
        return view('site.pages.topbar', compact('topbars'));
    }
    
    
}


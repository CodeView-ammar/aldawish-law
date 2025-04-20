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
use Tasawk\Models\Content\Page;
use Tasawk\Models\Pages\TopBar;

// use Tasawk\Services\MarkdownService;


class PageController extends Controller {
    // protected $markdownService;

    // public function __construct(MarkdownService $markdownService)
    // {
    //     $this->markdownService = $markdownService;
    // }
    protected function getTopBars() {
        return TopBar::where('status', 1)->get();
    }
    public function aboutUs()
    {
        // استرجاع بيانات "عن الشركة"
        $about_us = \DB::table('media')
            ->join('page_contents', 'media.model_id', 'page_contents.id')
            ->where([
                'page_id' => PageStatus::ABOUTUS->value,
                'media.collection_name' => 'default'
            ])
            ->select(
                'title->ar as title_ar', 
                'title->en as title_en', 
                'title->fr as title_fr', 
                'title->de as title_de', 
                'title->zh as title_zh', 
                'description->ar as description_ar', 
                'description->fr as description_fr', 
                'description->de as description_de', 
                'description->zh as description_zh', 
                'description->en as description_en', 
                'media.*'
            )
            ->first();
    
        // استرجاع بيانات إعدادات عامة
        $general_Settings = new GeneralSettings();
        $years_of_experience = $general_Settings->years_of_experience ?? 0;
        $successful_pleadings = $general_Settings->successful_pleadings ?? 0;
        $legal_experts = $general_Settings->legal_experts ?? 0;
        $years_of_experience_text = $general_Settings->years_of_experience_text ?? "";
        $successful_pleadings_text = $general_Settings->successful_pleadings_text ?? "";
        $legal_experts_text = $general_Settings->legal_experts_text ?? "";
    
        // استرجاع بيانات "رسالة الشركة"
        $company_message = \DB::table('media')
            ->join('page_contents', 'media.model_id', 'page_contents.id')
            ->where([
                'page_id' => PageStatus::COMPANYMESSAGE->value,
                'media.collection_name' => 'default'
            ])
            ->select(
                'title->ar as title_ar', 
                'title->en as title_en', 
                'title->fr as title_fr', 
                'title->de as title_de', 
                'title->zh as title_zh', 
                'description->ar as description_ar', 
                'description->fr as description_fr', 
                'description->de as description_de', 
                'description->zh as description_zh', 
                'description->en as description_en', 
                'media.*'
            )
            ->first();
    
        // استرجاع بيانات "أهداف الشركة"
        $company_aims = \DB::table('media')
            ->join('page_contents', 'media.model_id', 'page_contents.id')
            ->where([
                'page_id' => PageStatus::COMPANYGOALS->value,
                'media.collection_name' => 'default'
            ])
            ->select(
                'title->ar as title_ar',
                'title->en as title_en',
                'title->fr as title_fr',
                'title->de as title_de',
                'title->zh as title_zh',
                'description->ar as description_ar',
                'description->fr as description_fr',
                'description->de as description_de',
                'description->zh as description_zh',
                'description->en as description_en',
                'media.*'
            )
            ->first();
    
        // استرجاع بيانات "قيمنا"
        $our_values = \DB::table('media')
            ->join('page_contents', 'media.model_id', 'page_contents.id')
            ->where([
                'page_id' => PageStatus::OURVALUES->value,
                'media.collection_name' => 'default'
            ])
            ->select(
                'title->ar as title_ar',
                'title->en as title_en',
                'title->fr as title_fr',
                'title->de as title_de',
                'title->zh as title_zh',
                'description->ar as description_ar',
                'description->fr as description_fr',
                'description->de as description_de',
                'description->zh as description_zh',
                'description->en as description_en',
                'media.*'
            )
            ->first();
    
        // استرجاع بيانات "الخبرات العلمية"
        $scientific_experiences = \DB::table('media')
            ->join('page_contents', 'media.model_id', 'page_contents.id')
            ->where([
                'page_id' => PageStatus::SCIENTIFICEXPERIENCES->value,
                'media.collection_name' => 'default'
            ])
            ->select(
                'title->ar as title_ar',
                'title->en as title_en',
                'title->fr as title_fr',
                'title->de as title_de',
                'title->zh as title_zh',
                'description->ar as description_ar',
                'description->fr as description_fr',
                'description->de as description_de',
                'description->zh as description_zh',
                'description->en as description_en',
                'media.*'
            )
            ->first();
    
        // استرجاع بيانات "الشركة المعنية"
        $relevant_company = \DB::table('media')
            ->join('page_contents', 'media.model_id', 'page_contents.id')
            ->where([
                'page_id' => PageStatus::RELEVANTCOMPANY->value,
                'media.collection_name' => 'default'
            ])
            ->select(
                'title->ar as title_ar', 
                'title->en as title_en', 
                'title->fr as title_fr', 
                'title->de as title_de', 
                'title->zh as title_zh', 
                'description->ar as description_ar', 
                'description->fr as description_fr', 
                'description->de as description_de', 
                'description->zh as description_zh', 
                'description->en as description_en', 
                'media.*'
            )
            ->first();
    
        // استرجاع بيانات "مهمة الفريق"
        $team_mission = \DB::table('media')
            ->join('page_contents', 'media.model_id', 'page_contents.id')
            ->where([
                'page_id' => PageStatus::TEAMMISSION->value,
                'media.collection_name' => 'default'
            ])
            ->select(
                'title->ar as title_ar', 
                'title->en as title_en', 
                'title->fr as title_fr', 
                'title->de as title_de', 
                'title->zh as title_zh', 
                'description->ar as description_ar', 
                'description->fr as description_fr', 
                'description->de as description_de', 
                'description->zh as description_zh', 
                'description->en as description_en', 
                'media.*'
            )
            ->first();
        // جلب بيانات التوب بار
        $topBars = $this->getTopBars();

        // إعادة عرض المعلومات في الصفحة
        return view('site.pages.about-us', compact(
            'about_us',
            'topBars',
            'years_of_experience',
            'successful_pleadings',
            'legal_experts',
            'years_of_experience_text',
            'successful_pleadings_text',
            'legal_experts_text',
            'company_message',  // إضافة بيانات رسالة الشركة
            'company_aims',     // إضافة بيانات أهداف الشركة
            'our_values',       // إضافة بيانات قيمنا
            'scientific_experiences', // إضافة بيانات الخبرات العلمية
            'relevant_company',  // إضافة بيانات الشركة المعنية
            'team_mission'      // إضافة بيانات مهمة الفريق
        ));
    }
    
    
    public function companyMessage() {
        $company_message = \DB::table('media')
            ->join('page_contents', 'media.model_id', 'page_contents.id')
            ->where([
                'page_id' => PageStatus::COMPANYMESSAGE->value,
                'media.collection_name' => 'default'
            ])->select('title->ar  as title_ar', 'title->en  as title_en', 'title->fr  as title_fr', 'title->de  as title_de', 'title->zh  as title_zh', 'description->ar  as description_ar', 'description->fr  as description_fr', 'description->de  as description_de', 'description->zh  as description_zh', 'description->en  as description_en', 'media.*')->first();
        $topBars = $this->getTopBars();
        return view('site.pages.company-message', compact('company_message',"topBars"));
    }

    public function companyAims() {
        $company_aims = \DB::table('media')
            ->join('page_contents', 'media.model_id', 'page_contents.id')
            ->where([
                'page_id' => PageStatus::COMPANYGOALS->value,
                'media.collection_name' => 'default'
            ])->select('title->ar  as title_ar', 'title->en  as title_en', 'title->fr  as title_fr', 'title->de  as title_de', 'title->zh  as title_zh', 'description->ar  as description_ar', 'description->fr  as description_fr', 'description->de  as description_de', 'description->zh  as description_zh', 'description->en  as description_en', 'media.*')->first();
            $topBars = $this->getTopBars();
            return view('site.pages.company-goals', compact('company_aims',"topBars"));
    }

    public function show(Page $page) {
        $topBars = $this->getTopBars();

        return view('site.pages.page', ['page'=>$page], compact("topBars"));
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

    public function ourValues() {
        $topBars = $this->getTopBars();

        $our_values = \DB::table('media')
            ->join('page_contents', 'media.model_id', 'page_contents.id')
            ->where([
                'page_id' => PageStatus::OURVALUES->value,
                'media.collection_name' => 'default'
            ])->select('title->ar  as title_ar', 'title->en  as title_en', 'title->fr  as title_fr', 'title->de  as title_de', 'title->zh  as title_zh', 'description->ar  as description_ar', 'description->fr  as description_fr', 'description->de  as description_de', 'description->zh  as description_zh', 'description->en  as description_en', 'media.*')->first();
        return view('site.pages.our-values', compact('our_values',"topBars"));
    }

    public function scientificExperiences() {
        $topBars = $this->getTopBars();
        $scientific_experiences = \DB::table('media')
            ->join('page_contents', 'media.model_id', 'page_contents.id')
            ->where([
                'page_id' => PageStatus::SCIENTIFICEXPERIENCES->value,
                'media.collection_name' => 'default'
            ])->select('title->ar  as title_ar', 'title->en  as title_en', 'title->fr  as title_fr', 'title->de  as title_de', 'title->zh  as title_zh', 'description->ar  as description_ar', 'description->fr  as description_fr', 'description->de  as description_de', 'description->zh  as description_zh', 'description->en  as description_en', 'media.*')->first();
        return view('site.pages.scientific-experiences', compact('scientific_experiences',"topBars"));
    }

    public function relevantCompany() {
        $topBars = $this->getTopBars();
        $relevant_company = \DB::table('media')
            ->join('page_contents', 'media.model_id', 'page_contents.id')
            ->where([
                'page_id' => PageStatus::RELEVANTCOMPANY->value,
                'media.collection_name' => 'default'
            ])->select('title->ar  as title_ar', 'title->en  as title_en', 'title->fr  as title_fr', 'title->de  as title_de', 'title->zh  as title_zh', 'description->ar  as description_ar', 'description->fr  as description_fr', 'description->de  as description_de', 'description->zh  as description_zh', 'description->en  as description_en', 'media.*')->first();
        return view('site.pages.relevant-company', compact('relevant_company',"topBars"));
    }

    public function teamMission() {
        $topBars = $this->getTopBars();
        $team_mission = \DB::table('media')
            ->join('page_contents', 'media.model_id', 'page_contents.id')
            ->where([
                'page_id' => PageStatus::TEAMMISSION->value,
                'media.collection_name' => 'default'
            ])->select('title->ar  as title_ar', 'title->en  as title_en', 'title->fr  as title_fr', 'title->de  as title_de', 'title->zh  as title_zh', 'description->ar  as description_ar', 'description->fr  as description_fr', 'description->de  as description_de', 'description->zh  as description_zh', 'description->en  as description_en', 'media.*')->first();
        return view('site.pages.team-mission', compact('team_mission',"topBars"));
    }

    public function services() {
        $services = OurService::select('id', 'title->ar  as title_ar', 'title->fr  as title_fr', 'title->de  as title_de', 'title->zh  as title_zh', 'title->en  as title_en', 'description->ar  as description_ar', 'description->fr  as description_fr', 'description->de  as description_de', 'description->zh  as description_zh', 'description->en  as description_en', 'icon')
            ->where('status', 1)->orderBy('sort', 'asc')->paginate(15);
            $topBars = $this->getTopBars();
        return view('site.pages.services', compact('services',"topBars"));
    }

    public function serviceDetails(OurService $service) {
        $our_service = OurService::where('id', $service->id)->select('id', 'title->ar  as title_ar', 'title->en  as title_en', 'title->fr  as title_fr', 'title->de  as title_de', 'title->zh  as title_zh', 'description->ar  as description_ar', 'description->fr  as description_fr', 'description->de  as description_de', 'description->zh  as description_zh', 'description->en  as description_en', 'icon')->first();
        $topBars = $this->getTopBars();
        return view('site.pages.service-details', compact('our_service',"topBars"));
    }
 
    public function partners() {
        $partners = Partner::where('status', 1)->paginate(36);
        $topBars = $this->getTopBars();
        return view('site.pages.partners', compact('partners',"topBars"));
    }
    public function topbars() {
        $topBars = $this->getTopBars();
        return view('site.pages.topbar', compact('topbars'));
    }
    public function contactUs() {
        $contact_type = ContactType::where('status', 1)->get();
        $general_Settings = new GeneralSettings();
        $email = $general_Settings->app_email;
        $phone = $general_Settings->app_phone;
        $address = $general_Settings->app_address;
        $app_location = $general_Settings->app_location;
        $topBars = $this->getTopBars();
        return view('site.pages.contact-us', compact('contact_type',"topBars", 'email', 'phone', 'address', 'app_location'));
    }
    
    public function career() {
        $topBars = $this->getTopBars();
        return view('site.pages.career',compact('topBars'));
    }

    public function faq() {
        $faqs = Faq::where('status', 1)
            ->orderBy('id', 'desc')
            ->take(5)->get();
        $topBars = $this->getTopBars();
        return view('site.pages.faqs', compact('faqs',"topBars"));
    }

    public function termsCondition() {
        $general_Settings = new GeneralSettings();
        $term_id = $general_Settings->app_pages['terms_and_conditions'];
        $term = Page::findOrFail($term_id);
        $language = app()->getLocale();
        $topBars = $this->getTopBars();
        return view('site.pages.terms-condition', compact('term', 'language',"topBars"));
    }

    public function privacyPolicy() {
        $general_Settings = new GeneralSettings();
        $privacy_id = $general_Settings->app_pages['privacy_policy'];
        $privacy = Page::findOrFail($privacy_id);
        $language = app()->getLocale();
        $topBars = $this->getTopBars();
        return view('site.pages.privacy-policy', compact('privacy', 'language',"topBars"));
    }
}


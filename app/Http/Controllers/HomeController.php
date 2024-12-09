<?php

namespace Tasawk\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Tasawk\Models\Pages\AboutUs;
use Tasawk\Models\Content\Banner;
use Tasawk\Models\Pages\OurService;
use Tasawk\Models\Pages\Partner;
use Tasawk\Settings\GeneralSettings;
use Tasawk\Models\Nationality;


class HomeController extends BaseController
{

    public function index()
    {

        $banners = Banner::where('status', 1)->take(4)->get();
        $aboutUs = AboutUs::first();
        $general_Settings = new GeneralSettings();
        $years_of_experience = $general_Settings->years_of_experience ?? 0;
        $successful_pleadings = $general_Settings->successful_pleadings ?? 0;
        $legal_experts = $general_Settings->legal_experts ?? 0;
        $years_of_experience_text = $general_Settings->years_of_experience_text ?? "";
        $successful_pleadings_text = $general_Settings->successful_pleadings_text ?? "";
        $legal_experts_text = $general_Settings->legal_experts_text ?? "";
        // dd($legal_experts_text);
        $home_services = OurService::select('id', 'title->ar  as title_ar', 'title->en  as title_en', 'description->ar  as description_ar', 'description->en  as description_en', 'icon')
            ->take(6)->get();
        $partners = Partner::where('status', 1)->take(10)->latest()->get();
        return view(
            'site.pages.index',
            compact(
                'banners',
                'aboutUs',
                'years_of_experience',
                'successful_pleadings',
                'legal_experts',
                'years_of_experience_text',
                'successful_pleadings_text',
                'legal_experts_text',
                'home_services',
                'partners'
            )
        );
    }
}

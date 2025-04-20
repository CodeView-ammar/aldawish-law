@extends('site.layouts.master')
@section('page_title', ' / ' . __('site.about_us'))
@section('body_class', 'inner-page')
@section('content')

<style>
    .about-section {
        padding: 40px 20px;
        display: flex;
        align-items: center;
        margin: 0 auto;
        gap: 40px; /* Space between image and text */
        flex-wrap: wrap;
        max-width: 1200px; /* Limit maximum width */
        border-bottom: 2px solid #082239; /* Section separator */
    }

    .about-section:last-child {
        border-bottom: none;
    }

    .about-section.reverse {
        flex-direction: row-reverse;
    }

    .about-section img {
        flex: 1 1 45%; /* Grow and shrink with 45% base width */
        max-width: 500px; /* Increased max width */
        min-width: 300px;
        height: auto;
        border-radius: 8px; /* Optional: adds rounded corners */
        object-fit: cover; /* Ensure images maintain aspect ratio */
    }

    .about-section .content {
        flex: 1 1 50%; /* Take remaining space */
        min-width: 300px;
        padding: 20px;
    }

    .about-section h1,
    .about-section h2 {
        font-size: 28px;
        margin-bottom: 20px;
        color: #2a2a2a;
        line-height: 1.3;
        font-weight: bold;
    }

    .about-section p {
        font-size: 17px;
        line-height: 1.8;
        color: #444;
        max-width: 600px; /* Optimal line length for readability */
    }

    @media (max-width: 1024px) {
        .about-section {
            gap: 30px;
            padding: 30px 20px;
        }
        
        .about-section img {
            max-width: 400px;
        }
    }

    @media (max-width: 768px) {
        .about-section {
            flex-direction: column;
            text-align: center;
            padding: 40px 15px;
            gap: 25px;
        }

        .about-section img {
            width: 100%;
            max-width: 100%;
            min-width: auto;
        }

        .about-section .content {
            padding: 0;
            text-align: left; /* Or keep centered based on design */
        }

        .about-section p {
            text-align: justify; /* Improves readability for paragraphs */
        }
    }
    
</style>


<!-- about-section -->
<div class="about-section" style="margin-top: 120px;text-align: right;" >
    @if ($about_us)
        <img src="{{ asset('storage/' . $about_us->id . '/' . $about_us->file_name) }}" alt="about us img" />
        <div class="content" style="text-align: right;">
            <h1>{{ $about_us->{'title_' . app()->getLocale()} ?? $about_us->title_en }}</h1>
            <p>{!! $about_us->{'description_' . app()->getLocale()} ?? $about_us->description_en !!}</p>
        </div>
    @endif
</div>

<!-- company message section -->
<div class="about-section reverse" style="text-align: right;">
    @if ($company_message)
        <img src="{{ asset('storage/' . $company_message->id . '/' . $company_message->file_name) }}" alt="company message img" />
        <div class="content" style="text-align: right;">
            <h2>{{ $company_message->{'title_' . app()->getLocale()} ?? $company_message->title_en }}</h2>
            <p>{!! $company_message->{'description_' . app()->getLocale()} ?? $company_message->description_en !!}</p>
        </div>
    @endif
</div>

<!-- company aims section -->
<div class="about-section" >
    @if ($company_aims)
        <img src="{{ asset('storage/' . $company_aims->id . '/' . $company_aims->file_name) }}" alt="company aims img" />
        <div class="content" style="text-align: right;">
            <h2>{{ $company_aims->{'title_' . app()->getLocale()} ?? $company_aims->title_en }}</h2>
            <p>{!! $company_aims->{'description_' . app()->getLocale()} ?? $company_aims->description_en !!}</p>
        </div>
    @endif
</div>

<!-- our values section -->
@if ($our_values)
<div class="about-section reverse" style="text-align: right;">
        <img src="{{ asset('storage/' . $our_values->id . '/' . $our_values->file_name) }}" alt="our values img" />
        <div class="content" style="text-align: right;">
            <h2>{{ $our_values->{'title_' . app()->getLocale()} ?? $our_values->title_en }}</h2>
            <p>{!! $our_values->{'description_' . app()->getLocale()} ?? $our_values->description_en !!}</p>
        </div>
</div>
    @endif

<!-- scientific experiences section -->
<div class="about-section reverse"style="text-align: right;">
    @if ($scientific_experiences)
        <img src="{{ asset('storage/' . $scientific_experiences->id . '/' . $scientific_experiences->file_name) }}" alt="scientific experiences img" />
        <div class="content" style="text-align: right;">
            <h2>{{ $scientific_experiences->{'title_' . app()->getLocale()} ?? $scientific_experiences->title_en }}</h2>
            <p>{!! $scientific_experiences->{'description_' . app()->getLocale()} ?? $scientific_experiences->description_en !!}</p>
        </div>
    @endif
</div>

<!-- relevant company section -->
<div class="about-section " style="text-align: right;">
    @if ($relevant_company)
        <img src="{{ asset('storage/' . $relevant_company->id . '/' . $relevant_company->file_name) }}" alt="relevant company img" />
        <div class="content" style="text-align: right;">
            <h2>{{ $relevant_company->{'title_' . app()->getLocale()} ?? $relevant_company->title_en }}</h2>
            <p>{!! $relevant_company->{'description_' . app()->getLocale()} ?? $relevant_company->description_en !!}</p>
        </div>
    @endif
</div>

<!-- team mission section -->
<div class="about-section reverse"style="text-align: right;">
    @if ($team_mission)
        <img src="{{ asset('storage/' . $team_mission->id . '/' . $team_mission->file_name) }}" alt="team mission img" />
        <div class="content" style="text-align: right;">
            <h2>
                @if(app()->getLocale() == 'ar' && $team_mission->title_ar != null)
                    {{ $team_mission->title_ar }}
                @elseif(app()->getLocale() == 'en' && $team_mission->title_en != null)
                    {{ $team_mission->title_en }}
                @elseif(app()->getLocale() == 'fr' && $team_mission->title_fr != null)
                    {{ $team_mission->title_fr }}
                @elseif(app()->getLocale() == 'zh' && $team_mission->title_zh != null)
                    {{ $team_mission->title_zh }}
                @elseif(app()->getLocale() == 'de' && $team_mission->title_de != null)
                    {{ $team_mission->title_de }}
                @else
                    {{ $team_mission->title_en }}
                @endif
            </h2>
            <p>
                @if(app()->getLocale() == 'ar' && $team_mission->description_ar != null)
                    {!! $team_mission->description_ar !!}
                @elseif(app()->getLocale() == 'en' && $team_mission->description_en != null)
                    {!! $team_mission->description_en !!}
                @elseif(app()->getLocale() == 'fr' && $team_mission->description_fr != null)
                    {!! $team_mission->description_fr !!}
                @elseif(app()->getLocale() == 'zh' && $team_mission->description_zh != null)
                    {!! $team_mission->description_zh !!}
                @elseif(app()->getLocale() == 'de' && $team_mission->description_de != null)
                    {!! $team_mission->description_de !!}
                @else
                    {!! $team_mission->description_en !!}
                @endif
            </p>
        </div>
    @endif
</div>

@endsection
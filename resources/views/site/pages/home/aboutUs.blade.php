<div class="about-us-section">
    <div class="container">
        <div class="about-us-content wow fadeInDown">
            <span class="small-title">
                {{ trans('site.about_us') }}
            </span>

            <h2 class="about-us-title"> {{ $aboutUs['title'] }} </h2>
            <p class="about-us-paragraph">{{ strip_tags($aboutUs['description']) }}</p>


          </p>
            <div class="counter-section wow fadeInDown" id="counter">
                <div class="count">
                    <h3 class="counter-number">{{ $years_of_experience }}</h3>
                    <div class="counter-name-div">
                        <span class="counter-name"> {{ $years_of_experience_text[app()->getLocale()] ??  $years_of_experience_text['en'] }} </span>
                    </div>
                </div>
                <div class="count">
                    <h3 class="counter-number"> {{ $successful_pleadings }} </h3>
                    <div class="counter-name-div">
                        <span class="counter-name"> {{ $successful_pleadings_text[app()->getLocale()] ??  $years_of_experience_text['en']  }} </span>
                    </div>
                </div>
                <div class="count">
                    <h3 class="counter-number"> {{ $legal_experts }}</h3>
                    <div class="counter-name-div">
                        <span class="counter-name"> {{ $legal_experts_text[app()->getLocale()] ??  $years_of_experience_text['en']  }} </span>
                    </div>
                </div>

            </div>
            <a href="{{ route('about-us') }}" class="read-more-link"> {{ trans('site.read_more') }}</a>
        </div>
    </div>
</div>

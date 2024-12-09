<script src="{{ asset('site/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('site/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('site/js/wow.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('site/js/swiper.min.js') }}"></script>
<script src="{{ asset('site/js/script.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.js"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@23.7.3/build/js/intlTelInput.min.js"></script>

<script type="module" >
import locale from "https://cdn.jsdelivr.net/npm/intl-tel-input@23.7.3/build/js/i18n/{{app()->getLocale()}}/index.js"

    const input = document.getElementById("phone_number");
    const iti = window.intlTelInput(input, {
        i18n: locale,
        initialCountry: "sa",
        separateDialCode: true,
        utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@23.7.3/build/js/utils.js",
    });


</script>
@stack("scripts")

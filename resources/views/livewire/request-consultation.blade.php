@push('css')
<style>
    @media (min-width: 1024px) {
        .case-summary-textarea {
            width: 500px;
        }
    }
</style>
@endpush

<div x-data="{ show: true, case_number: false, court: false, consultation: true, caseFields: false, arbitrationFields: false }">
<form wire:submit.prevent="submitForm" class="careers-form">
        <div>
            <label class="form-label required">{{ trans('site.order_type') }}</label>
            <div class="checkbox-section">
                <div class="radio-button-block checkbox-block">
                    <div class="radio-check">
                        <input type="radio" id="general_consultation" wire:model="ristrict" value="general_consultation" @click="consultation = true; caseFields = false; arbitrationFields = false; show = false;">
                        <label class="radio-btn-label" for="general_consultation">{{ trans('site.general_consultation') }}</label>
                    </div>
                </div>
                <div class="radio-button-block checkbox-block">
                    <div class="radio-check">
                        <input type="radio" id="Cases" wire:model="ristrict" value="cases" @click="consultation = false; caseFields = true; arbitrationFields = false; show = true;">
                        <label class="radio-btn-label" for="Cases">{{ trans('site.cases') }}</label>
                    </div>
                </div>
                <div class="radio-button-block checkbox-block">
                    <div class="radio-check">
                        <input type="radio" id="arbitration" wire:model="ristrict" value="arbitration" @click="consultation = false; caseFields = false; arbitrationFields = true; show = false;">
                        <label class="radio-btn-label" for="arbitration">{{ trans('site.arbitration') }}</label>
                    </div>
                </div>
            </div>
            @error('ristrict')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- بيانات العميل المشتركة لجميع الخيارات -->
        <div>
            <label class="form-label required">{{ trans('site.client_name') }}</label>
            <input type="text" wire:model="client_name" class="form-input" required>
            @error('client_name')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div>
        <div wire:ignore>
            <label class="form-label required">{{ trans('site.phone_number') }}</label>
            <input type="tel" id="phone_number" wire:model="phone_number" class="form-input" required>
            <input type="hidden" wire:model="country_code">
            <input type="hidden" wire:model="country_key">
        </div>
        @error('phone_number')
        <small class="text-danger">{{ $message }}</small>
        @enderror
        <div>
            <label class="form-label required">{{ trans('site.email') }}</label>
            <input type="email" wire:model="email" class="form-input" required>
            @error('email')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div>
            <label class="form-label required">{{ trans('site.address') }}</label>
            <input type="text" wire:model="address" class="form-input" required>
            @error('address')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- عند اختيار استشارة عامة -->
        <div x-show="consultation">
            <div>
                <label class="form-label required">{{ trans('site.consultation_subject') }}</label>
                <input type="text" wire:model="consultation_subject" class="form-input" >
                @error('consultation_subject')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div>
                <label class="form-label required">{{ trans('site.consultation_summary') }}</label>
                <textarea wire:model="case_summary" class="form-input form-textarea textarea-text case-summary-textarea" required></textarea>
                @error('case_summary')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div style="display: none;">
                <label class="form-label required">{{ trans('site.party_in_the_case') }}</label>
                <div class="select" wire:ignore>
                    <select wire:model="party_in_the_case_id" class="form-input party-select">
                        <option value="1"></option>
                        
                    </select>
                </div>
                @error('party_in_the_case_id')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <!-- عند اختيار قضايا -->
        <div x-show="caseFields">
            <div>
                <label class="form-label required">{{ trans('site.case_type') }}</label>
                <div class="select" wire:ignore>
                    <select wire:model="case_type_id" class="form-input case-select">
                        <option>{{ trans('site.choose_from') }}</option>
                        @foreach ($case_type as $type)
                        <option value="{{ $type->id }}">
                            @if(app()->getLocale() == 'ar' && $type->name_ar != null)
                            {{ $type->name_ar }}
                            @elseif(app()->getLocale() == 'en' && $type->name_en != null)
                            {{ $type->name_en }}
                            @elseif(app()->getLocale() == 'fr' && $type->name_fr != null)
                            {{ $type->name_fr }}
                            @elseif(app()->getLocale() == 'zh' && $type->name_zh != null)
                            {{ $type->name_zh }}
                            @elseif(app()->getLocale() == 'de' && $type->name_de != null)
                            {{ $type->name_de }}
                            @else
                            {{ $type->name_en }}
                            @endif
                        </option>
                        @endforeach
                    </select>
                </div>
                @error('case_type_id')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div>
                <label class="form-label required">{{ trans('site.case_status') }}</label>
                <div class="checkbox-section">
                    <div class="radio-button-block checkbox-block">
                        <div class="radio-check">
                            <input type="radio" id="new" wire:model="case_status" name="status" value="new" checked x-on:click="case_number = false; court = false">
                            <label class="radio-btn-label" for="new">{{ trans('site.new') }}</label>
                        </div>
                    </div>
                    <div class="radio-button-block checkbox-block">
                        <div class="radio-check">
                            <input type="radio" id="existing" wire:model="case_status" name="status" value="existing" x-on:click="case_number = true; court = true">
                            <label class="radio-btn-label" for="existing">{{ trans('site.existing') }}</label>
                        </div>
                    </div>
                </div>
                @error('case_status')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div x-show="case_number">
                <label class="form-label required">{{ trans('site.case_number') }}</label>
                <input type="text" wire:model="case_number" class="form-input">
                @error('case_number')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div x-show="court">
                <label class="form-label required">{{ trans('site.court') }}</label>
                <input type="text" wire:model="court" class="form-input">
                @error('court')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div>
                <label class="form-label required">{{ trans('site.party_in_the_case') }}</label>
                <div class="select" wire:ignore>
                    <select wire:model="party_in_the_case_id" class="form-input party-select">
                        <option>{{ trans('site.choose_from') }}</option>
                        @foreach ($party_in_the_case as $party)
                        <option value="{{ $party->id }}">
                            @if(app()->getLocale() == 'ar' && $party->name_ar != null)
                            {{ $party->name_ar }}
                            @elseif(app()->getLocale() == 'en' && $party->name_en != null)
                            {{ $party->name_en }}
                            @elseif(app()->getLocale() == 'fr' && $party->name_fr != null)
                            {{ $party->name_fr }}
                            @elseif(app()->getLocale() == 'zh' && $party->name_zh != null)
                            {{ $party->name_zh }}
                            @elseif(app()->getLocale() == 'de' && $party->name_de != null)
                            {{ $party->name_de }}
                            @else
                            {{ $party->name_en }}
                            @endif
                        </option>
                        @endforeach
                    </select>
                </div>
                @error('party_in_the_case_id')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div>
                <label class="form-label required">{{ trans('site.case_summary') }}</label>
                <textarea wire:model="case_summary" class="form-input form-textarea textarea-text case-summary-textarea" required></textarea>
                @error('case_summary')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <!-- عند اختيار تحكيم -->
        <div x-show="arbitrationFields">
            <div>
                <label class="form-label required">{{ trans('site.party_in_the_case') }}</label>
                <div class="select" wire:ignore>
                    <select wire:model="party_in_the_case_id" class="form-input party-select">
                        <option>{{ trans('site.choose_from') }}</option>
                        @foreach ($party_in_the_case as $party)
                        <option value="{{ $party->id }}">
                            @if(app()->getLocale() == 'ar' && $party->name_ar != null)
                            {{ $party->name_ar }}
                            @elseif(app()->getLocale() == 'en' && $party->name_en != null)
                            {{ $party->name_en }}
                            @elseif(app()->getLocale() == 'fr' && $party->name_fr != null)
                            {{ $party->name_fr }}
                            @elseif(app()->getLocale() == 'zh' && $party->name_zh != null)
                            {{ $party->name_zh }}
                            @elseif(app()->getLocale() == 'de' && $party->name_de != null)
                            {{ $party->name_de }}
                            @else
                            {{ $party->name_en }}
                            @endif
                        </option>
                        @endforeach
                    </select>
                </div>
                @error('party_in_the_case_id')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div>
                <label class="form-label required">{{ trans('site.case_summary') }}</label>
                <textarea wire:model="case_summary" class="form-input form-textarea textarea-text case-summary-textarea" required></textarea>
                @error('case_summary')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div>
            <label class="form-label ">@lang('site.add_file_re')</label>
            <div class="upload__box">
                <div class="upload__btn-box">
                    <label class="custom-file-upload form-input">
                        <input type="file" wire:model="file" class="upload-change" multiple />
                        <span class="upload-btn file-txt" data-title=""></span>
                    </label>
                </div>
            </div>
            @error('file')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button wire:loading.attr="disabled" wire:target="submitForm" class="submit-btn">
            <span wire:loading>
                <div class="spinner-border spinner-border-sm text-light" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </span>
            <span wire:loading.remove wire:target="submitForm">{{ trans('site.send') }}</span>
        </button>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('.case-select').on('change', function(e) {
            var data = $('.case-select').select2("val");
            @this.set('case_type_id', data);
        });
        @this.set('party_in_the_case_id', 1);
        $('.party-select').on('change', function(e) {
            var data = $('.party-select').select2("val");
            
            @this.set('party_in_the_case_id', 1);
        });
    });

    $(".custom-file-upload .upload-change").change(function() {
        let file_val;
        if ($(this).val() == "") {
            file_val = $(".file-txt").data("title");
        } else {
            file_val = $(this).prop("files")[0].name;
        }
        $(this).next().html(file_val);
    });

    $(function() {
        document.getElementById("phone_number").addEventListener("countrychange", function() {
            @this.set('country_code', iti.getSelectedCountryData().iso2);
            @this.set('country_key', iti.getSelectedCountryData().dialCode);
        });
    });
</script>
@endpush

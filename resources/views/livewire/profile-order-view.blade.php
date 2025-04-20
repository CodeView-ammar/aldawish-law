<div class="about-us-section">
    <div class="container">
        <div id="agora-react"></div>
        <div class="careers-section">
            <div class="edit-account-section">
                @include('site.layouts.app.profile_menue')
                <div class="careers-form-section w-848">
                    <div class="notifications-title-bar">
                        <h2 class="sign-in-success-title text-start w-auto ">
                            {{ trans('site.order_details') }}
                            # {{ $order->order_number }}
                        </h2>
                     <div class="d-flex justify-content-center gap-2">
                     @if( $order->status->value != 'completed' )
                     @if($order->status->value != 'rejected')
                             <a class="delete-notifications back {{$order->status->value}}"  onclick="Livewire.dispatch('openModal', { component: 'cancel-order', arguments: { cancel_resouns: {{ $cancel_resouns }}, order : {{ $order }} }})">
                                 {{ trans('site.cancel_reasoun') }}
                             </a>
                        @endif
                        @endif

                         <a href="{{ route('site.profile.myOrders') }}" class="delete-notifications back">
                             {{ trans('site.back') }}
                         </a>
                     </div>
                    </div>
                    <div class="order-details">
                        <div class="order-details-reply-section">

                            <div class="notification-block  flex-wrap">
                                <h3 class="order-details-title">
                                    {{ trans('site.order_data') }}
                                </h3>
                                <div class="order-details-row">
                                    <label class="order-details-label">
                                        {{ trans('site.order_number') }}
                                    </label>
                                    <span class="order-details-answer">
                                        # {{ $order->order_number }}
                                    </span>
                                </div>
                                <div class="order-details-row">
                                    <label class="order-details-label">

                                        {{ trans('site.order_date') }}
                                    </label>
                                    <span class="order-details-answer">
                                        {{ $order->date_text }}
                                    </span>
                                </div>
                                <div class="order-details-row">
                                    <label class="order-details-label">

                                        {{ trans('site.order_type') }}
                                    </label>
                                    <span class="order-details-answer">
                                        {{ $order->ristrict_name }}
                                    </span>
                                </div>
                                <div class="order-details-row">
                                    <label class="order-details-label">
                                        {{ trans('site.order status') }}
                                    </label>
                                    <span class="order-details-answer order-status {{ $order?->status?->getColorClass() }}">
                                        {{ $order->status->getLabel() }}
                                    </span>
                                </div>
                                <div class="order-details-row">
                                    <label class="order-details-label">

                                        {{ trans('site.client_name') }}
                                    </label>
                                    <span class="order-details-answer">
                                        {{ $order->client_name }}
                                    </span>
                                </div>
                                <div class="order-details-row">
                                    <label class="order-details-label">
                                        {{ trans('site.id_number') }}
                                    </label>
                                    <span class="order-details-answer">
                                        {{ $order->id_number }}
                                    </span>
                                </div>
                                <div class="order-details-row">
                                    <label class="order-details-label">
                                        {{ trans('site.phone_number') }}
                                    </label>
                                    <span class="order-details-answer">
                                        {{  substr(preg_replace('/\D/', '', $order->phone_number), -9) }}
                                    </span>
                                </div>
                                <div class="order-details-row">
                                    <label class="order-details-label">
                                        {{ trans('site.email') }}
                                    </label>
                                    <span class="order-details-answer">
                                        {{ $order->email }}
                                    </span>
                                </div>
                                <div class="order-details-row">
                                    <label class="order-details-label">
                                        {{ trans('site.address') }}
                                    </label>
                                    <span class="order-details-answer">
                                        {{ $order->address }}
                                    </span>
                                </div>
                                @if ($order->case_type != null)
                                <div class="order-details-row">
                                    <label class="order-details-label">
                                        {{ trans('site.case_type') }}
                                    </label>
                                    <span class="order-details-answer">
                                        {{ $order->caseType->name ?? trans('site.not_available') }}
                                    </span>
                                </div>
                                @endif
                                @if ($order->ristrict == 'cases')
                                <div class="order-details-row">
                                    <label class="order-details-label">
                                        {{ trans('site.case_status') }}
                                    </label>
                                    <span class="order-details-answer">
                                        {{ $order->case_status_name }}
                                    </span>
                                </div>
                                @endif
                                @if ($order->case_status == 'existing')
                                <div class="order-details-row">
                                    <label class="order-details-label">
                                        {{ trans('site.case_number') }}
                                    </label>
                                    <span class="order-details-answer">
                                        {{ $order->case_number }}
                                    </span>
                                </div>
                                @endif
                                @if ($order->court != null)
                                <div class="order-details-row">
                                    <label class="order-details-label">
                                        {{ trans('site.court') }}
                                    </label>
                                    <span class="order-details-answer">
                                        {{ $order->court }}
                                    </span>
                                </div>
                                @endif
                                @if ($order->party_in_the_case != null)
                                <div class="order-details-row">
                                    <label class="order-details-label">
                                        {{ trans('site.party_in_the_case') }}
                                    </label>
                                    <span class="order-details-answer">
                                        {{ $order?->caseParty?->name }}
                                    </span>
                                </div>
                                @endif

                                <div class="order-details-row">
                                    <label class="order-details-label">
                                        {{ trans('site.case_documents') }}
                                    </label>
                                    {{-- <a href="{{ $order->file }}" target="__blank"
                                    class="order-details-answer download-button">
                                    {{ trans('site.download') }}
                                    </a> --}}
                                    @foreach ($order->getMedia('consultation') as $attachment)
                                    <a target="_blank" href="{{ $attachment->getUrl() }}" class="order-details-answer download-button" download="{{ $attachment->getUrl() }}">
                                        {{-- {{ $attachment->name }} --}}
                                        {{ trans('site.download') }}
                                    </a>
                                    @endforeach
                                </div>
                                <div class="order-details-row">
                                    <label class="order-details-label">
                                        {{ trans('site.case_summary') }}
                                    </label>
                                    <span class="order-details-answer case-brief">
                                        {{ $order->case_summary }}
                                    </span>
                                </div>

                                @if($order?->cancellation)
                                <div class="order-details-row">
                                    <label class="order-details-label">
                                        {{ trans('site.cancel_resouns') }}
                                    </label>
                                    <span class="order-details-answer case-brief">
                                        @if($order?->cancellation?->cancellation_reason_id == 0)
                                        {{ $order?->cancellation?->notes }}
                                        @else
                                        {{$order?->cancellation?->reason?->name }}
                                        @endif
                                    </span>
                                </div>
                                @endif
                            </div>

                            @if (($order->status->value == 'completed' && $order->comment != null) )
                            <div class="notification-block flex-wrap">
                                <h3 class="order-details-title">
                                    {{ trans('site.the_advisor_replied') }}
                                </h3>
                                <div class="order-details-row">
                                    <label class="order-details-label">
                                        {{ trans('site.reply_details') }}
                                    </label>
                                    <span class="order-details-answer case-brief">
                                        {{ $order->comment }}
                                    </span>
                                </div>
                                <div class="order-details-row">
                                    <label class="order-details-label">
                                        مرفقات {{ trans('site.attachments') }}
                                    </label>
                                    <a href="{{ $order->attachment }}" class="order-details-answer download-button" target="_blank" download="{{ $order->attachment }}">
                                        {{ trans('site.download') }}

                                    </a>

                                </div>

                            </div>
                            @endif

                        </div>

                        @if ($order->payment_status->value == 'new'||$order->payment_status->value == 'pending'|| $order->payment_status->value == 'rejected')
                        @if ($order->total > 0)
                        <livewire:payment :order="$order">
                            @endif
                            @else
                            @if($order->payment_status->value != 'rejected')
                            @include('site.pages.order.currant')
                            @endif
                            @endif

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

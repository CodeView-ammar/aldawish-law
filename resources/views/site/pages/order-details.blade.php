@extends('site.layouts.master')
@section('page_title', __('site.my_orders'))
@section('body_class', 'inner-page')
@section('content')
    <div class="breadcrumb-section">
        <h2 class="breadcrumb-head">{{ trans('site.my_orders') }}</h2>
        <ol class="breadcrumb">
            <li class="item-home">
                <a class="bread-link bread-home" href="{{ route('index') }}">{{ trans('site.home') }}</a>
            </li>

            <li class="active item-23">
                <span class="bread-current">{{ trans('site.my_orders') }}</span>
            </li>
        </ol>
    </div>

    @livewire('profile-order-view', ['order' => $order])
@endsection

@push("scripts")
    <script>
        window.order_id= "{{$order->id}}";
        window.token = @js($order->user->createToken("site-token")->plainTextToken);

    </script>
    @viteReactRefresh
    @vite(['resources/js/index.jsx'])
@endpush

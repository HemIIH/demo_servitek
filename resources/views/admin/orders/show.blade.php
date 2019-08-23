@extends('admin.orders.partials.order_layout')

@section('tab')
    <div>
        <order-overview :model="{{ $order }}"></order-overview>

        <div class="row">
            <div class="col-md-8">
                <assigned-employees-list :model="{{ $order }}"></assigned-employees-list>
            </div>
            <div class="col-md-4">
                @if (Gate::allows('financials'))
                    <calculations :model="{{ $order }}"></calculations>
                @endif

                <notes :model="{{ $order }}" type="order" can-delete="{{ true }}"></notes>
            </div>
        </div>
    </div>
@endsection
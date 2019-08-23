@extends('layouts.admin')

@section('content')
    <order-table
            source="order"
            :clients="{{ $clients }}"
            can-create="{{ Auth::user()->can('create', \App\Models\Order\Order::class) }}"
            can-update="{{ Auth::user()->can('update', \App\Models\Order\Order::class) }}"
            can-delete="{{ Auth::user()->can('delete', \App\Models\Order\Order::class) }}"
    >
    </order-table>
@endsection
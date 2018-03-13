@extends('layouts.master')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h1>User Profile</h1>
            <hr>
            <h2>My Orders</h2>
            @foreach ($orders as $order)
            <div class="card">
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($order->cart->items as $item)
                        <li class="list-group-item">
                            <span class="badge badge-info"> ${{ $item['price'] }}</span>
                            {{ $item['item']['title'] }} | <strong>{{
                            $item['qty'] }} Units </strong>
                        </li>
                            @endforeach
                    </ul>
                </div>
                <div class="card-footer">
                    <strong>Total Price: ${{ $order->cart->totalPrice }} </strong>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


    @endsection
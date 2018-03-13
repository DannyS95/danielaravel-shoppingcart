@extends('layouts.master')

@section('title')

@endsection

@section('content')
    @if (Session::has('cart'))
        <div class="row mb-2">
            <div class="col-sm-6 col-md-6 mx-auto">
                <ul class="list-group">
                    @foreach($products as $product)
                        <li class="list-group-item">
                            <span class="badge badge-info float-right">{{ $product['qty'] }}</span>
                            <strong>{{ $product['item']['title'] }}</strong>
                            <span class="badge-info     badge">{{ $product['price'] }}</span>
                            <div class="btn-group">
                                &nbsp<button class="btn btn-primary btn-sm dropdown-toggle"
                                        data-toggle="dropdown"> Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('reduce', $product['item']['id']) }}">
                                            &nbspReduce By 1
                                        </a></br>
                                        <a href="{{ route('remove', $product['item']['id']) }}">
                                            &nbspRemove All
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @endforeach
                </ul>
                </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-6 mx-auto">
                <strong>Total: {{ $totalPrice }}$</strong>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-6 col-md-6 mx-auto">
                <a href="{{ route('sendCheckout') }}" type="button" class="btn btn-success">Checkout</a>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <h2>No items in cart!</h2>
            </div>
        </div>
    @endif


    @endsection
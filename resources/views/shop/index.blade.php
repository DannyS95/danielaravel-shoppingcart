@extends('layouts.master')

@section('title')

    @endsection

@section('content')
@foreach ($products->chunk(3) as $productsChunk)
    <div class="container mt-2">
    <div class="row">
        @foreach($productsChunk as $product)
            <div class="col-sm-6 col-md-4">
                <div class="card">
                    <div class="card-body img-center">
                        <div class="thumbnail">
                            <img class="thumbnail" src="{{ $product->imagePath }}">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="caption">
                            <h3>{{ $product->title }}</h3>
                            <p class="description">
                                {{ $product->description }}
                            </p>
                            <div class="clearfix price">$12 <a href="{{ route('add_to_cart',
                            $product->id) }}" class="btn float-right btn-success" role="button">Add
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    </div>
        @endforeach
            <!--
            <div class="col">
                <div class="thumbnail">
                    <img class="thumbnail" src="images/9780575094161.jpg">
                    <div class="caption">
                        <h3>Thumbnail label</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
                            ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                            aliquip ex ea commodo consequat. Duis aute irure dolor in
                            reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                            pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                            culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                        <p><a href="" class="btn
                        btn-success" role="button">Add</a>
                    </div>
                </div>
        </div>
         </div>
-->
    @yield('scripts')
    @endsection
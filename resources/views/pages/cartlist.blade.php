@extends('layouts.master')
@section('content')
    <!-- search result section -->
    <div class="col-8 m-auto bg-white p-3 mt-3">
        <h3 class="border-bottom">Shopping Cart</h2>
        @forelse($data as $key=>$product)
        <div class="border-bottom">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{$product['gallery']}}" class="img-fluid rounded-start" alt="product pic">
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <a href="detail/{{$product['id']}}" class="text-decoration-none underline">
                            <h5 class="card-title">{{$product['name']}}</h5>
                            <p class="card-text">{{$product['description']}}</p>
                        </a>
                        <p class="card-text"><small class="text-danger">৳ {{$product['price']}}</small></p>
                    </div>
                </div>
                <div class="col-md-2">
                    <a class="btn btn-warning mt-3" href="/removeitem/{{$product['cart_id']}}" >Remove Item</a>
                </div>
            </div>
        </div>
        @empty
        <div class="text-danger fs-4 text-center">Soory, No result found!!</div>
        @endforelse
    </div>

@endsection
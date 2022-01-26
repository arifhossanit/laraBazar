@extends('layouts.master')
@section('content')
    <!-- carousel -->
    <div id="carouselExampleCaptions" class="carousel carousel-dark slide carousel-fade" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"></li>
            <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"></li>
        </ol>

        <div class="carousel-inner">
            @foreach($data as $key=>$product)
            <div class="carousel-item {{$key==0?'active':''}}" data-bs-interval="2000">
            <img src="https://images.ctfassets.net/hrltx12pl8hq/7yQR5uJhwEkRfjwMFJ7bUK/dc52a0913e8ff8b5c276177890eb0129/offset_comp_772626-opt.jpg?fit=fill&w=800&h=300" class="d-block w-100 carousel-img" alt="...">
            <div class="carousel-caption">
                <h3>{{$product['name']}}</h3>
                <p>{{$product['description']}}</p>
            </div>
            </div>
            @endforeach
        </div>

        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($data as $key=>$product)
        <div class="col">
            <div class="card h-100">
                <a href="detail/{{$product['id']}}">
                    <img src="{{$product['gallery']}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$product['name']}}</h5>
                        <p class="card-text">{{$product['description']}}</p>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
@endsection
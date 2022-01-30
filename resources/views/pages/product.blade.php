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
    <!-- <section class="container my-5">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($data as $key=>$product)
            <div class="col">
                <div class="card h-100">
                    <a href="detail/{{$product['id']}}" class="text-decoration-none underline">
                        <img src="{{asset('storage/gallery/'.$product['gallery'])}}" class="card-img-top" alt="pic">
                        <div class="card-body">
                            <h5 class="card-title">{{$product['name']}}</h5>
                            <p class="card-text">{{$product['description']}}</p>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </section> -->
    <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach($data as $key=>$product)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                            <!-- Product image-->
                            <img class="card-img-top" src="{{asset('storage/gallery/'.$product['gallery'])}}" alt="pic" />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{$product['name']}}</h5>
                                    <!-- Product price-->
                                    {{$product['price']}}
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="detail/{{$product['id']}}">View</a></div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </section>
@endsection
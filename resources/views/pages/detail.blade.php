@extends('layouts.master')
@section('content')
<!-- Product-page -->
  <Div class="row my-4 container">
      <div class="col-12 col-md-6 bg-light">
          <img src="{{$product->gallery}}" alt="Product image" class="card-img"> 
      </div>
      <div class="col-12 col-md-6 bg-light">
          <h4>{{$product->name}}</h4> 
          <div class="ratings text-warning">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star-half-alt"></i>
              <i class="fa fa-star-o"></i>
              (2)
          </div>
          <p><b>Brand: </b> Sony</p>
          <p><b>Category: </b> {{$product->category}}</p>
          <p><b>Price: </b>৳ {{$product->price}}</p>
          <p>
              <b><label for="qu">Quantity: </label> </b> 
              <input type="text" value="1" id="qu" class="form-control-sm text-center" > 
              <button href="#" class="btn btn-primary" type="button" id="button-addon1" >Add To Cart</button>
        </p> 
      </div>
      <div class="col-12 bg-light mt-3">
          <div class="p-3 details-2 ">
              <h4 class="fw-bold">Product Details</h3>
              <p>{{$product->description}}</p>
          </div>
      </div>
  </Div>

@endsection
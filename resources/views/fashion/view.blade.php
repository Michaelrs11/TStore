@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-4">
            <img class="card-img-top" src="{{asset('storage/img/'. $showData->image)}}">
        </div>

        <div class="col-lg-8">
            <div class="container">
                <div class="row">
                    <div class=col-lg-12>
                        <h3>Product Detail</h3>
                        Name: {{$showData->name}} <br>
                        Stock: {{$showData->stock}} <br>
                        Price: {{$showData->price}} <br>
                        Store: {{$showData->store->name}} <br>
                        Description: {{$showData->description}} <br>
                    </div>

                    <div class="col-lg-12"> <br> <br>
                    
                    <h3>Add to Cart</h3>
                    
                    <form action="{{route('cart.store')}}" method="POST">
                        @csrf
                        <input type="hidden" value="{{$showData->id}}" name="fashion_id">
                        <input type="number" name="quantity" min=1 max="{{$showData->stock}}">

                        @if($showData->store->user_id == auth()->user()->id)
                            <button class="btn btn-primary btn-disable">You can't add your own item</button>
                        @elseif(!$already_add_to_cart)
                            <button class="btn btn-primary" type="submit">Add</button>
                        @else   
                            <button class="btn btn-primary btn-disable">Item is already in cart</button>
                        @endif
                    </form>
                    
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
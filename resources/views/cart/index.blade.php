@extends('layouts.app')

@section('content')
<!-- tampilan cart -->
<div class="container">
    <div class="row justify-content-center">

    @foreach($cartData as $datas)
        <div class="col-lg-4">
            <img class="card-img-top" src="{{asset('storage/img/'. $datas->fashion->image)}}">
        </div>
        <div class="col-md-2">
           <b>{{$datas->fashion->name}}</b> 
        </div>
        <div class="col-md-2">
           <b>{{$datas->fashion->store->name}}</b> 
        </div>
        <div class="col-md-2">
           Rp. {{number_format($datas->fashion->price,0,'',',')}} x {{$datas->quantity}}
           <br> = Rp.  {{number_format($datas->fashion->price * $datas->quantity,0,'','.')}}
        </div>

     @endforeach
        <form action="{{route('transaction.store')}}" method="Post">
            @csrf
            <button class="btn btn-primary"> Check Out</button>
        </form>
    </div>
</div>
@endsection
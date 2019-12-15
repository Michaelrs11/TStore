@extends('layouts.app')

@section('content')
<!-- tampilan utama store -->
<div class="container">
    <div class="row">
            @if(!$storeData)
                You don't have a store yet!
                <a href="{{route('store.create')}}">&nbsp;Create your Store. </a>
            @else

                <div class="col-md-1">
                    @if($storeData->image)
                    <img class="storeImage" src="{{asset('storage/img/'.$storeData->image)}}">
                    @endif
                <hr>
                </div>
                <div class="col-md-11">
                    Welcome, {{$storeData->name}}! <a href="{{route('fashion.create')}}">&nbsp;Add Clothes </a>
                    <a href="{{route('store.edit', ['id' => $storeData->id])}}" class="float-left">
                            <button type="button" class="btn btn-primary btn-sm">Edit</button>
                        </a>
                        <form action="{{ route('store.destroy', ['id' => $storeData->id]) }}" method="POST" class="float-left">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                </div>

                <hr>
                
                @foreach($fashionData as $fashion)
                <div class="col-md-2">
                    @if($fashion->image)
                        <a href=""> <img class="card-img-top" src="{{asset('storage/img/'.$fashion->image)}}"> </a> 
                    @endif
                    
                    {{$fashion->name}}<br> {{$fashion->stock}}
                    <br> Rp. {{number_format($fashion->price,0,'','.')}} <br>
                    <a href="{{route('fashion.edit', ['id' => $fashion->id])}}" class="float-left">
                            <button type="button" class="btn btn-primary btn-sm">Edit</button>
                        </a>
                        <form action="{{ route('fashion.destroy', ['id' => $fashion->id]) }}" method="POST" class="float-left">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                </div>
                @endforeach
                <div class="paginate">
                    {{$fashionData->links()}}
                </div>
            @endif
    </div>
</div>
@endsection
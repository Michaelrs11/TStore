@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            {{-- <h4> Our {{{ $category_name[0] }}} collection.</h4> --}}
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <form method="GET">
                <input value="{{isset($_GET['search']) ? $_GET['search'] : '' }}" type="text" name="search" placeholder="Search by name or store"> <button type="submit">Search</button>
            </form>
        </div>
    </div>
    <div class="row justify-content-center">

        @foreach($fashionData as $datas)

        <div class="col-lg-4 mt-3"> 
            <div>
                <a href="{{route('fashion.view', ['id' => $datas->id])}}"> <img class="card-img-top" src="{{asset('storage/img/'.$datas->image)}}"> </a>
                <br> 
                <p class="lead mt-2">name: {{$datas->name}} </p>
                <p class="lead mt-2">store: {{$datas->store->name}} </p>
                <p class="lead mt-2">price {{number_format($datas->price,0,'','.')}} </p>
                @hasrole('admin')
                        <a href="{{route('category.edit', ['id' => $datas->id])}}" class="float-left">
                            <button type="button" class="btn btn-primary btn-sm">Edit</button>
                        </a>
                        <form action="{{ route('category.destroy', ['id' => $datas->id]) }}" method="POST" class="float-left">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                @endhasrole
            </div>
        </div>
        @endforeach


    </div>
</div>
@endsection
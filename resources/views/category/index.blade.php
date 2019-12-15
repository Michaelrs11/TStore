@extends('layouts.app')

@section('content')
<!-- tampilan utama category -->
<div class="container">
    
    @hasrole('admin')
    <a href="{{route('category.create')}}"> Add new category</a>
    @endhasrole
    <div class="row justify-content-center">
        
        @foreach($categoriesData as $datas)

        <div class="col-lg-2 mt-3"> 
            <div>
                <a href="{{route('fashion.group', ['name' => $datas->name])}}"> 
                @if($datas->image)
                <div class="col-md-12">
                    <img class="card-img-top" src="{{asset('storage/img/'.$datas->image)}}"> 
                    </a>
                </div>
                
                @endif
                <br> 
                <p class="lead mt-2"> {{$datas->name}} </p>
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
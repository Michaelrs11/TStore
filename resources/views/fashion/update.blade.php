@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Clothing</div>

                <div class="card-body">

                         @if ($errors->any())
                          <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                <li> {{ $error }} </li>
                                @endforeach
                          </div>
                        @endif

                        <form action="{{ route('fashion.update', ['id' => $showData->id]) }}" method="POST" enctype="multipart/form-data">

                            @csrf 

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$showData->name}}">
                            </div>

                            <div class="form-group">
                            <label>Category</label>
                                <select class="form-control" name="category_id">
                                    <option value="default">--Category--</option>
                                  @foreach($category as $categories)
                                    <option value="{{$categories->id}}"> {{$categories->name}} </option>
                                  @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" min="20000" class="form-control @error('name') is-invalid @enderror" name="price" value="{{$showData->price}}" required>
                            </div>

                            <div class="form-group">
                                <label>Stock</label>
                                <input type="number" min="1" class="form-control @error('name') is-invalid @enderror" name="stock" value="{{$showData->stock}}">
                            </div>


                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="description" value="{{$showData->description}}">
                            </div>

                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" class="form-control-file" name="image">
                            </div>

                            <input type="hidden" name="store_id" value="{{$store->id}}">

                            <button type="submit" class="btn btn-primary">Submit</button>

                        </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
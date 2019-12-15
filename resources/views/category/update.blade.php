@extends('layouts.app')

@section('content')
<!-- update category -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit a Category</div>

                <div class="card-body">

                         @if ($errors->any())
                          <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                <li> {{ $error }} </li>
                                @endforeach
                          </div>
                        @endif

                        <form action="{{ route('category.update', ['id' => $editData->id]) }}" method="POST" enctype="multipart/form-data">

                            @csrf 
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$editData->name}}">
                            </div>

                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" class="form-control-file" name="image">
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>

                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
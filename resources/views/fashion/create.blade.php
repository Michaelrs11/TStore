@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Product</div>

                <div class="card-body">

                         @if ($errors->any())
                          <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                <li> {{ $error }} </li>
                                @endforeach
                          </div>
                        @endif

                        <form action="{{ route('fashion.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf 

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="category_id">
                                    <option value="default">--Category--</option>
                                    @foreach($category as $categories)
                                        <option value="{{$categories->id}}"> {{$categories->name}} </option>
                                    @endforeach
                                    </select>
                                </div>
                        </div>

                            <div class="form-group row">
                                <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>
                                <div class="col-md-6">
                                    <input type="number" min="20000" class="form-control @error('price') is-invalid @enderror" name="price" value="{{old('price')}}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="stock" class="col-md-4 col-form-label text-md-right">{{ __('Stock') }}</label>
                                <div class="col-md-6">
                                    <input type="number" min="1" class="form-control @error('name') is-invalid @enderror" name="stock" value="{{old('stock')}}">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                                <div class="col-md-6">
                                <textarea id="description" name="description" class="form-control" placeholder="Description" row="3">
                                
                               </textarea>
                               </div>
                            </div>

                            <div class="form-group row">
                                <label for="Image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>
                                <div class="col-md-6">
                                    <input type="file" class="form-control-file" name="image">
                                </div>
                            </div>

                            <input type="hidden" name="store_id" value="{{$store->id}}">

                            <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add Product') }}
                                </button>
                            </div>
                        </div>
                        </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
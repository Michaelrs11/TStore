@extends('layouts.app')

@section('content')
<!-- create store -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create your Store</div>

                <div class="card-body">

                         @if ($errors->any())
                          <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                <li> {{ $error }} </li>
                                @endforeach
                          </div>
                        @endif

                        <form action="{{ route('store.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf 

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            </div>
                        </div>

                            <!-- Address -->
                          <div class="form-group row">
                             <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                             <div class="col-md-6">
                               <textarea id="address" name="address" class="form-control" placeholder="Address" row="3">
                                
                               </textarea>
                            </div>
                        </div>

                            <!-- Description -->
                          <div class="form-group row">
                             <label for="dedescriptionsc" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                             <div class="col-md-6">
                               <textarea id="description" name="description" class="form-control" placeholder="Description" row="3">
                                
                               </textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                             <label for="Image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>
                             <div class="col-md-6">
                               <input type="file" name="image" id="image" class="form-control-file">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
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
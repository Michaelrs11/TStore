@extends('layouts.app')

@section('content')
<!-- buat edit profile -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Profile') }}</div>
                {{-- {{$editData}} --}}
                <div class="card-body">
                     @if ($errors->any())
                          <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                <li> {{ $error }} </li>
                                @endforeach
                          </div>
                        @endif
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{$editData->name}}" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{$editData->email}}" required autocomplete="email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="old_password" class="col-md-4 col-form-label text-md-right">{{ __('Old Password') }}</label>

                            <div class="col-md-6">
                                <input id="old_password" type="password" value="{{ old('password') }}" class="form-control" name="old_password" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" value="{{ old('password') }}" class="form-control" name="password" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" value="{{ old('password') }}" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>  

                        <div class="form-group row">
                             <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
                             <div class="col-md-6">
                                <!-- disini akan ditampilkan gender saat user pertama kali register -->
                                <input type="radio" name="gender" value="male" {{$editData->gender == 'male' ? 'checked' : ''}}> Male<br>
                                <input type="radio" name="gender" value="female" {{$editData->gender == 'female' ? 'checked' : ''}}> Female
                                <br>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                                
                            <div class="col-md-6">
                                <textarea class="form-control" name="address" rows="3">{{$editData->address}}</textarea>
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
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

@extends('layouts.app')

@section('content')
<!-- edit rolenya -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Manage {{ $user->name }}</div>
                <div class="card-body">
                     @if ($errors->any())
                          <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                <li> {{ $error }} </li>
                                @endforeach
                          </div>
                        @endif

                    <form action="{{ route('admin.users.update', ['user' => $user->id]) }} " method="POST">
                        @csrf
                        {{ method_field('PUT') }}
                        @foreach($roles as $role)
                            <div class="form-check">
                                
                                <input type="checkbox" name="roles[]" value="{{ $role->id }}" {{ $user->hasAnyRole($role->name) ? 'checked' : '' }}>
                                    <label>{{ $role->name }}</label>
                            </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-8 mx-auto">
        <div class="card">
          <div class="card-header">
            <span>Edit password {{ $user->name }}</span>
          </div>
          <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" method="post">
              @method('PUT')
              @csrf

              <div class="form-group">
                <label for="password">Password @error('password') <small>{{ $message }}</small> @enderror</label>
                <input
                  type="password"
                  name="password"
                  value="{{ old('password')}}"
                  class="@error('password') is-invalid @enderror form-control">
              </div>

              <div class="form-group">
                <label for="current_password">Current Password @error('current_password') <small>{{ $message }}</small> @enderror</label>
                <input
                  type="password"
                  name="current_password"
                  value="{{ old('current_password')}}"
                  class="@error('current_password') is-invalid @enderror form-control">
              </div>

              <div class="form-group d-flex justify-content-between">
                <button type="submit" class="btn btn-sm btn-primary mx-1">
                  Update Password
                </button>

                <a href="{{ route('roles.index') }}" class="btn btn-sm btn-danger">
                  Back
                </a>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

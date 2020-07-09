@extends('layouts.app')

@section('content')
  <div class="container-lg">
    <div class="row">
      <div class="col-8 mx-auto">
        <div class="card">
          <div class="card-header">
            <span>Users Management</span>
          </div>
          <div class="card-body">
            <table class="table table-borderless text-center">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                  @if (!$user->hasRole('admin'))
                    <tr>
                      <td>{{ $user->id }}</td>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
                      <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-info">
                          <i class="fa fa-key"></i>
                        </a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                          @method('DELETE')
                          @csrf

                          <button class="btn btn-sm btn-danger">
                            <i class="fa fa-trash"></i>
                          </button>
                        </form>
                      </td>
                    </tr>
                  @endif
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-8 mx-auto">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <span>Roles Management</span>
          @role('admin')
            <a
              href="#changePermission"
              data-target="#changePermission"
              data-toggle="modal"
              data-title="Change a Permission Structure"
              data-remote="{{ route('roles.permission') }}"
              >Change a Permission Structure</a>
          @endrole
        </div>
        <div class="card-body">
          <table class="table table-borderless text-center">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Role</th>
                <th>Permission</th>
                @role('admin')
                <th>Action</th>
                @endrole
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
                @if (!$user->hasRole('admin'))
                  <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->roles()->pluck('name')->implode('') }}</td>
                    <td>{{ implode(', ', $user->getPermissionsViaRoles()->pluck('name')->toArray()) }}</td>
                    @role('admin')
                      <td class="text-center">
                        @if (!$user->hasRole('admin'))
                          <a
                            href="#editRole"
                            data-target="#editRole"
                            data-toggle="modal"
                            data-title="Edit user {{ $user->name }}"
                            data-remote="{{ route('roles.edit', $user->id) }}"
                            class="btn btn-sm btn-primary">
                            <i class="fa fa-pencil"></i>
                          </a>

                          <form action="{{ route('users.destroy', $user->id) }}" class="d-inline" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm">
                              <i class="fa fa-trash"></i>
                            </button>
                          </form>
                        @else
                          <span class="text-danger">Admin</span>
                        @endif
                      </td>
                    @endrole
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

{{-- Modal --}}
<div id="editRole" class="modal" tabindex="-1" role="dialog">
  <div class="modal-sm modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="role-edit-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="role-edit-body mx-auto p-1">
        <h4 class="p-4">
          <i class="fa fa-spin fa-spinner"></i>
        </h4>
      </div>
    </div>
  </div>
</div>

{{-- Modal --}}
<div id="changePermission" class="modal" tabindex="-1" role="dialog">
  <div class="modal-static modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="role-permission-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="role-permission-body mx-auto p-1 mt-2">
        <h4 class="p-4">
          <i class="fa fa-spin fa-spinner"></i>
        </h4>
      </div>
    </div>
  </div>
</div>
@endsection

@push('after.script')
<script>
  jQuery(document).ready(function($) {

    $('#editRole').on('shown.bs.modal', function(e) {

      const btn = $(e.relatedTarget);
      const modal = $(this);

      modal.find('.role-edit-title').html(btn.data('title'));
      modal.find('.role-edit-body').load(btn.data('remote'));

    });

    $('#changePermission').on('shown.bs.modal', function(e) {

      const btn = $(e.relatedTarget);
      const modal = $(this);

      modal.find('.role-permission-title').html(btn.data('title'));
      modal.find('.role-permission-body').load(btn.data('remote'));

    });

  });
</script>
@endpush

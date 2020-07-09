<form action="{{ route('roles.permission.update') }}" method="POST">
  @method('POST')
  @csrf

  <div class="form-group">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>Roles</th>
          <td>Write</td>
          <td>Edit</td>
          <td>Publish</td>
      </thead>
      <tbody>
        @foreach ($roles as $i => $role)
        <tr>
          <td>{{ $role->id }}</td>
          <td>{{ $role->name }}</td>
          <td>
            <input type="checkbox" name="write-{{ $i }}" value="{{ 'write post' }}" @if ($role->hasPermissionTo('write post')) checked @endif>
          </td>
          <td>
            <input type="checkbox" name="edit-{{ $i }}" value="{{ 'edit post' }}" @if ($role->hasPermissionTo('edit post')) checked @endif>
          </td>
          <td>
            <input type="checkbox" name="publish-{{ $i }}" value="{{ 'publish post' }}" @if ($role->hasPermissionTo('publish post')) checked @endif>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="form-group">
    <button class="btn btn-primary btn-sm" type="submit">
      Change
    </button>
  </div>
</form>

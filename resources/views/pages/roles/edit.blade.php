<form action="{{ route('roles.update', $user->id) }}" method="post">
  @csrf
  @method('PUT')


  <div class="form-group">
    <label for="role_id">Role
      @error('role_id') <small>{{ $message }}</small> @enderror
    </label>
    <select name="role_id" class="form-control">
      @foreach ($roles as $role)
        <option value="{{ $role->id }}">
          {{ $role->name }}
        </option>
      @endforeach
    </select>
  </div>

  <div class="form-group">
    <button class="btn btn-sm btn-primary form-control">
      Button
    </button>
  </div>
</form>

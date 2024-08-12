@extends('adminlte::page')

@section('preloader')
    <i class="fas fa-4x fa-spin fa-spinner text-secondary"></i>
    <h4 class="mt-4 text-dark">Loading</h4>
@stop
@section('content')
<br>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Edit Role</h2>
                    <div class="card-tools">
                        <a href="{{ route('roles.index') }}" class="btn btn-primary btn-sm">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" value="{{ $role->name }}" name="name" class="form-control" placeholder="Enter role name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Permissions:</label>
                            <div class="row">
                            @foreach ($permissions as $perm)
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $perm->id }}" {{ in_array($perm->id, $rolePermissions) ? 'checked' : '' }}>
                                        <label class="form-check-label">
                                            {{ $perm->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach

                            </div>
                        </div>
                        <!-- <div class="mb-3">
                            <label class="form-label">Permissions</label>
                            <div class="row">
                                @forelse ($permissions as $permission)
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="permission_{{ $permission->id }}" {{ in_array($permission->id, old('permissions') ?? []) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="permission_{{ $permission->id }}">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    </div>
                                @empty
                                    <span>No permissions available</span>
                                @endforelse
                                @error('permissions')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> -->
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('adminlte::page')

@section('preloader')
    <i class="fas fa-4x fa-spin fa-spinner text-secondary"></i>
    <h4 class="mt-4 text-dark">Loading</h4>
@stop
@section('content')
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Users Management</h3>
                    <div class="card-tools">
                        @can('user-create')
                        <a href="{{ route('users.create') }}" class="btn btn-success btn-sm rounded-pill">
                            Add User <i class="fas fa-plus-circle"></i>
                        </a>
                        @endcan
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">{{ $message }}</div>
                    @endif
                    <table id="users-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Roles</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                    <i class="fa {{ $user->last_seen >= now()->subMinutes(2) ? 'fa-circle text-success' : 'fa-circle text-secondary' }}" style="font-size: 8px;"></i>
                                    {{ $user->last_seen >= now()->subMinutes(2) ? 'Online' : 'Offline'}}
                                </td>

                                    <td>
                                        @forelse($user->getRoleNames() as $role)
                                            <span class="badge badge-success">{{ $role }}</span>
                                        @empty
                                            <span class="badge badge-secondary">No roles assigned</span>
                                        @endforelse
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('users.show',$user->id) }}"><i class="fas fa-eye"></i>&nbsp;Preview</a>
                                                @can('user-edit')
                                                    <a class="dropdown-item" href="{{ route('users.edit',$user->id) }}"><i class="fas fa-edit"></i>&nbsp;Edit</a>
                                                @endcan
                                                @can('user-delete')
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this user?')"><i class="fas fa-trash"></i>&nbsp;Delete</button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col-md-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('#users-table').DataTable();
    });
</script>
@endsection
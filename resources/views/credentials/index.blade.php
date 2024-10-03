@extends('layouts.app')

@section('content')
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Credentials Accountability List</h3>
                    <div class="card-tools">
                        @can('credential-create')
                        <a href="{{ route('credentials.create') }}" class="btn btn-success btn-sm rounded-pill">
                            Add credential <i class="fas fa-plus-circle"></i>
                        </a>
                        @endcan
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">{{ $message }}</div>
                    @endif
                    <table id="credentials-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Employee Name</th>
                                <th>Company Number</th>
                                <th>Company Email</th>
                                <th>Email Password</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($credentials as $credential)
                                <tr>
                                    <td>{{ $credential->employee->company_id }} {{ $credential->employee->last_name }} {{ $credential->employee->first_name }}, {{ $credential->employee->middle_name ?? ' ' }} {{ $credential->employee->suffix ?? ' ' }}</td>
                                    <td>{{ $credential->company_number ?? ' '}}</td>
                                    <td>{{ $credential->company_email ?? ' '}}</td>
                                    <td>{{ $credential->email_password ?? ' '}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                @can('credential-edit')
                                                    <a class="dropdown-item" href="{{ route('credentials.edit',$credential->id) }}"><i class="fas fa-edit"></i>&nbsp;Edit</a>
                                                @endcan
                                                @can('credential-delete')
                                                    <form action="{{ route('credentials.destroy', $credential->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this credential?')"><i class="fas fa-trash"></i>&nbsp;Delete</button>
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
        $('#credentials-table').DataTable();
    });
</script>
@endsection

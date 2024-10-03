@extends('layouts.app')

@section('content')
<br>
<div class="container-fluid">
        <!-- Enhanced professional-looking link buttons -->
<div class="mb-4">
    <div class="contribution-nav" role="navigation" aria-label="Contribution Types">
        <a href="{{ route('payroll.index') }}" class="contribution-link {{ request()->routeIs('payroll.index') ? 'active' : '' }}">
            <div class="icon-wrapper">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <div class="text-wrapper">
                <span class="title">Payroll</span>
                <small class="description">Payroll List</small>
            </div>
        </a>
        @can('payroll-create')
        <a href="{{ route('payroll.create') }}" class="contribution-link {{ request()->routeIs('payroll.create') ? 'active' : '' }}">
            <div class="icon-wrapper">
                <i class="fas fa-plus"></i>
            </div>
            <div class="text-wrapper">
                <span class="title">Create Payroll</span>
                <small class="description">Generate Payroll</small>
            </div>
        </a>
        @endcan
        <a href="{{ route('overtime.index') }}" class="contribution-link {{ request()->routeIs('overtime.index') ? 'active' : '' }}">
            <div class="icon-wrapper">
                <i class="fas fa-clock"></i>
            </div>
            <div class="text-wrapper">
                <span class="title">Overtime</span>
                <small class="description">Employee overtime records</small>
            </div>
        </a>
    </div>
</div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Overtime List</h3>
                    <div class="card-tools">
                        @can('overtime-create')
                        <a href="{{ route('overtime.create') }}" class="btn btn-success btn-sm rounded-pill">
                            Add overtime <i class="fas fa-plus-circle"></i>
                        </a>
                        @endcan
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">{{ $message }}</div>
                    @endif
                    <table id="overtime-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Overtime Hour</th>
                                <th>Overtime Rate</th>
                                <th>Overtime Pay</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($overtime as $overtime)
                                <tr>
                                    <td>{{ $overtime->employee->company_id }} {{ $overtime->employee->last_name }} {{ $overtime->employee->first_name }} {{ $overtime->employee->middle_name ?? ' ' }} {{ $overtime->employee->suffix ?? ' ' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($overtime->date)->format('F j, Y') }}</td>
                                    <td>{{ $overtime->overtime_hours }}</td>
                                    <td>{{ $overtime->overtime_rate }}</td>
                                    <td>{{ number_format($overtime->overtime_pay, 2) }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                {{-- @can('overtime-edit')
                                                    <a class="dropdown-item" href="{{ route('overtime.edit',$overtime->id) }}"><i class="fas fa-edit"></i>&nbsp;Edit</a>
                                                @endcan --}}
                                                @can('overtime-delete')
                                                    <form action="{{ route('overtime.destroy', $overtime->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this overtime?')"><i class="fas fa-trash"></i>&nbsp;Delete</button>
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
        $('#overtime-table').DataTable();
    });
</script>
@endsection

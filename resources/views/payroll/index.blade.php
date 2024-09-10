@extends('adminlte::page')

@section('preloader')
<div id="loader" class="loader">
    <div class="loader-content">
        <div class="wave-loader">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <h4 class="mt-4 text-dark">Loading...</h4>
    </div>
</div>
<style>
    /* Loader */
.loader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.9);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
    transition: opacity 0.5s ease-out;
}

.loader-content {
    text-align: center;
}

/* Wave Loader */
.wave-loader {
    display: flex;
    justify-content: center;
    align-items: flex-end;
    height: 50px;
}

.wave-loader > div {
    width: 10px;
    height: 50px;
    margin: 0 5px;
    background-color: #8e44ad; /* Purple color */
    animation: wave 1s ease-in-out infinite;
}

.wave-loader > div:nth-child(2) {
    animation-delay: -0.9s;
}

.wave-loader > div:nth-child(3) {
    animation-delay: -0.8s;
}

.wave-loader > div:nth-child(4) {
    animation-delay: -0.7s;
}

.wave-loader > div:nth-child(5) {
    animation-delay: -0.6s;
}

@keyframes wave {
    0%, 100% {
        transform: scaleY(0.5);
    }
    50% {
        transform: scaleY(1);
    }
}
</style>
@stop
@section('content')
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Payroll Records</h3>
                    <div class="card-tools">
                        <a href="{{ route('payroll.create') }}" class="btn btn-success btn-sm rounded-pill">
                            Create Payroll <i class="fas fa-plus-circle"></i>
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">{{ $message }}</div>
                    @endif
                    <table id="payroll-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Employee Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Gross Salary</th>
                                <th>Net Salary</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payrolls as $payroll)
                            <tr>
                                <td>{{ $payroll->id }}</td>
                                <td>{{ $payroll->employee->first_name }} {{ $payroll->employee->last_name }}</td>
                                <td>{{ \Carbon\Carbon::parse($payroll->start_date)->format('F j, Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($payroll->end_date)->format('F j, Y') }}</td>
                                <td>{{ number_format($payroll->gross_salary, 2) }}</td>
                                <td>{{ number_format($payroll->net_salary, 2) }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('payroll.show', ['id' => $payroll->id]) }}">
                                                <i class="fas fa-eye"></i>&nbsp;View
                                            </a>
                                            @can('payroll-delete')
                                            <form action="{{ route('payroll.destroy', $payroll->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this payroll?')"><i class="fas fa-trash"></i>&nbsp;Delete</button>
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
        $('#payroll-table').DataTable();
    });
</script>
@endsection

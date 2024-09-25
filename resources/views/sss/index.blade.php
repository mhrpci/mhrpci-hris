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

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Sss Contributions List</h3>
        <div class="card-tools">
            <a href="{{ route('sss.create') }}" class="btn btn-success btn-sm rounded-pill">
                Add Sss Contribution <i class="fas fa-plus-circle"></i>
            </a>
        </div>
    </div>
    <div class="card-body">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
    @endif
        <table id="sss-table" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Employee</th>
                <th>Contribution Date</th>
                <th>Monthly Salary Credit</th>
                <th>Total Contribution</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contributions as $contribution)
                <tr>
                    <td>{{ $contribution->employee->company_id }} {{ $contribution->employee->last_name }} {{ $contribution->employee->first_name }}, {{ $contribution->employee->middle_name ?? ' ' }} {{ $contribution->employee->suffix ?? ' ' }}</td>
                    <td>{{ $contribution->contribution_date->format('F j, Y') }}</td>
                    <td>{{ number_format($contribution->monthly_salary_credit, 2) }}</td>
                    <td>{{ number_format($contribution->total_contribution, 2) }}</td>
                    <td>
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ route('sss.show', $contribution) }}"><i class="fas fa-eye"></i>&nbsp;Preview</a>
                                    @if(auth()->user()->hasRole('Super Admin'))
                                        <form action="{{ route('sss.destroy', $contribution->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this sss?')"><i class="fas fa-trash"></i>&nbsp;Delete</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@stop
@section('js')
<script>
    $(document).ready(function () {
        $('#sss-table').DataTable();
    });
</script>
@endsection

<!-- employee_leaves.blade.php -->

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
    <div class="container">
        <h1>{{ $employee->company_id }}'s Leaves</h1>
        <table class="table table-bordered" id="employee-leaves-table">
            <thead>
                <tr>
                    <th>Date From</th>
                    <th>Date To</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($leaves as $leave)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($leave->date_from)->format('F j, Y g:iA') }}</td>
                    <td>{{ \Carbon\Carbon::parse($leave->date_to)->format('F j, Y g:iA') }}</td>
                    <td>{{ $leave->type->name }}</td>
                    <td>
                        @if ($leave->status == 'approved')
                            <span class="text-success">
                                <i class="fas fa-check-circle"></i> Approved
                            </span>
                        @elseif ($leave->status == 'rejected')
                            <span class="text-danger">
                                <i class="fas fa-times-circle"></i> Rejected
                            </span>
                        @else
                            <span class="text-warning">
                                <i class="fas fa-clock"></i> Pending
                            </span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('leaves.destroy', $leave->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this leave request?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#employee-leaves-table').DataTable();
        });
    </script>
@endsection

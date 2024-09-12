@extends('adminlte::page')

@section('title', 'Contribution List')

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
                        <h3 class="card-title">Contribution List</h3>
                        <div class="card-tools">
                            @can('contribution-create')
                            <a href="{{ route('contributions.create') }}" class="btn btn-success btn-sm rounded-pill">
                                Add contributions <i class="fas fa-plus-circle"></i>
                            </a>
                            @endcan
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">{{ $message }}</div>
                        @endif
                        <table id="contributions-table" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>SSS</th>
                                    <th>PAGIBIG</th>
                                    <th>PHILHEALTH</th>
                                    <th>TIN</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contributions as $contribution)
                                <tr>
                                    <td>{{ $contribution->employee->company_id }} {{ $contribution->employee->last_name }} {{ $contribution->employee->first_name }}, {{ $contribution->employee->middle_name ?? ' ' }} {{ $contribution->employee->suffix ?? ' ' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($contribution->date)->format('F j, Y') }}</td>
                                    <td>&#8369;{{  number_format($contribution->sss_contribution, 2)}}</td>
                                    <td>&#8369;{{  number_format($contribution->pagibig_contribution, 2)}}</td>
                                    <td>&#8369;{{  number_format($contribution->philhealth_contribution, 2)}}</td>
                                    <td>&#8369;{{  number_format($contribution->tin_contribution, 2)}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{ route('contributions.show', $contribution->id) }}"><i class="fas fa-eye"></i>&nbsp;Preview</a>
                                                @can('contribution-edit')
                                                    <a class="dropdown-item" href="{{ route('contributions.edit', $contribution->id) }}"><i class="fas fa-edit"></i>&nbsp;Edit</a>
                                                @endcan
                                                @can('contribution-delete')
                                                    <form action="{{ route('contributions.destroy', $contribution->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this contribution?')"><i class="fas fa-trash"></i>&nbsp;Delete</button>
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
            $('#contributions-table').DataTable();
        });
    </script>
@endsection
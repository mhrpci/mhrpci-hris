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
                        <h3 class="card-title">Pagibig Loan</h3>
                        <div class="card-tools">
                            @can('loanpagibig-create')
                            <a href="{{ route('loanpagibig.create') }}" class="btn btn-success btn-sm rounded-pill">
                            Add PAGIBIG Loan <i class="fas fa-plus-circle"></i>
                        </a>
                            @endcan
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">{{ $message }}</div>
                        @endif
                        <table id="loanpagibig-table" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($loanpagibig as $loanpagibig)
                                    <tr>
                                        <td>{{ $loanpagibig->employee->company_id }} {{ $loanpagibig->employee->last_name }} {{ $loanpagibig->employee->first_name }}, {{ $loanpagibig->employee->middle_name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($loanpagibig->date_repayment)->format('F j, Y') }}</td>
                                        <td>&#8369;{{ number_format($loanpagibig->pagibig_loan, 2) }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{ route('loanpagibig.show', $loanpagibig->id) }}"><i class="fas fa-eye"></i>&nbsp;Preview</a>
                                                    @can('loanpagibig-edit')
                                                        <a class="dropdown-item" href="{{ route('loanpagibig.edit', $loanpagibig->id) }}"><i class="fas fa-edit"></i>&nbsp;Edit</a>
                                                    @endcan
                                                    @can('loanpagibig-delete')
                                                        <form action="{{ route('loanpagibig.destroy', $loanpagibig->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this SSS loan?')"><i class="fas fa-trash"></i>&nbsp;Delete</button>
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
            $('#loanpagibig-table').DataTable();
        });
    </script>
@endsection

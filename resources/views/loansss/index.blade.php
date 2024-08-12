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
                        <h3 class="card-title">SSS Loan</h3>
                        <div class="card-tools">
                            @can('loansss-create')
                            <a href="{{ route('loansss.create') }}" class="btn btn-success btn-sm rounded-pill">
                            Add SSS Loan <i class="fas fa-plus-circle"></i>
                        </a>
                            @endcan
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">{{ $message }}</div>
                        @endif
                        <table id="loansss-table" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($loansss as $loansss)
                                    <tr>
                                        <td>{{ $loansss->employee->company_id }} {{ $loansss->employee->last_name }} {{ $loansss->employee->first_name }}, {{ $loansss->employee->middle_name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($loansss->date_repayment)->format('F j, Y') }}</td>
                                        <td>&#8369;{{ number_format($loansss->sss_loan, 2) }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{ route('loansss.show', $loansss->id) }}"><i class="fas fa-eye"></i>&nbsp;Preview</a>
                                                    @can('loansss-edit')
                                                        <a class="dropdown-item" href="{{ route('loansss.edit', $loansss->id) }}"><i class="fas fa-edit"></i>&nbsp;Edit</a>
                                                    @endcan
                                                    @can('loansss-delete')
                                                        <form action="{{ route('loansss.destroy', $loansss->id) }}" method="POST">
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
            $('#loansss-table').DataTable();
        });
    </script>
@endsection

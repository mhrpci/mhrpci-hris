@extends('layouts.app')

@section('content')
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Loan List</h3>
                        <div class="card-tools">
                            @can('loans-create')
                            <a href="{{ route('loans.create') }}" class="btn btn-success btn-sm rounded-pill">
                                Add loans <i class="fas fa-plus-circle"></i>
                            </a>
                            @endcan
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">{{ $message }}</div>
                        @endif
                        <div class="table-responsive">
                            <table id="loans-table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>SSS</th>
                                        <th>PAGIBIG</th>
                                        <th>CASH ADVANCE</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($loans as $loan)
                                    <tr>
                                        <td>{{ $loan->employee->company_id }}  {{ $loan->employee->last_name }} {{ $loan->employee->first_name }}, {{ $loan->employee->middle_name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($loan->date)->format('F j, Y') }}</td>
                                        <td>&#8369;{{  number_format($loan->sss_loan, 2)}}</td>
                                        <td>&#8369;{{  number_format($loan->pagibig_loan, 2)}}</td>
                                        <td>&#8369;{{  number_format($loan->cash_advance, 2)}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{ route('loans.show', $loan->id) }}"><i class="fas fa-eye"></i>&nbsp;Preview</a>
                                                    @can('loans-edit')
                                                        <a class="dropdown-item" href="{{ route('loans.edit', $loan->id) }}"><i class="fas fa-edit"></i>&nbsp;Edit</a>
                                                    @endcan
                                                    @can('loans-delete')
                                                        <form action="{{ route('loans.destroy', $loan->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this loan?')"><i class="fas fa-trash"></i>&nbsp;Delete</button>
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
            $('#loans-table').DataTable({
                responsive: true,
                scrollX: true,
                autoWidth: false,
                columnDefs: [
                    { responsivePriority: 1, targets: 0 }, // Name
                    { responsivePriority: 2, targets: -1 }, // Action
                    { responsivePriority: 3, targets: 1 }, // Date
                ]
            });
        });
    </script>
@endsection

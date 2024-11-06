@extends('layouts.app')

@section('content')
    <br>
    <div class="container-fluid">
        <!-- Enhanced professional-looking link buttons -->
<div class="mb-4">
    <div class="contribution-nav" role="navigation" aria-label="Contribution Types">
        <a href="{{ route('hirings.index') }}" class="contribution-link {{ request()->routeIs('hirings.index') ? 'active' : '' }}">
            <div class="icon-wrapper">
                <i class="fas fa-briefcase"></i>
            </div>
            <div class="text-wrapper">
                <span class="title">Hirings</span>
                <small class="description">Job Available List</small>
            </div>
        </a>
        <a href="{{ url('/all-careers') }}" class="contribution-link {{ request()->routeIs('attendances.create') ? 'active' : '' }}">
            <div class="icon-wrapper">
                <i class="fas fa-user-tie"></i>
            </div>
            <div class="text-wrapper">
                <span class="title">Applicants</span>
                <small class="description">Applicants List</small>
            </div>
        </a>
    </div>
</div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Hiring List</h3>
                        <div class="card-tools">
                            @can('hiring-create')
                            <a href="{{ route('hirings.create') }}" class="btn btn-success btn-sm rounded-pill">
                                Add Hiring <i class="fas fa-plus-circle"></i>
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
                            <table id="hirings-table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Position</th>
                                        <th>Description</th>
                                        <th>Requirements</th>
                                        <th>Location</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hirings as $hiring)
                                    <tr>
                                        <td>{{ $hiring->position }}</td>
                                        <td>{{ Str::limit($hiring->description, 100) }}</td>
                                        <td>{{ Str::limit($hiring->requirements, 100) }}</td>
                                        <td>{{ $hiring->location }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{ route('hirings.show', $hiring->id) }}"><i class="fas fa-eye"></i>&nbsp;Preview</a>
                                                    @can('hiring-edit')
                                                        <a class="dropdown-item" href="{{ route('hirings.edit', $hiring->id) }}"><i class="fas fa-edit"></i>&nbsp;Edit</a>
                                                    @endcan
                                                    @can('hiring-delete')
                                                        <form action="{{ route('hirings.destroy', $hiring->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this hiring?')"><i class="fas fa-trash"></i>&nbsp;Delete</button>
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
            $('#hirings-table').DataTable({
                responsive: true,
                scrollX: true,
                autoWidth: false,
                columnDefs: [
                    { responsivePriority: 1, targets: 0 }, // Position
                    { responsivePriority: 2, targets: -1 }, // Action
                    { responsivePriority: 3, targets: 3 }, // Location
                    { responsivePriority: 4, targets: '_all' }
                ]
            });
        });
    </script>
@endsection

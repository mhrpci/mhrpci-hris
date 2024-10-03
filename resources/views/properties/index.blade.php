@extends('layouts.app')

@section('content')
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Property List</h3>
                        <div class="card-tools">
                            @can('property-create')
                            <a href="{{ route('properties.create') }}" class="btn btn-success btn-sm rounded-pill">
                                Add Property <i class="fas fa-plus-circle"></i>
                            </a>
                            @endcan
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">{{ $message }}</div>
                        @endif
                        <table id="properties-table" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Property Name</th>
                                    <th>Description</th>
                                    <th>Location</th>
                                    <th>Type</th>
                                    <th>Contact Info</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($properties as $property)
                                <tr>
                                    <td>{{ $property->property_name }}</td>
                                    <td>{{ Str::limit($property->description, 100) }}</td>
                                    <td>{{ $property->location }}</td>
                                    <td>{{ $property->type }}</td>
                                    <td>{{ $property->contact_info }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{ route('properties.show', $property->id) }}"><i class="fas fa-eye"></i>&nbsp;Preview</a>
                                                @can('property-edit')
                                                    <a class="dropdown-item" href="{{ route('properties.edit', $property->id) }}"><i class="fas fa-edit"></i>&nbsp;Edit</a>
                                                @endcan
                                                @can('property-delete')
                                                    <form action="{{ route('properties.destroy', $property->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this property?')"><i class="fas fa-trash"></i>&nbsp;Delete</button>
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
            $('#properties-table').DataTable();
        });
    </script>
@endsection

@extends('layouts.app')

@section('content')
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Inventory List</h3>
                        <div class="card-tools">
                            <div class="button-group">
                                @can('inventory-create')
                                <a href="{{ route('inventory.create') }}" class="btn btn-success btn-sm rounded-pill mb-2 mb-sm-0">
                                    Add Inventory <i class="fas fa-plus-circle"></i>
                                </a>
                                @endcan
                                <button type="button" class="btn btn-primary btn-sm rounded-pill" data-toggle="modal" data-target="#importModal">
                                    Import Inventory <i class="fas fa-file-import"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="importModalLabel">Import Inventory</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form inside modal -->
                                    <form id="importForm" action="{{ route('inventory.import') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="file">Choose Excel or CSV file</label>
                                            <input type="file" name="file" class="form-control" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Import</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">{{ $message }}</div>
                        @endif
                        <div class="table-responsive">
                            <table id="inventory-table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inventory as $inventory)
                                        <tr>
                                            <td>{{ $inventory->id }}</td>
                                            <td>{{ $inventory->name }}</td>
                                            <td>{{ $inventory->description }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        @can('inventory-edit')
                                                            <a class="dropdown-item" href="{{ route('inventory.edit',$inventory->id) }}"><i class="fas fa-edit"></i>&nbsp;Edit</a>
                                                        @endcan
                                                        @can('inventory-delete')
                                                            <form action="{{ route('inventory.destroy', $inventory->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this inventory?')"><i class="fas fa-trash"></i>&nbsp;Delete</button>
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

@section('css')
<style>
    @media (max-width: 768px) {
        .card-header {
            flex-direction: column;
            align-items: start !important;
        }
        .card-tools {
            margin-top: 10px;
            width: 100%;
        }
        .button-group {
            display: flex;
            flex-direction: column;
            width: 100%;
            gap: 10px;
        }
        .btn {
            width: 100%;
        }
        .modal-dialog {
            margin: 0.5rem;
        }
    }
</style>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('#inventory-table').DataTable({
            responsive: true,
            scrollX: true,
            autoWidth: false,
            columnDefs: [
                { responsivePriority: 1, targets: 1 }, // Name
                { responsivePriority: 2, targets: -1 }, // Action
                { responsivePriority: 3, targets: 0 }, // ID
                { responsivePriority: 4, targets: '_all' }
            ],
            language: {
                emptyTable: "No inventory items available at the moment."
            }
        });

        // Improve modal behavior on mobile
        $('#importModal').on('shown.bs.modal', function () {
            $(this).find('[type="file"]').focus();
        });
    });
</script>
@endsection

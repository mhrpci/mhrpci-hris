@extends('layouts.app')

@section('title', 'Edit Accountability')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h2 class="mb-0 fs-4">Edit Accountability</h2>
                    <a href="{{ route('accountabilities.index') }}" class="btn btn-outline-light btn-sm">Back to List</a>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('accountabilities.update', $accountability) }}" method="POST" enctype="multipart/form-data" id="editAccountabilityForm">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="employee_id" class="form-label">Employee <span class="text-danger">*</span></label>
                            <select name="employee_id" id="employee_id" class="form-control select2" required>
                                <option value="">Select an employee</option>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}" {{ old('employee_id', $accountability->employee_id) == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->full_name }} ({{ $employee->company_id ?? 'No ID' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="documents" class="form-label">Documents</label>
                            <div class="custom-file">
                                <input type="file" name="documents[]" id="documents" class="custom-file-input" multiple accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                <label class="custom-file-label" for="documents">Choose files</label>
                            </div>
                            <small class="form-text text-muted">Allowed file types: PDF, DOC, DOCX, JPG, JPEG, PNG. Max file size: 5MB each.</small>

                            @if($accountability->documents->count() > 0)
                                <div class="mt-2">
                                    <h6>Current Documents:</h6>
                                    <ul class="list-group">
                                        @foreach($accountability->documents as $document)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <a href="{{ $document->url }}" target="_blank">{{ $document->original_name }}</a>
                                                <button type="button" class="btn btn-danger btn-sm delete-document" data-document-id="{{ $document->id }}">Delete</button>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <div class="form-group mb-3">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea name="notes" id="notes" class="form-control" rows="3">{{ old('notes', $accountability->notes) }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="it_inventories" class="form-label">IT Inventories</label>
                            <select name="it_inventories[]" id="it_inventories" class="form-control select2" multiple>
                                @foreach($itInventories as $inventory)
                                    <option value="{{ $inventory->id }}" {{ in_array($inventory->id, old('it_inventories', $accountability->itInventories->pluck('id')->toArray())) ? 'selected' : '' }}>
                                        {{ $inventory->name }} ({{ $inventory->serial_number }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="active" {{ old('status', $accountability->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $accountability->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary btn-lg w-100">Update Accountability</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
<style>
    .card {
        border: none;
        border-radius: 0.5rem;
    }
    .card-header {
        border-top-left-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
    }
    .select2-container--bootstrap-5 .select2-selection {
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
    }
    .custom-file-input:lang(en)~.custom-file-label::after {
        content: "Browse";
    }
    .form-control, .custom-file-label {
        border-radius: 0.25rem;
    }
    .btn-lg {
        border-radius: 0.3rem;
    }
    .delete-document {
        transition: all 0.3s ease;
    }
    .delete-document:hover {
        transform: scale(1.05);
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap-5',
            placeholder: 'Select option(s)',
            allowClear: true,
            width: '100%'
        });

        $('.custom-file-input').on('change', function() {
            let fileNames = Array.from(this.files).map(file => file.name).join(', ');
            $(this).next('.custom-file-label').addClass("selected").html(fileNames || 'Choose files');
        });

        $('.delete-document').on('click', function() {
            if (confirm('Are you sure you want to delete this document?')) {
                let documentId = $(this).data('document-id');
                $.ajax({
                    url: '{{ route("documents.destroy", ":id") }}'.replace(':id', documentId),
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(result) {
                        location.reload();
                    },
                    error: function(xhr) {
                        alert('Error deleting document. Please try again.');
                    }
                });
            }
        });

        $('#editAccountabilityForm').on('submit', function(e) {
            e.preventDefault();
            if (confirm('Are you sure you want to update this accountability?')) {
                this.submit();
            }
        });
    });
</script>
@endpush

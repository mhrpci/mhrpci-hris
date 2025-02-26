@extends('layouts.medical-products')

@section('title', 'Add New Medical Product')

@push('styles')
<style>
    .form-label {
        color: var(--text-color);
        font-weight: 500;
    }

    .form-control,
    .form-select {
        background-color: var(--sidebar-bg);
        border-color: var(--border-color);
        color: var(--text-color);
    }

    .form-control:focus,
    .form-select:focus {
        background-color: var(--sidebar-bg);
        border-color: var(--primary-color);
        color: var(--text-color);
        box-shadow: 0 0 0 0.25rem rgba(37, 99, 235, 0.1);
    }

    .form-control::placeholder {
        color: var(--text-muted);
    }

    .form-text {
        color: var(--text-muted);
    }

    .invalid-feedback {
        color: #dc3545;
    }

    .form-control.is-invalid,
    .form-select.is-invalid {
        border-color: #dc3545;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
    }

    .preview-image {
        max-height: 200px;
        border-radius: 0.5rem;
        background-color: var(--content-bg);
    }
</style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1 class="h3 mb-0">Add New Medical Product</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('medical-products.store') }}" 
                              method="POST" 
                              enctype="multipart/form-data"
                              class="needs-validation" 
                              novalidate>
                            @csrf

                            <div class="mb-4">
                                <label for="category_id" class="form-label">Category</label>
                                <select name="category_id" 
                                        id="category_id" 
                                        class="form-select select2 @error('category_id') is-invalid @enderror" 
                                        required
                                        data-placeholder="Select a category">
                                    <option value=""></option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" 
                                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" 
                                       name="name" 
                                       id="name" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       value="{{ old('name') }}" 
                                       placeholder="Enter product name"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" 
                                          id="description" 
                                          class="form-control @error('description') is-invalid @enderror" 
                                          rows="3" 
                                          placeholder="Enter product description"
                                          required>{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="details" class="form-label">Details</label>
                                <textarea name="details" 
                                          id="details" 
                                          class="form-control @error('details') is-invalid @enderror" 
                                          rows="5" 
                                          placeholder="Enter detailed product information"
                                          required>{{ old('details') }}</textarea>
                                @error('details')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="image" class="form-label">Product Image</label>
                                <input type="file" 
                                       name="image" 
                                       id="image" 
                                       class="form-control @error('image') is-invalid @enderror"
                                       accept="image/*"
                                       placeholder="Choose product image">
                                <div class="form-text">Maximum file size: 10MB. Supported formats: JPG, PNG, GIF</div>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('medical-products.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-2"></i>Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Save Product
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.select2').select2({
            theme: 'bootstrap-5',
            width: '100%',
            placeholder: $(this).data('placeholder')
        });

        // Form validation
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()

        // Image preview
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                if (file.size > 2 * 1024 * 1024) {
                    this.value = '';
                    alert('File size must be less than 2MB');
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.createElement('img');
                    preview.src = e.target.result;
                    preview.classList.add('preview-image', 'mt-2');
                    
                    const container = document.getElementById('image').parentElement;
                    const oldPreview = container.querySelector('img');
                    if (oldPreview) {
                        container.removeChild(oldPreview);
                    }
                    container.appendChild(preview);
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endpush 
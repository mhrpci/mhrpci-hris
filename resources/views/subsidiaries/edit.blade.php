@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">Edit Subsidiary</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('subsidiaries.update', $subsidiary->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required maxlength="255" placeholder="Enter subsidiary name" value="{{ old('name', $subsidiary->name) }}">
                            </div>
                            <div class="col-md-6">
                                <label for="abbr" class="form-label">Abbreviation</label>
                                <input type="text" class="form-control" id="abbr" name="abbr" required maxlength="255" placeholder="Enter abbreviation" value="{{ old('abbr', $subsidiary->abbr) }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required placeholder="Enter subsidiary description">{{ old('description', $subsidiary->description) }}</textarea>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="contact_no" class="form-label">Contact Number</label>
                                <input type="text" class="form-control" id="contact_no" name="contact_no" maxlength="255" placeholder="Enter contact number" value="{{ old('contact_no', $subsidiary->contact_no) }}">
                            </div>
                            <div class="col-md-6">
                                <label for="email_address" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email_address" name="email_address" maxlength="255" placeholder="Enter email address" value="{{ old('email_address', $subsidiary->email_address) }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="facebook_page" class="form-label">Facebook Page</label>
                                <input type="url" class="form-control" id="facebook_page" name="facebook_page" maxlength="255" placeholder="https://facebook.com/your-page" value="{{ old('facebook_page', $subsidiary->facebook_page) }}">
                            </div>
                            <div class="col-md-6">
                                <label for="website" class="form-label">Website</label>
                                <input type="url" class="form-control" id="website" name="website" maxlength="255" placeholder="https://www.example.com" value="{{ old('website', $subsidiary->website) }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="main_image" class="form-label">Main Image</label>
                            <input type="file" class="form-control" id="main_image" name="main_image" accept="image/jpeg,image/png,image/jpg,image/gif">
                            @if($subsidiary->main_image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $subsidiary->main_image) }}" alt="Current Main Image" class="img-thumbnail" style="max-height: 100px;">
                                </div>
                            @endif
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 mb-3 mb-md-0">
                                <label for="first_image" class="form-label">First Image</label>
                                <input type="file" class="form-control" id="first_image" name="first_image" accept="image/jpeg,image/png,image/jpg,image/gif">
                                @if($subsidiary->first_image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $subsidiary->first_image) }}" alt="Current First Image" class="img-thumbnail" style="max-height: 100px;">
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-4 mb-3 mb-md-0">
                                <label for="second_image" class="form-label">Second Image</label>
                                <input type="file" class="form-control" id="second_image" name="second_image" accept="image/jpeg,image/png,image/jpg,image/gif">
                                @if($subsidiary->second_image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $subsidiary->second_image) }}" alt="Current Second Image" class="img-thumbnail" style="max-height: 100px;">
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <label for="third_image" class="form-label">Third Image</label>
                                <input type="file" class="form-control" id="third_image" name="third_image" accept="image/jpeg,image/png,image/jpg,image/gif">
                                @if($subsidiary->third_image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $subsidiary->third_image) }}" alt="Current Third Image" class="img-thumbnail" style="max-height: 100px;">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Update Subsidiary</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

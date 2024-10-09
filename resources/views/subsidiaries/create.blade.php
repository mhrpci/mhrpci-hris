@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">Create Subsidiary</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('subsidiaries.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required maxlength="255" placeholder="Enter subsidiary name">
                            </div>
                            <div class="col-md-6">
                                <label for="abbr" class="form-label">Abbreviation</label>
                                <input type="text" class="form-control" id="abbr" name="abbr" required maxlength="255" placeholder="Enter abbreviation">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required placeholder="Enter subsidiary description"></textarea>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="contact_no" class="form-label">Contact Number</label>
                                <input type="text" class="form-control" id="contact_no" name="contact_no" maxlength="255" placeholder="Enter contact number">
                            </div>
                            <div class="col-md-6">
                                <label for="email_address" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email_address" name="email_address" maxlength="255" placeholder="Enter email address">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="facebook_page" class="form-label">Facebook Page</label>
                                <input type="url" class="form-control" id="facebook_page" name="facebook_page" maxlength="255" placeholder="https://facebook.com/your-page">
                            </div>
                            <div class="col-md-6">
                                <label for="website" class="form-label">Website</label>
                                <input type="url" class="form-control" id="website" name="website" maxlength="255" placeholder="https://www.example.com">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="main_image" class="form-label">Main Image</label>
                            <input type="file" class="form-control" id="main_image" name="main_image" accept="image/jpeg,image/png,image/jpg,image/gif">
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 mb-3 mb-md-0">
                                <label for="first_image" class="form-label">First Image</label>
                                <input type="file" class="form-control" id="first_image" name="first_image" accept="image/jpeg,image/png,image/jpg,image/gif">
                            </div>
                            <div class="col-md-4 mb-3 mb-md-0">
                                <label for="second_image" class="form-label">Second Image</label>
                                <input type="file" class="form-control" id="second_image" name="second_image" accept="image/jpeg,image/png,image/jpg,image/gif">
                            </div>
                            <div class="col-md-4">
                                <label for="third_image" class="form-label">Third Image</label>
                                <input type="file" class="form-control" id="third_image" name="third_image" accept="image/jpeg,image/png,image/jpg,image/gif">
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Create Subsidiary</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('adminlte::page')

@section('preloader')
<div id="loader" class="loader">
    <div class="loader-content">
        <div class="wave-loader">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <h4 class="mt-4 text-dark">Loading...</h4>
    </div>
</div>
<style>
    /* Loader */
.loader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.9);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
    transition: opacity 0.5s ease-out;
}

.loader-content {
    text-align: center;
}

/* Wave Loader */
.wave-loader {
    display: flex;
    justify-content: center;
    align-items: flex-end;
    height: 50px;
}

.wave-loader > div {
    width: 10px;
    height: 50px;
    margin: 0 5px;
    background-color: #8e44ad; /* Purple color */
    animation: wave 1s ease-in-out infinite;
}

.wave-loader > div:nth-child(2) {
    animation-delay: -0.9s;
}

.wave-loader > div:nth-child(3) {
    animation-delay: -0.8s;
}

.wave-loader > div:nth-child(4) {
    animation-delay: -0.7s;
}

.wave-loader > div:nth-child(5) {
    animation-delay: -0.6s;
}

@keyframes wave {
    0%, 100% {
        transform: scaleY(0.5);
    }
    50% {
        transform: scaleY(1);
    }
}
</style>
@stop

@section('content')
<br>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-success text-white">
                        <h2 class="mb-0">Create New Hiring Position</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('hirings.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="position"><i class="fas fa-briefcase mr-2"></i>Position</label>
                                <input type="text" class="form-control" id="position" name="position" required>
                            </div>
                            <div class="form-group">
                                <label for="description"><i class="fas fa-align-left mr-2"></i>Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="requirements"><i class="fas fa-list-ul mr-2"></i>Requirements</label>
                                <textarea class="form-control" id="requirements" name="requirements" rows="4" required></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success btn-lg px-5"><i class="fas fa-plus mr-2"></i>Create Position</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
// ... existing CSS ...
@endpush

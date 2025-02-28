@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card mt-4 shadow">
                <div class="card-header bg-primary text-white">
                    <h1 class="mb-0 h3">{{ $hiring->position }}</h1>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h5 class="text-primary"><i class="fas fa-info-circle mr-2"></i>Description</h5>
                        <p class="lead">{{ $hiring->description }}</p>
                    </div>
                    <div class="mb-4">
                        <h5 class="text-primary"><i class="fas fa-list-ul mr-2"></i>Requirements</h5>
                        <ul class="list-group">
                            @foreach(explode("\n", $hiring->requirements) as $requirement)
                                <li class="list-group-item"><i class="fas fa-check-circle text-success mr-2"></i>{{ $requirement }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mb-4">
                        <h5 class="text-primary"><i class="fas fa-gift mr-2"></i>Benefits</h5>
                        <ul class="list-group">
                            @foreach(explode("\n", $hiring->benefits) as $benefit)
                                <li class="list-group-item"><i class="fas fa-star text-warning mr-2"></i>{{ $benefit }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mb-4">
                        <h5 class="text-primary"><i class="fas fa-map-marker-alt mr-2"></i>Location</h5>
                        <p class="lead">{{ $hiring->location }}</p>
                    </div>
                </div>
                <div class="card-footer bg-light">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <a href="{{ route('hirings.edit', $hiring) }}" class="btn btn-warning mr-2">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </a>
                            <a href="{{ route('hirings.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left mr-1"></i> Back to List
                            </a>
                        </div>
                        <form action="{{ route('hirings.destroy', $hiring) }}" method="POST" class="mt-2 mt-sm-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this hiring?')">
                                <i class="fas fa-trash-alt mr-1"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

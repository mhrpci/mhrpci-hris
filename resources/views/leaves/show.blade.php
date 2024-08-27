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
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Leave Details</h3>
                    </div>
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">{{ $message }}</div>
                        @endif
                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger">{{ $message }}</div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="font-weight-bold">Employee:</label>
                                    <p>{{ $leave->employee->company_id }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="font-weight-bold">From:</label>
                                    <p>{{ \Carbon\Carbon::parse($leave->date_from)->format('F j, Y \a\t h:i A') }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="font-weight-bold">To:</label>
                                    <p>{{ \Carbon\Carbon::parse($leave->date_to)->format('F j, Y \a\t h:i A') }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="font-weight-bold">Reason:</label>
                                    <p>{{ $leave->reason_to_leave }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="font-weight-bold">Payment Status:</label>
                                    @if($leave->employee->employment_status === 'REGULAR')
                                        <p>With Pay</p>
                                    @else
                                        <p>Without Pay</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="font-weight-bold">Type:</label>
                                    <p>{{ $leave->type->name }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="font-weight-bold">Status:</label>
                                    <br>
                                    @if($leave->status == 'approved')
                                        <i class="fas fa-check-circle text-success"></i>
                                    @elseif($leave->status == 'rejected')
                                        <i class="fas fa-times-circle text-danger"></i>
                                    @else
                                        <i class="fas fa-redo-alt text-secondary"></i>
                                    @endif
                                    &nbsp;{{ ucfirst($leave->status) }}
                                </div>
                                <div class="mb-3">
                                    @if($leave->status === 'approved')
                                        <label class="font-weight-bold">Approved By:</label>
                                        @if($approvedByUser)
                                            <p> {{ $approvedByUser->first_name }} {{ $approvedByUser->last_name }}</p>
                                        @endif
                                    @elseif($leave->status === 'rejected')
                                        <label class="font-weight-bold">Rejected By:</label>
                                        @if($approvedByUser)
                                            <p> {{ $approvedByUser->first_name }} {{ $approvedByUser->last_name }}</p>
                                        @endif
                                    @else
                                        <label class="font-weight-bold">Approved By:</label>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="font-weight-bold">Number of Days:</label>
                                    @if($leave->diffhours)
                                        @if($leave->diffhours['hours'] > 0)
                                            <p>{{ $leave->diffhours['hours'] }} hours</p>
                                        @endif
                                        @if($leave->diffhours['minutes'] > 0)
                                            @if($leave->diffhours['hours'] > 0)
                                                <p>{{ $leave->diffhours['minutes'] }} minutes</p>
                                            @else
                                                <p>{{ $leave->diffhours['minutes'] }} minutes</p>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateStatusModal-{{ $leave->id }}">
                                Update Status
                            </button> &nbsp;
                            <a href="{{ route('leaves.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="updateStatusModal-{{ $leave->id }}" tabindex="-1" role="dialog" aria-labelledby="updateStatusModalLabel-{{ $leave->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="updateStatusModalLabel-{{ $leave->id }}">Update Status for {{ $leave->type->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('leaves.updateStatus', $leave->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="status" class="font-weight-bold">Status:</label>
                            <select name="status" class="form-control" required>
                                <option value="pending" {{ $leave->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="rejected" {{ $leave->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                <option value="approved" {{ $leave->status == 'approved' ? 'selected' : '' }}>Approved</option>
                            </select>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-success">Update Status</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

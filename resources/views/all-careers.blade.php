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
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Careers</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if($careers->isEmpty())
                        <p>No applicants available at the moment.</p>
                    @else
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-filter"></i></span>
                                </div>
                                <select id="read-filter" class="form-control">
                                    <option value="">All Applications</option>
                                    <option value="read">Read Applications</option>
                                    <option value="unread">Unread Applications</option>
                                </select>
                            </div>
                        </div>
                        <table id="careers-table" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Position</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Experience</th>
                                    <th>Applied At</th>
                                    <th>Read</th>
                                    <th>Action</th> <!-- New column -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($careers as $career)
                                    <tr>
                                        <td>{{ $career->hiring->position ?? 'N/A' }}</td>
                                        <td>{{ $career->first_name }}</td>
                                        <td>{{ $career->last_name }}</td>
                                        <td>{{ $career->email }}</td>
                                        <td>{{ $career->experience }} years</td>
                                        <td>{{ $career->created_at->format('F j, Y \a\t g:i A') }}</td>
                                        <td>
                                            @if($career->is_read)
                                                <span class="badge badge-success"><i class="fas fa-check-circle mr-1"></i> Read</span>
                                            @else
                                                <span class="badge badge-info"><i class="fas fa-bell mr-1"></i> New</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('careers.show', $career->id) }}" class="btn btn-primary btn-sm">View Details</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
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
    #read-filter {
        max-width: 250px;
    }
    .input-group-text {
        background-color: #007bff;
        color: white;
        border: 1px solid #007bff;
    }
</style>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        var table = $('#careers-table').DataTable();

        $('#read-filter').on('change', function() {
            table.draw();
        });

        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var status = $('#read-filter').val();
                var isRead = $(table.row(dataIndex).node()).find('td:eq(6) span').hasClass('badge-success');

                if (status === "") return true;
                if (status === "read" && isRead) return true;
                if (status === "unread" && !isRead) return true;

                return false;
            }
        );
    });
</script>
@endsection

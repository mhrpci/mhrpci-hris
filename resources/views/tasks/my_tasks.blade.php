@extends('adminlte::page')

@section('preloader')
    <i class="fas fa-4x fa-spin fa-spinner text-secondary"></i>
    <h4 class="mt-4 text-dark">Loading</h4>
@stop

@section('content')
<br>
<div class="container">
    <h1>My Tasks</h1>

    @if($tasks->isEmpty())
        <p>No tasks assigned to you.</p>
    @else
    @if ($message = Session::get('success'))
                        <div class="alert alert-success">{{ $message }}</div>
                    @endif
        <table id="tasksTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Assigned By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>
                            @if($task->status === 'Pending')
                                <i class="fas fa-hourglass-half text-gray"></i> Pending
                            @elseif($task->status === 'On Progress')
                                <i class="fas fa-cog text-warning rotating"></i> On Progress
                            @elseif($task->status === 'Done')
                                <i class="fas fa-check-circle text-success"></i> Done
                            @elseif($task->status === 'Abandoned')
                                <i class="fas fa-times-circle text-danger"></i> Abandoned
                            @endif
                        </td>
                        <td>{{ $task->employee->first_name }}</td>
                        <td>
                            <div class="btn-group">
                                <div class="dropdown">
                                    <button class="btn btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{ route('tasks.show',$task->id) }}"><i class="fas fa-eye"></i>&nbsp;Preview</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

@section('css')
<style>
    .rotating {
        animation: rotate 2s infinite linear;
    }

    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
</style>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('#tasksTable').DataTable();
    });
</script>
@endsection

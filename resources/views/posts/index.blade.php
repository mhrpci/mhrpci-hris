@extends('adminlte::page')


@section('preloader')
    <i class="fas fa-4x fa-spin fa-spinner text-secondary"></i>
    <h4 class="mt-4 text-dark">Loading</h4>
@stop
@section('content')
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Post List</h3>
                    <div class="card-tools">
                        @can('post-create')
                        <a href="{{ route('posts.create') }}" class="btn btn-success btn-sm rounded-pill">
                            Add Post <i class="fas fa-plus-circle"></i>
                        </a>
                        @endcan
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">{{ $message }}</div>
                    @endif
                    <table id="posts-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ \Carbon\Carbon::parse($post->date_start)->format('F j, Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($post->date_end)->format('F j, Y') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button post="button" class="btn btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('posts.show',$post->id) }}"><i class="fas fa-eye"></i>&nbsp;Preview</a>
                                                @can('post-edit')
                                                    <a class="dropdown-item" href="{{ route('posts.edit',$post->id) }}"><i class="fas fa-edit"></i>&nbsp;Edit</a>
                                                @endcan
                                                @can('post-delete')
                                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button post="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this post?')"><i class="fas fa-trash"></i>&nbsp;Delete</button>
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

@section('js')
<script>
    $(document).ready(function () {
        $('#posts-table').DataTable();
    });
</script>
@endsection

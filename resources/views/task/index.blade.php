@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Task List</span>
                    <div>
                        <a href="{{ route('task.analyze') }}" class="btn btn-info text-white">Analyze Task</a>
                        <a href="{{ route('task.create') }}" class="btn btn-primary">Add Task</a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(count($task) > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($task as $data)
                            <tr>
                                <td>{{ $data->title }}</td>
                                <td>{{ Str::limit($data->description, 50) }}</td>
                                <td>
                                    @if($data->status == 'pending')
                                        <span class="badge bg-warning">Waiting</span>
                                    @elseif($data->status == 'in_progress')
                                        <span class="badge bg-primary">In Progress</span>
                                    @elseif($data->status == 'completed')
                                        <span class="badge bg-success">Finished</span>
                                    @endif
                                </td>
                                <td>{{ $data->getFormattedTime() }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('task.edit', $data->id) }}" class="btn btn-sm btn-primary me-2">Edit</a>
                                        <form method="POST" action="{{ route('task.destroy', $data->id) }}"
                                            onsubmit="return confirm('Yakin ingin menghapus tugas ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="alert alert-info">
                        Empty Data! <a href="{{ route('task.create') }}">Create new task</a>.
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

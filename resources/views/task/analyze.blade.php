@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Task Analysis</div>

                <div class="card-body">
                    <!-- Summary Status -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Waiting</h5>
                                    <h3 class="card-text">{{ $statusCounts['pending'] }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h5 class="card-title">In Progress</h5>
                                    <h3 class="card-text">{{ $statusCounts['in_progress'] }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Finished</h5>
                                    <h3 class="card-text">{{ $statusCounts['completed'] }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="mb-4">
                        <h5>All Progress</h5>
                        @php
                            $total = array_sum($statusCounts);
                            $completedPercent = $total > 0 ? round(($statusCounts['completed'] / $total) * 100) : 0;
                            $inProgressPercent = $total > 0 ? round(($statusCounts['in_progress'] / $total) * 100) : 0;
                            $pendingPercent = $total > 0 ? round(($statusCounts['pending'] / $total) * 100) : 0;
                        @endphp
                        <div class="progress" style="height: 30px;">
                            <div class="progress-bar bg-success" role="progressbar"
                                 style="width: {{ $completedPercent }}%"
                                 aria-valuenow="{{ $completedPercent }}" aria-valuemin="0" aria-valuemax="100">
                                {{ $completedPercent }}% Finished
                            </div>
                            <div class="progress-bar bg-primary" role="progressbar"
                                 style="width: {{ $inProgressPercent }}%"
                                 aria-valuenow="{{ $inProgressPercent }}" aria-valuemin="0" aria-valuemax="100">
                                {{ $inProgressPercent }}% In Progress
                            </div>
                            <div class="progress-bar bg-warning" role="progressbar"
                                 style="width: {{ $pendingPercent }}%"
                                 aria-valuenow="{{ $pendingPercent }}" aria-valuemin="0" aria-valuemax="100">
                                {{ $pendingPercent }}% Waiting
                            </div>
                        </div>
                    </div>

                    <!-- Matriks Priority -->
                    <div class="row">
                        @if(!empty($priorityMatrix['overdue']))
                        <div class="col-md-6 mb-4">
                            <div class="card border-danger">
                                <div class="card-header bg-danger text-white">
                                    <i class="fas fa-exclamation-triangle"></i> Late Task from Schedule
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        @foreach($priorityMatrix['overdue'] as $task)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $task->title }}
                                            <span class="badge bg-danger rounded-pill">
                                                {{ $task->created_at->diffInDays(now()) }} day
                                            </span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($priorityMatrix['on_track']))
                        <div class="col-md-6 mb-4">
                            <div class="card border-primary">
                                <div class="card-header bg-primary text-white">
                                    <i class="fas fa-check"></i> Tasks According to Schedule
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        @foreach($priorityMatrix['on_track'] as $task)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $task->title }}
                                            <span class="badge bg-primary rounded-pill">
                                                {{ $task->created_at->diffInDays(now()) }} day
                                            </span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($priorityMatrix['detail_pending']))
                        <div class="col-md-6 mb-4">
                            <div class="card border-warning">
                                <div class="card-header bg-warning text-white">
                                    <i class="fas fa-info-circle"></i> Waiting Tasks
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        @foreach($priorityMatrix['detail_pending'] as $task)
                                        <li class="list-group-item">
                                            <div class="fw-bold">{{ $task->title }}</div>
                                            <small>{{ Str::limit($task->description, 100) }}</small>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($priorityMatrix['finished']))
                        <div class="col-md-6 mb-4">
                            <div class="card border-success">
                                <div class="card-header bg-success text-white">
                                    <i class="fas fa-info-circle"></i> Finished Task
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        @foreach($priorityMatrix['finished'] as $task)
                                        <li class="list-group-item">
                                            <div class="fw-bold">{{ $task->title }}</div>
                                            <small>{{ Str::limit($task->description, 100) }}</small>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('task.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

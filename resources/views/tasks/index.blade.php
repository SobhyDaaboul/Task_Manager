@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Task List</h2>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create New Task</a>
</div>

<!-- Search Form -->
<form action="{{ route('tasks.index') }}" method="GET" class="mb-4">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Search tasks by name or description..." value="{{ request('search') }}">
        <button class="btn btn-outline-secondary" type="submit">Search</button>
        @if(request('search'))
            <a href="{{ route('tasks.index') }}" class="btn btn-outline-danger">Clear Search</a>
        @endif
    </div>
</form>

@if ($tasks->isEmpty())
    <div class="alert alert-info">No tasks found.</div>
@else
    <div class="row g-3">
        @foreach ($tasks as $task)
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $task->name }}</h5>
                        <p class="card-text">{{ Str::limit($task->description, 80) }}</p>
                        <p class="mb-1"><strong>Due:</strong> {{ $task->due_date ? $task->due_date->format('M d, Y') : 'N/A' }}</p>
                        <p>
                            @if ($task->completed)
                                <span class="badge bg-success">Completed</span>
                            @else
                                <span class="badge bg-warning text-dark">Pending</span>
                            @endif
                        </p>
                        <div class="d-flex gap-2">
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-info">Edit</a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $tasks->links() }} {{-- Pagination links --}}
    </div>
@endif
@endsection

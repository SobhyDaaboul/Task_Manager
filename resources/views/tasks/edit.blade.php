@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-warning text-white">
        <h3 class="mb-0">Edit Task</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- Use PUT method for update --}}
            
            <div class="mb-3">
                <label for="name" class="form-label">Task Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $task->name) }}" required>
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $task->description) }}</textarea>
            </div>
            
            <div class="mb-3">
                <label for="due_date" class="form-label">Due Date</label>
                <input type="date" class="form-control" id="due_date" name="due_date" value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d') : '') }}">
            </div>
            
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="completed" name="completed" value="1" {{ old('completed', $task->completed) ? 'checked' : '' }}>
                <label class="form-check-label" for="completed">Completed</label>
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">Update Task</button>
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

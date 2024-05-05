<h2>Edit Task</h2>
<form action="{{ route('tasks.update', $task->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label for="status">Status:</label><br>
        <select id="status" name="status" required>
            <option value="To Do" {{ $task->status == 'To Do' ? 'selected' : '' }}>To Do</option>
            <option value="In Progress" {{ $task->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
            <option value="Done" {{ $task->status == 'Done' ? 'selected' : '' }}>Done</option>
        </select>
    </div>
    <button type="submit">Update Status</button>
</form>

<h2>Add Task</h2>

<form action="{{ route('projects.tasks.store', $projectId) }}" method="POST">
    @csrf

    <div>
        <label for="name">Task Name:</label><br>
        <input type="text" id="name" name="name" required>
    </div>

    <div>
        <label for="description">Task Description:</label><br>
        <textarea id="description" name="description" required></textarea>
    </div>

    <button type="submit">Add Task</button>
</form>

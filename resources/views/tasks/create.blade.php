<link href="../../../css/style.css" rel="stylesheet" type="text/css">
<div class="title">Create Task</div>

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

    <button type="submit" class="button button--blue">Add Task</button>
    <a href="{{ route('projects.tasks.index', $projectId) }}" class="button button--red">Cancel</a>
</form>

<h2>Project: {{ $project->name }}</h2>
<p>Description: {{ $project->description }}</p>

<h3>Tasks:</h3>
<ul>
    @foreach ($project->tasks as $task)
        <li>{{ $task->name }} - Status: {{ $task->status }}</li>
    @endforeach
</ul>

<h3>Add Task:</h3>
<a href="{{ route('projects.tasks.create', $project->id) }}">Add Task</a>

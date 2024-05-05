<form action="{{ route('projects.search') }}" method="GET">
    <input type="text" name="name" placeholder="Search by name">
    <input type="date" name="date">
    <button type="submit">Search</button>
</form>

@foreach ($projects as $project)
    <p>{{ $project->name }}</p>
    <p>{{ $project->description }}</p>
    <p>{{ $project->status }}</p>
    
    <a href="{{ route('projects.tasks.index', $project->id) }}">View Tasks</a>
    <a href="{{ route('projects.edit', $project->id) }}">Edit</a>
    <form action="{{ route('projects.destroy', $project->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Are you sure you want to delete this project?')">Delete</button>
    </form>
@endforeach

<a href="{{ route('projects.create') }}" class="btn btn-primary">Add Project</a>
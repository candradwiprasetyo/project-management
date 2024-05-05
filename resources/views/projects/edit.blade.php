<form action="{{ route('projects.update', $project->id) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="name" value="{{ $project->name }}"><br>
    <textarea name="description">{{ $project->description }}</textarea><br>
    <input type="date" name="start_date" value="{{ $project->start_date }}"><br>
    <input type="date" name="due_date" value="{{ $project->due_date }}"><br>
    <button type="submit">Update Project</button>
</form>

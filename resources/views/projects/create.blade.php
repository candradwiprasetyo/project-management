<form action="{{ route('projects.store') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Project Name"><br>
    <textarea name="description" placeholder="Project Description"></textarea><br>
    <input type="date" name="start_date" placeholder="Start Date"><br>
    <input type="date" name="due_date" placeholder="Due Date"><br>
    <button type="submit">Add Project</button>
</form>

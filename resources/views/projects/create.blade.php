<link href="../css/style.css" rel="stylesheet" type="text/css">
<div class="title">Create Project Managements</div>
<form action="{{ route('projects.store') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Project Name"><br>
    <textarea name="description" placeholder="Project Description"></textarea><br>
    <input type="date" name="start_date" placeholder="Start Date"><br>
    <input type="date" name="due_date" placeholder="Due Date"><br>
    <button type="submit" style="display: inline-block" class="button button--green">Add Project</button>
    <a href="{{ route('projects.index') }}" class="button button--red">Cancel</a>   
</form>


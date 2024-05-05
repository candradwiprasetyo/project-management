<link href="css/style.css" rel="stylesheet" type="text/css">

<div class="title">Project Managements</div>

<form action="{{ route('projects.search') }}" method="GET">
    <input type="text" name="name" placeholder="Search by name">
    <input type="date" name="date">
    <button type="submit">Search</button>
</form>

<table>
  <thead>
    <tr>
      <th>Name</th>
      <th>Desciption</th>
      <th>Status</th>
      <th>Config</th>
    </tr>
  </thead>
  @foreach ($projects as $project)
    <tr>
      <td>{{ $project->name }}</td>
      <td>{{ $project->description }}</td>
      <td>{!! $project->status !!}</td>
      <td>
        <a href="{{ route('projects.tasks.index', $project->id) }}" class="button button--blue">View Tasks</a>
        <a href="{{ route('projects.edit', $project->id) }}" class="button button--green">Edit</a>
        <div style="with: 80px; display: inline-block">
          <form action="{{ route('projects.destroy', $project->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" onclick="return confirm('Are you sure you want to delete this project?')" class="button button--red">Delete</button>
          </form>
        </div>    
      </td>
    </tr>
  @endforeach
</table>
<br>
<a href="{{ route('projects.create') }}" class="button button--brown">Add Project</a>

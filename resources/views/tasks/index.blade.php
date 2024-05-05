<h2>Project: {{ $project->name }}</h2>
<p>Description: {{ $project->description }}</p>

<h3>Tasks:</h3>
<ul>
    @foreach ($project->tasks as $task)
        <li>{{ $task->name }} - Status: {{ $task->status }}</li>
        <form action="{{ route('tasks.update', $task->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('PUT')
            <select name="status">
                <option value="To Do" {{ $task->status == 'To Do' ? 'selected' : '' }}>To Do</option>
                <option value="In Progress" {{ $task->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                <option value="Done" {{ $task->status == 'Done' ? 'selected' : '' }}>Done</option>
            </select>
            <button type="submit">Update Status</button>
        </form>
        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
        </form>
    @endforeach
</ul>

<a href="{{ route('projects.tasks.create', $project->id) }}">Add Task</a>

<a href="{{ route('projects.index') }}" class="btn btn-primary">Back to Projects</a>

<canvas id="projectProgressChart" style="width: 200px; height: 200px"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById('projectProgressChart').getContext('2d');
        var tasksData = {!! $tasksData !!};

        // Proses data tasks untuk menampilkan kemajuan proyek
        var completedTasks = tasksData.filter(task => task.status === 'Done').length;
        var inProgressTasks = tasksData.filter(task => task.status === 'In Progress').length;

        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Completed Tasks', 'In Progress Tasks'],
                datasets: [{
                    label: 'Project Progress',
                    data: [completedTasks, inProgressTasks],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                responsive: false, // Menonaktifkan responsivitas untuk mengontrol lebar dan tinggi secara langsung
                maintainAspectRatio: false, // Menonaktifkan pemeliharaan rasio aspek untuk mengontrol tinggi
                width: 400, // Lebar grafik
                height: 400, // Tinggi grafik
                // Konfigurasi lainnya
                    }
        });
    });
</script>
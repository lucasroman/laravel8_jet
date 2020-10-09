@extends('layouts/tasksLayout')

@section('content')
    <div class="panel-body">

        {{-- Task name --}}
        <div class="form-group container">
            <div class="card mt-4">
                <div class="card-header">
                    New Task
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        {{-- New Task form --}}
                        <form action="" method="post">
                            @csrf
                            <label for="task" class="font-weight-bold">
                                Task
                            </label>

                            {{-- Input task field --}}
                            <input type="text" class="form-control"
                                name="name"
                                id="task-name">

                            {{-- Input error message --}}
                            @error('name')
                                <div class="alert alert-danger mt-3">
                                    {{ $message }}
                                </div>
                            @enderror

                            <button type="submit" class=
                                "btn btn-outline-secondary mt-3">
                                <i class="fas fa-plus"></i> Add Task
                            </button>
                        </form>
                    </li>
                </ul>
            </div>

            {{-- Show task list if there --}}
            @if ($tasks->isNotEmpty())
                <div class="card mt-4">
                    <div class="card-header">
                        Current Tasks
                    </div>

                    <table class="table table-striped">
                        <thead>
                            <th>Task</th>
                        </thead>

                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <form action=
                                        "{{route('task.delete', $task->id)}}"
                                        method="post">
                                        @csrf
                                        @method("delete")

                                        <td>{{ $task->name }}</td>
                                        <td>
                                            <button type="submit" class=
                                                "btn btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                                Delete
                                            </button>
                                        </td>
                                    </form>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection

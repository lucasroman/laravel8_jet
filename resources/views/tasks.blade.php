@extends('layouts/tasksLayout')

@section('content')
    <div class="panel-body">
        {{-- Display validation errors --}}
        {{-- @include('common.errors') --}}

        {{-- New Task form --}}
        <form action="" method="post">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Task name --}}
            <div class="form-group container">
                <div class="card mt-4">
                    <div class="card-header">
                        New Task
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <label for="task" class="font-weight-bold">
                                Task
                            </label>
                            <input type="text" class="form-control" name="name"
                                id="task-name">
                                <button type="submit" class=
                                    "btn btn-outline-secondary mt-3">
                                    <i class="fas fa-plus"></i> Add Task
                                </button>
                        </li>
                    </ul>
                </div>
        </form>

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

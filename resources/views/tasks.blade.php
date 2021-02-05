@extends('layouts.app')

@section('content')
    <!--  Error Messages -->
    @include('commons.errors')

    <!-- Insert Task -->
    <form class="form-row store-task-form" method="POST" action="">
    @csrf
      <div class="form-group col-12">
        <div class="input-group input-task">
          <input id="inputTask" class="form-control" name="todo" type="text" maxlength="200" value="{{ old('todo') }}">
          <div class="input-group-prepend">
            <button class="input-group-text store-task-button" type="submit">
              <i class="fa fa-plus"></i>
            </button>
          </div>
        </div>
      </div>
    </form>

    <!-- Task List -->
    @if (isset($tasks[0]))
    <ul class="list-group">
        @foreach ($tasks as $task)
      <li id="taskItem{{ $task->id }}" class="list-group-item">
        <span class="">{{ $task->todo }}</span>
        <form class="task-menu" method="POST" action="/">
            @csrf
            @method('DELETE')
          <button class="btn btn-link" type="submit" name="id" value="{{ $task->id }}">削除</button>
        </form>
        <form class="task-menu" method="GET" action="/edit/{{ $task->id }}">
            @csrf
          <button class="btn btn-link" type="submit" name="id" value="{{ $task->id }}">編集</button>
        </form>
      </li>
        @endforeach
    </ul>
    @endif
@endsection

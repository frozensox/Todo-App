@extends('layouts.app')

@section('content')
  <div class="container">

@include('commons.errors')

    <!-- Insert Task -->
    <form class="store-task-form w-100" method="POST" action="/">
      @csrf

      <div class="form-group input-task">
        <div class="input-group">
          <textarea id="inputTask"@if(isset($target)) class="form-control"@else class="form-control onload-focus"@endif name="todo" type="text" maxlength="100" autocapitalize="none" autocomplete="off" autocorrect="off" spellcheck="false">{{ old('todo') }}</textarea>
          <div class="input-group-prepend">
            <button class="input-group-text store-task-button" type="submit">
              <i class="fas fa-plus"></i>
            </button>
          </div>
        </div>
      </div>
    </form>

    <!-- Task List -->
@if (isset($tasks[0]))
    <ul class="list-group">
@foreach ($tasks as $task)
      <li id="taskItem{{ $task->id }}" class="list-group-item task-item">
@if (isset($target) && $task->id == $target)
        <form class="edit-task-form w-100" method="POST" action="/edit/{{ $task->id }}">
          @csrf

          <div class="form-group edit-task">
            <div class="input-group">
              <textarea id="editTask"@if(!isset($target)) class="form-control"@else class="form-control onload-focus"@endif name="todo" type="text" maxlength="100" autocapitalize="none" autocomplete="off" autocorrect="off" spellcheck="false">{{ $task->todo }}</textarea>
              <div class="input-group-prepend">
                <button class="input-group-text update-task-button" type="submit">
                  <i class="fas fa-check"></i>
                </button>
              </div>
            </div>
          </div>
        </form>
@else
        <p class="todo-text">{{ $task->todo }}</p>
        <button class="task-menu-popper" type="button">
          <div class="popper-button-icon"></div>
          <div class="popper-button-icon"></div>
        </button>
        <div class="task-menu d-none">
          <form class="task-menu-form" method="GET" action="/edit/{{ $task->id }}">
            @csrf

            <button class="btn btn-link task-menu-button" type="submit" name="id" value="{{ $task->id }}">編集</button>
          </form>
          <form class="task-menu-form" method="POST" action="/">
            @csrf @method('DELETE')

            <button class="btn btn-link task-menu-button" type="submit" name="id" value="{{ $task->id }}">削除</button>
          </form>
        </div>
@endif
      </li>
@endforeach
    </ul>
@endif
  </div>
@endsection

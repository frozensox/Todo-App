<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks', ['tasks' => $tasks]);
    }

    public function store(Request $request)
    {
        // Validation
        $this->validate($request, [
            'todo' => 'required|max:100'
        ]);

        $task = new Task;
        $task->user_id = 0;
        $task->todo = $request->todo;
        $task->order = Task::count();
        $task->status = 0;
        $task->save();

        return redirect('/');
    }

    public function delete(Request $request)
    {
        Task::find($request->id)->delete();

        return  redirect('/');
    }

    public function edit(Request $request)
    {
        $tasks = Task::all();

        return view('tasks', [
            'tasks' => $tasks,
            'target' => $request->id
            ]);
    }

    public function update(Task $task, Request $request)
    {
        // Delete task if todo is null
        if ($request->todo == '') {
            $task->delete();

            return  redirect('/');

        } else {
            // Validation
            $this->validate($request, [
                'todo' => 'max:100'
            ]);

            $task->todo = $request->todo;
            $task->save();

            return redirect('/');
        }
    }
}

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
            'todo' => 'required|max:200'
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
}

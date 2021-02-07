<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

class TaskController extends Controller
{
    public function index()
    {
        // $tasks = Task::all();
        $tasks = Task::where('user_id', '=', Auth::id())
                    ->orderBy('order', 'desc')
                    ->get();
        return view('tasks', ['tasks' => $tasks]);
    }

    public function store(Request $request)
    {
        // Validation
        $this->validate($request, [
            'todo' => 'required|max:100'
        ]);

        $taskCount = Task::where('user_id', '=', Auth::id())->count();

        $task = new Task;
        $task->user_id = Auth::id();
        $task->todo = $request->todo;
        $task->order = $taskCount;
        $task->status = 0;
        $task->save();

        return redirect('/');
    }

    public function delete(Request $request)
    {
        $task = Task::find($request->id);
        if ($task->count() && $task->user_id == Auth::id()) {
            $task->delete();

            return  redirect('/');

        } else {
            $message = new MessageBag;
            $message->add('invalid_request', 'delete: Requested task id is invalid.');

            return  redirect('/')->withErrors($message);
        }

    }

    public function edit(Request $request)
    {
        $tasks = Task::where('user_id', '=', Auth::id())
                    ->orderBy('order', 'desc')
                    ->get();

        return view('tasks', [
            'tasks' => $tasks,
            'target' => $request->id
            ]);
    }

    public function update(Task $task, Request $request)
    {
        // Check user id
        if ($task->user_id != Auth::id()) {
            $message = new MessageBag;
            $message->add('invalid_request', 'update: Requested task id is invalid.');

            return  redirect('/')->withErrors($message);

        // Delete task if todo is null
        } elseif ($request->todo == '') {
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

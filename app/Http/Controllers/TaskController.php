<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    /**
     * Store a new task via AJAX.
     */
    public function store(Request $request)
    {
        // Validate the request
        $taskData = [
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'user_id' => $request->user_id,
        ];
        Task::create($taskData);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function getall()
    {
        $tasks = Task::latest()->with('user')->get();
        $users = User::all();

        if (request()->ajax()) {
            return response()->json([
                'status' => 200,
                'tasks' => $tasks
            ]);
        }

        return view('admin.task', compact('tasks','users'));
    }


    /**
     * Fetch a task for editing via AJAX.
     */
    public function edit($id)
    {
        $task = Task::find($id);
        if ($task) {
            return response()->json([
                'status' => 200,
                'task' => $task
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Task not found'
            ]);
        }
    }

    /**
     * Update a task via AJAX.
     */
    public function update(Request $request)
    {
        $task = Task::find($request->id);
        if ($task) {
            $task->title = $request->title;
            $task->description = $request->description;
            $task->deadline = $request->deadline;
            $task->user_id = $request->user_id;
            $task->save();
            return response()->json([
                'status' => 200,
                'message' => 'Task updated successfully'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Task not found'
            ]);
        }
    }

    /**
     * Delete a task via AJAX.
     */
    public function delete(Request $request)
    {
        $task = Task::find($request->id);
        if ($task && $task->delete()) {
            return response()->json(['status' => 200, 'message' => 'Task deleted successfully.']);
        } else {
            return response()->json(['status' => 400, 'message' => 'Failed to delete task.']);
        }    }
}

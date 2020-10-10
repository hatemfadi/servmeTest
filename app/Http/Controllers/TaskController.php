<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $rules = [
            'date' => 'date',
            'month' => 'integer|between:1,12',
            'category' => 'string',
            'status' => 'string|in:completed,snoozed,overdue'
        ];
        $this->validate($request, $rules);

        $date = $request->get('date');
        $month = $request->get('month');
        $category = $request->get('category');
        $status = $request->get('status');

        $tasks = Task::where("user_id", $this->getUserId());

        if ($date) {
            $tasks->whereDate('datetime', '=', $date);
        } else if ($month) {
            $tasks->whereMonth('datetime', '=', $month);
        }

        if ($category) {
            $tasks->where('category', $category);
        }

        if ($status) {
            $tasks->where('status', $status);
        }

        return $this->success($tasks->paginate(), 200);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'datetime' => 'required|date',
            'status' => 'in:completed, snoozed, overdue',
            'description' => 'required|string',
            'category' => 'required|string'
        ];
        $this->validate($request, $rules);

        $task = Task::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'user_id' => $this->getUserId(),
            'datetime' => $request->get('datetime'),
            'status' => $request->get('status') ? $request->get('status') : "snoozed",
            'category' => $request->get('category')
        ]);

        return $this->success($task, 200);
    }

    public function show($task_id)
    {
        $task = Task::find($task_id);

        if (!$task) {
            return $this->error("The task with {$task_id} doesn't exist", 404);
        }

        return $this->success($task, 200);
    }

    public function update(Request $request, $task_id)
    {
        $task = Task::find($task_id);

        if (!$task) {
            return $this->error("The task with {$task_id} doesn't exist", 404);
        }
        $rules = [
            'name' => 'string',
            'datetime' => 'date',
            'status' => 'in:completed, snoozed, overdue',
            'category' => 'string'
        ];
        $this->validate($request, $rules);

        if ($request->get("name")) {
            $task->name = $request->get("name");
        }
        if ($request->get("datetime")) {
            $task->datetime = $request->get("datetime");
        }
        if ($request->get("status")) {
            $task->status = $request->get("status");
        }
        if ($request->get("category")) {
            $task->category = $request->get("category");
        }
        if ($request->get("description")) {
            $task->description = $request->get("description");
        }
        $task->save();

        return $this->success($task, 200);
    }

    public function destroy($task_id)
    {

        $task = Task::find($task_id);

        if (!$task) {
            return $this->error("The task with {$task_id} doesn't exist", 404);
        }

        $task->delete();

        return $this->success("The task with with id {$task_id} has been deleted", 200);
    }
}

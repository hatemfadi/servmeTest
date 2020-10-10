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
            'month' => 'integer|between:1,12'
        ];
        $this->validate($request, $rules);

        $date = $request->get('date');
        $month = $request->get('month');

        $tasks = Task::where("user_id", $this->getUserId());
        if ($date) {
            $tasks->whereDate('datetime', '=', $date);
        } else if ($month) {
            $tasks->whereMonth('datetime', '=', $month);
        }
        return $this->success($tasks->paginate(), 200);
    }

    public function store(Request $request)
    {

        $rules = [
            'name' => 'string',
            'datetime' => 'date',
            'status' => 'in:completed, snoozed, overdue',
            'category' => 'string'
        ];
        $this->validate($request, $rules);

        $task = Task::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'user_id' => $this->getUserId(),
            'datetime' => $request->get('datetime'),
            'status' => $request->get('status'),
            'category' => $request->get('category')
        ]);

        return $this->success("The task with with id {$task->id} has been created", 201);
    }

    public function show($id)
    {

        $task = Task::find($id);

        if (!$task) {
            return $this->error("The task with {$id} doesn't exist", 404);
        }

        return $this->success($task, 200);
    }

    public function update(Request $request, $id)
    {

        $task = Task::find($id);

        if (!$task) {
            return $this->error("The task with {$id} doesn't exist", 404);
        }
        $rules = [];
        $this->validate($request, $rules);

        $task->title = $request->get('title');
        $task->content = $request->get('content');
        $task->user_id = $this->getUserId();

        $task->save();

        return $this->success("The task with with id {$task->id} has been updated", 200);
    }

    public function destroy($id)
    {

        $task = Task::find($id);

        if (!$task) {
            return $this->error("The task with {$id} doesn't exist", 404);
        }

        $task->delete();

        return $this->success("The task with with id {$id} has been deleted along with it's comments", 200);
    }

    public function isAuthorized(Request $request)
    {

        $resource = "tasks";
        $task = Task::find($this->getArgs($request)["task_id"]);

        return $this->authorizeUser($request, $resource, $task);
    }
}

<?php

namespace App\Domain\Tasks;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domain\Tasks\Task;

class TaskController extends Controller
{
    public function index() {
        return view("tasks/index");
    }
    public function getAll(Request $request) {
        $current_tag = $request->input('current_tag');
        if($current_tag) {
            $tasks = Task::where('tags', $current_tag)->orderBy('created_at', 'desc')->paginate(20);
        }else{
            $tasks = Task::orderBy('created_at', 'desc')->paginate(20);
        }
        return $tasks;
    }
    public function show($id) {
        $task = Task::find($id);
        return $task;
    }
    public function store(Request $request) {
        $task = Task::create($request->all());
        return response()->json($task, 201);
    }
    
    public function update(Request $request, $id) {
        $task = Task::findOrFail($id);
        $task->update($request->all());
        return response()->json($task, 200);
    }

    public function mark(Request $request, $id) {
        $task = Task::findOrFail($id);
        $task->is_completed = 1;
        $task->save();
        return response()->json($task, 200);
    }
    public function delete($id) {
        Task::find($id)->delete();
        return response()->json(null, 204);
    }
}

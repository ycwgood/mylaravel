<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class TaskController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $tasks = Task::orderBy('created_at', 'desc')->paginate(5);
        
        return view('task.index', [
            'tasks' => $tasks
        ]);
    }
    
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        
        return view('task.edit', [
            'task' => $task
        ]);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:5|max:255',
        ]);
        
        if ($request->id == 0) {
            $task = new Task;
        }
        else {
            $task = Task::findOrFail($request->id);
        }
        $task->name = $request->name;
        $task->status = 0;
        $task->save();
        
        return redirect('/tasks');
    }
    
    public function destroy($id)
    {
        Task::findOrFail($id)->delete();
        
        return redirect('/tasks');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $todos = $user->todos;

        return view('todos.index',compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $user_id =  Auth::id();
        return view('todos.create', compact('user_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_id = $request->user_id;
        
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|date',
            'priority' => 'required|string',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,doc,pdf|max:2048',
            'done' => 'boolean',
            'completed' => 'nullable|date',
        ]);
    
        $file_path = null;
    
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $file_path = $file->store('public/files');
        }
    
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'priority' => $request->priority,
            'done' => $request->filled('done'), 
            'completed' => $request->completed ? Carbon::parse($request->completed) : null,
            'user_id' => $user_id,
            'file_path' => $file_path,
        ];
    
        $todo = Todo::create($data);

        if ($request->ajax()) {
            return response()->json(['message' => 'Todo created successfully', 'todo' => $todo], 201);
        } else {
            return redirect()->route('todos.index')->with('success', 'Todo created successfully');
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        if (request()->wantsJson()) {
            return response()->json(['message' => 'Todo retrieved successfully', 'todo' => $todo], 200);
        } else {
            return view('todos.show', ['todo' => $todo]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        return view('todos.edit',compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        if ($todo->user_id !== Auth::id()) {
            return redirect()->route('todos.index')->with('error', 'Unauthorized action.');
        }

        if($request->done){
            $done_timestamp  = Carbon::now();
        } else{
            $done_timestamp = null;
        }
        
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|date',
            'priority' => 'required|string',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,doc,pdf|max:2048',
            'done' => 'boolean',
            'completed' => 'nullable|date',
        ]);
    
        $file_path = $todo->file_path;
    
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $file_path = $file->store('public/files');
        }
    
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'priority' => $request->priority,
            'done' => $request->filled('done'), // Convert to boolean
            'completed' => $done_timestamp,
            'user_id' => Auth::id(),
            'file_path' => $file_path,
        ];

        $todo->update($data);
        
        return redirect()->route('todos.index');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Todo $todo)
    {
        $deleted_at = Carbon::now();
        $formatted_deleted_at = $deleted_at->format('d/m/Y H:i');
        $deleted_message = "The task " . $todo->title . " was deleted successfully at " . $formatted_deleted_at;

        $todo->delete();
        
        Session::flash('deleted_message', $deleted_message);
        
        return redirect()->route('todos.index');
    }

    public function markAsDone($id)
    {
        $todo = Todo::findOrFail($id);

        $done = $todo->done;
        if(!$done){
            $done_timestamp  = Carbon::now();
        } else{
            $done_timestamp = null;
        }
        $new_value = !$done;

        $todo->update([
            'done' => $new_value,
            'completed' => $done_timestamp
        ]);

        return redirect()->route('todos.index');
    }



}

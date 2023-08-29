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
        $todos = auth()->user()->todos;
    
        return view('todos.index',compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('file')) {

            $file_data = $request->validate([
                'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,doc,pdf|max:2048'
            ]);
            if($file_data){
                $file = $request->file('file');
                $file->store('public/files');
                $file_path = $file->hashName();
            }
        }    

        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|date',
            'priority' => 'required|string',
            'file_path' => $file_path,
            'done' => 'boolean',
            'completed' => 'nullable|date',
        ]);
        
        $data['user_id'] = Auth::id();


        if (isset($data['completed'])) {
            $data['completed'] = Carbon::parse($data['completed']);
        }
    
        $todo = Todo::create($data);
        
        return redirect()->route('todos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        return view('todos.show',compact('todo'));
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
        
        if ($request->hasFile('file')) {

            $file_data = $request->validate([
                'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,doc,pdf|max:2048'
            ]);
            if($file_data){
                $file = $request->file('file');
                $file->store('public/files');
                $file_path = $file->hashName();
            }
        }    
        
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|date',
            'priority' => 'required|string',
            'file_path' => $file_path,
            'done' => 'boolean',
            'completed' => $done_timestamp,
        ]);
    

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

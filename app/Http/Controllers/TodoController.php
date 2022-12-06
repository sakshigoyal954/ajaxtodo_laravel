<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class TodoController extends Controller
{
    public function index()
    {
        $todos= Todo::orderBy('id','desc')->get();
        return view('todo',compact('todos'));
    }

    public function edit(Todo $todo)
    {
        return Response::json($todo);
    }

    public function store(Request $request)
    {
        $msg = "Todo updated successfully.";
        $todo = Todo::find($request->todo_id);
        if(!$todo){
            $todo = new Todo;
            $msg = "Todo added successfully.";
        }
        $todo->name = $request->name;
        $todo->mobile = $request->mobile;
        $todo->save();
        return back()->with('success', $msg);
    }

    public function destroy(Todo $todo)
    {
        $todo=Todo::where('id',$todo->id);
        $todo->delete();
        return Response::json($todo);
    }
}

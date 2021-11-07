<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todos;
use App\Models\Users;
use Redirect;
use Session;

class TodosController extends Controller
{
    public function index(){
        $title = "Laravel";
        return view('home')->with(compact('title'));
    }

    public function error_page(){
        return view('errors.404');
    }

    public function todo(){
        $title = "Todos";
        $todos = Todos::orderBy('todo_id', 'ASC')->get();
        return view('todo.todos')->with(compact('title','todos'));
    }

    public function add_todos(Request $request){
        $todo = new Todos;
        $todo->todo_info = $request->todo_info;
        $todo->todo_check = 0;
        $todo->todo_complete = 0;
        $todo->user_id = 1;
        $todo->save();

        return Redirect::back();
    }

    public function load_todos(Request $request){
        $todo = Todos::orderBy('todo_id', 'asc')->get();
        return response()->json($todo);
    }

    public function edit_todos(Request $request){
        Todos::where('todo_id',$request->id)->update(['todo_info' => $request->info]);
        return Redirect::back();
    }

    public function del_todos(Request $request){
        Todos::where('todo_id',$request->id)->delete();
        return Redirect::back();
    }

    public function done_todos(Request $request){
        foreach($request->id as $id){
            Todos::where('todo_id',$id)->update(['todo_complete' => 1]);
        }
        return Redirect::back();
    }

    public function del_all_todos(Request $request){
        foreach($request->id as $id){
            Todos::where('todo_id',$id)->delete();
        }
        return Redirect::back();
    }
}

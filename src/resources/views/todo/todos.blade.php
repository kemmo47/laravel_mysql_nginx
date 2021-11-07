@extends('layouts')
@section('title', $title)
@section('content')
    <div class="my-3">
        <div class="form_todos">
            <div class="title_todo">
                <h3>Todos</h3>
            </div>
            <div class="input_todo">
                <form action="{{url('/add-todos')}}" method="POST">
                    {{csrf_field()}}
                    <div class="input-group mb-3">
                        <input type="text" id="todo_info" name="todo_info" class="form-control" placeholder="Add Todos">
                        <button type="submit" class="btn btn-success input-group-text" id="basic-addon1">+</button>
                    </div>
                </form>
            </div>
            <div class="mb-2">
                <table class="table">
                    @if(!blank($todos))
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="check_all" class="form-check-input"></th>
                                <th>ID</th>
                                <th>Todo Info</th>
                                <th width="150px"></th>
                            </tr>    
                        </thead>
                        <tbody id="load_todos">
                            @foreach($todos as $todo)
                                <tr class="{{$todo->todo_complete == 1 ? 'active_todo' : ''}} ">
                                    <td><input type="checkbox" id="check_todo_{{$todo->todo_id}}" class="form-check-input check_todos"></td>
                                    <td>{{$todo->todo_id}}</td>
                                    <td>{{$todo->todo_info}}</td>
                                    <td>
                                        <button type="button" onclick="edit_todo('{{$todo->todo_id}}', '{{$todo->todo_info}}')" class="me-2 btn btn-warning">edit</button>
                                        <button type="button" onclick="del_todo('{{$todo->todo_id}}')" class="me-2 btn btn-danger">x</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @endif
                </table>
            </div>
            <div class="action_todo">
                <button class="btn btn-success" onclick="done_todos()">Done All</button>
                <button class="btn btn-danger" onclick="del_all()">Delete All</button>
            </div>
        </div>
    </div>
@endsection
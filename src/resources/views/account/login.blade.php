@extends('layouts')
@section('title', $title)
@section('content')
    <div class="container">
        <div class="form_todos">
            <h1 class="text-warning text-center">Login</h1>
            <form action="/login-todo" method="POST" class="my-3">
                @csrf
                <div class="mb-3">
                    <label for="email_login_todo" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email_login_todo" id="email_login_todo" placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <label for="password_login_todo" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password_login_todo" id="password_login_todo">
                </div>
                <button type="submit" class="btn btn-login">Login</button>
            </form>
        </div>
    </div>
@endsection
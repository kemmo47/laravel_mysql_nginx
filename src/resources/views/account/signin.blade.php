@extends('layouts')
@section('title', $title)
@section('content')
    <div class="container">
        <div class="form_todos">
            <h1 class="text-warning mt-5 text-center">Sign In</h1>
            <form action="/sign-in-todo" method="POST" class="my-3">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name_todo" id="name" placeholder="My Name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control"  name="email_todo" id="email" placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password_todo" id="password">
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password">
                </div>
                <button type="submit" class="btn btn-login">Sign In</button>
            </form>
        </div> 
    </div>
@endsection
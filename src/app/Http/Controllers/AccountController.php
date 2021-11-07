<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Todos;
use App\Models\Users;

class AccountController extends Controller
{
    public function sign_in(){
        $title = "Sign In";
        return view('account.signin')->with(compact('title'));
    }

    public function login(){
        $title = "Login";
        return view('account.login')->with(compact('title'));
    }

    public function sign_in_todo(Request $request){
        $user = new Users;
        $user->user_name = $request->name_todo;
        $user->user_email = $request->email_todo;
        $user->user_password = md5($request->password_todo);
        $user->save();

        $request->session()->flash('success', 'Sign In Success');
        return redirect('login');
    }

    public function login_todo(Request $request){
        $user = Users::where('user_email',$request->email_login_todo)->where('user_password',md5($request->password_login_todo))->first();
        if($user){
            $request->session()->flash('success', 'Login Success');
            Session::put('user',$user);
            return redirect('/');
        }else{
            $request->session()->flash('error', 'Login Error');
            return redirect()->back();
        }
    }

    public function logout(){
        Session::forget('user');
        return redirect('/login');
    }

}

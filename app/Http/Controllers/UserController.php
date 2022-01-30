<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function login(Request $req)
    {
        $user= User::where(['email'=>$req->email])->first();
        // print_r($user);
        if ($user && Hash::check($req->password, $user->password)) 
        {
            $req->session()->put('user', $user);
            return redirect('/');
        }
        else{
            return "Username or password not match";
        }
    }
    function register(Request $req)
    {
        $user= new User;
        $user->name=$req->name;
        $user->email=$req->email;
        $user->password=Hash::make($req->password);
        $user->save();
        // print_r($user);
        return redirect('/login');
    }
}

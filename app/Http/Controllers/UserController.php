<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class UserController extends Controller
{
    public function register(Request $req){

        $user = new User;
        $user->name = $req->input('name');
        $user->email = $req->input('email');
        $user->password = $req->input('password');
        $user->save();
        return $user;
    }

    public function login(Request $req){

        $user = User::where(['email' => $req->email])->first();
        if(!$user || !Hash::check($req->password, $user->password)){
            return response()->json(['error' => "Invalid username or password!"]);
        } else {
            return $user;
        }
    }
}

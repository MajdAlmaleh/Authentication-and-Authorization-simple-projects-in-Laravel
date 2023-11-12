<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $users = json_decode(file_get_contents('C:\Users\Majd Al-Maleh\Desktop\laravel_projects\fifth\users.json'), true);
        foreach ($users as $user) {
            if ($user['email'] == $request->email && $user['password'] == $request->password) {
                $payload = ['email' => $user['email'], 'password' => $user['password']];
                $token = base64_encode(json_encode($payload));
                return response()->json(['token' => $token], 200);
            }
        }
        return response()->json(['error' => 'Invalid credentials'], 401);
    }
    
    
}

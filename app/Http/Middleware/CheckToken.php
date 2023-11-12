<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class CheckToken
{
public function handle($request, Closure $next)
{
    $token = $request->header('X-ITE-TOKEN');

    if (!$token) {
        return response()->json(['error' => 'Token required'], 401);
    }

    $users = json_decode(file_get_contents('C:\Users\Majd Al-Maleh\Desktop\laravel_projects\fifth\users.json'), true);

    $decodedToken = json_decode(base64_decode($token), true);

    foreach ($users as $user) {
        if ($user['email'] == $decodedToken['email'] && $user['password'] == $decodedToken['password']) {
            $request->user = $user;
          //return  response()->json(['error' => $request->user['email']]);
            return $next($request);
        }
    }

    return response()->json(['error' => 'Invalid token'], 401);
}
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login(UserAuthRequest $request){
        try{
            $user = User::where('name', $request->name)->first();
            if($user && Hash::check($request->password, $user->password)){
                $user->remember_token = Str::random();
                $user->save();
                return response()->json(['login' => ['success' => true, 'data' => $user]]);
            }
            return response()->json(['login' => ['success' => false, 'message' => "Nama atau password salah"]],403);
        }catch(\Exception $e){
            return response()->json(['login' => ['success' => false, 'message' => "Ada kesalahan server!"]],500);
        }
    }
}

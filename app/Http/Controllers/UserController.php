<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\FuncCall;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\at;

class UserController extends Controller
{
    public function register(RegisterRequest $request){

        $fields = $request->validated();
        $fields['password'] = Hash::make($fields['password']);
        $user = User::create($fields);
        $token = Auth::login($user);

        return response()->json([
            'token'=> $token,
            'user'=> $user,
            'message'=> 'Registration successfully completed!'
        ]);
    }

    public function login(Request $request){
        $credentials = $request->only(['email', 'password']);
        $token = Auth::attempt($credentials);

        if(!$token){
            return response()->json([
                'message'=> 'Invalid credentials'
            ],401);
        }
        return response()->json([
            'token'=>$token,
            'user'=> Auth::user(),
            'message'=>'You logged in successfully!'
        ]);


    }
    public function logout(){
        Auth::logout();
        return response()->noContent();

    }
    public function refreshToken(){
        try{
            $token = Auth::refresh();
            return [
                'token'=>$token
            ];
        }catch(TokenBlacklistedException $exception){
            return response()->json([
                'message'=> 'Invalid token'
            ],401);
        }

    }
    public function getMyProfile(){
        $user = Auth::user();
        return response()->json($user);

    }
    
}

<?php

namespace App\Http\Controllers\API;
use App\helper\Apihelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request){
     $data=$request->validated();
       $insert=User::create($data);
       if($insert){
           $token['token']=$insert->createToken('token')->plainTextToken;
           $token['name']=$insert->name;
           $token['email']=$insert->email;
           return Apihelper::sendrespone('201','REGISTERED SUCCESSFULLY',$token);
       }
    }
    public function login(LoginRequest $request){
        $data=$request->validated();
        if(!User::where('email', $data['email'])->exists()) {
            return Apihelper::sendrespone('422','login faild','Email does not exist');
        }
        if (!Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            return ApiHelper::sendrespone('422', 'login failed', 'Incorrect password');
        }
        $token['token']=auth()->user()->createToken('token')->plainTextToken;
        $token['name']=Auth::user()->name;
        $token['email']=Auth::user()->email;
        return Apihelper::sendrespone('200','LOGIN SUCCESSFULLY',$token);

    }
    public function logout(request $request){
        $request->user()->tokens()->delete();
        return ApiHelper::sendrespone('200', 'LOGOUT SUCCESSFULLY', null);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;          //statuscodes..

use Auth;

class AuthController extends Controller{

    public function shwUser(){
        return Auth::user();
    }

    public function register(Request $request){

        $position = !empty($request->input('position')) ? $request->input('position') : 'staff';

        $userArray = [
            'fullname' => $request->input('fullname'),
            'email' => $request->input('email'),
            'password' => Hash::make( $request->input('password')),
            'position' => $position
        ];
        return User::create($userArray);
    }

    public function login(Request $request){
        $inputs = $request->only('email', 'password');
        if(!Auth::attempt($inputs)){
            return response(['message' => 'invalid credentials..'], Response::HTTP_UNAUTHORIZED); //status: Response::HTTP_UNAUTHORIZED
        }
        $user = Auth::user();
        //so we return a JWT token..  // echo $user->position;  //['server:update'] ~ using permissions...
        $token = $user->createToken('token')->plainTextToken; //to get the actual string...
        $cookie = cookie('jwt', $token, 60 * 24); //60mins * 24 - 1 day..
        return response(['message' =>  $token ], Response::HTTP_OK)->withCookie($cookie);
    }

    public function logOut(Request $request){
        $cookie = Cookie::forget('jwt');
        return response(['message'=>'Success'])->withCookie($cookie);
    }

}

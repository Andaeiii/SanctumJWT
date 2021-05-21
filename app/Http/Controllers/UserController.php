<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\PReview;

class UserController extends Controller{

/*
      Route::post('/user/add', [UserController::class, 'addUser']);
    Route::get('user/{id}', [UserController::class, 'viewUser']);
    Route::post('user/{id}/update', [UserController::class, 'updateUser']);
    Route::post('user/{id}/delete', [UserController::class, 'deleteUser']);
*/


    public function addUser(Request $request){
        $position = !empty($request->input('position')) ? $request->input('position') : 'staff';
        $userArray = [
            'fullname' => $request->input('fullname'),
            'email' => $request->input('email'),
            'password' => Hash::make( $request->input('password')),
            'position' => $position
        ];
        return User::create($userArray);
    }

    public function viewUser(Request $request, int $id){

        return User::find($id)->first();


    }

    public function updateUser(Request $request, int $id){

        $position = !empty($request->input('position')) ? $request->input('position') : 'staff';
        $userArray = [
            'fullname' => $request->input('fullname'),
            'email' => $request->input('email'),
            'password' => Hash::make( $request->input('password')),
            'position' => $position
        ];
        return User::create($userArray);
    }

    public function deleteUser(Request $request, int $id){

    }

}

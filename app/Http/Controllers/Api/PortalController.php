<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\User\UserRequest;
use App\Models\User\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class PortalController extends Controller
{

    /**
     * Get user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getuser(){
        $users = User::get();
        $usersList = [];
        foreach ($users as $key => $user) {
            $usersList[] = array('id' => $user->id, 'name' => $user->name,'email' => $user->email, 'type' => $user->type);
        }
        return response()->json($usersList);
    }

    public function createUser(Request $request){
        $email = $request->get('email');
        $name = $request->get('name');
        $password = $request->get('password');
        User::where('id' => 1)->update([
            'name'           => $name,
            'email'          => $email,
            'password'       => Hash::make($password),
            'active'         => 1,
            'remember_token' => str_random(10),
            'created_by'     => 1,
            'type'           => 'internal'
        ]);
    }
}

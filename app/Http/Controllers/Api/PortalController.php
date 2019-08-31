<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\User\UserRequest;
use App\Models\User\User;
use App\Http\Controllers\Controller;

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
        return response()->json(['users' => $usersList]);
    }
}

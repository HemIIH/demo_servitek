<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee\Role;

class RoleController extends Controller
{

    public function all()
    {
        return Role::orderBy('name', 'asc')->get();
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\SetpasswordRequest;
use Illuminate\Support\Facades\Hash;
use DB;

class SettingController extends Controller
{
    public function setuppassword(SetpasswordRequest $request){
        $user = \Auth::user();
        $user->update(['password' => Hash::make($request->password)]);

        DB::table('portal_settings')->where(['id' => 1])->update(['is_setup' => 1]);

        return redirect()->to('admin/settings/user')->with('message', trans('admin.LBL_update_password'));
    }
}

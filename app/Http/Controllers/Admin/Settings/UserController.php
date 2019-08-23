<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Requests\User\UserRequest;
use App\Models\User\Role;
use App\Models\User\User;

use App\Http\Controllers\Controller;
use App\Services\Activation\ActivationService;

class UserController extends Controller
{
    /**
     * Show all users.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.settings.user.list');
    }

    /**
     * Create a new user.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data['roles'] = Role::get();

        return view('admin.settings.user.create', $data);
    }

    public function store(UserRequest $request, ActivationService $activation)
    {
        $user = $request->store($password = \Str::random(12));

        $activation->sendActivationMail($user, $password);

        return redirect()->to('admin/settings/user');
    }

    /**
     * Update a user.
     *
     * @param UserRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User $user)
    {
        $request->save($user);

        return redirect()->back();
    }

    /**
     * Show a user.
     *
     * @param User $user
     * @return \Illuminate\View\View
     */
    public function show(User $user)
    {
        $data['roles'] = Role::get();

        return view('admin.settings.user.show', $data)
            ->with('user', $user);
    }
}

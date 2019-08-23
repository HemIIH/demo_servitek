<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\User\UserRequest;
use App\Models\User\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    /**
     * Get data for list view.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getData()
    {
        return User::search()->paginateAndOrder();
    }

    /**
     * Upload user photo.
     *
     * @param UserRequest $request
     * @param User $user
     */
    public function uploadPhoto(UserRequest $request, User $user)
    {
        $this->validate(request(), ['photo' => ['required', 'image', 'max:2000']]);

        $request->upload($user);
    }

    /**
     * Delete employee photo.
     *
     * @param User $user
     */
    public function deletePhoto(User $user)
    {
        \File::delete('uploads/images/photos/' . $user->photo);

        $user->update(['photo' => null]);
    }
}

<?php

namespace App\Http\Requests\User;

use App\Http\Requests\HandleImage;
use App\Http\Requests\Request;
use App\Models\User\User;

class UserRequest extends Request
{
    use HandleImage;

    public function rules()
    {
        return [
            'name'                  => 'sometimes|required',
            'email'                 => 'sometimes|required|email',
            'cc_email'              => 'sometimes|required|email',
            'active'                => 'sometimes|required|in:0,1',
            'role'                  => 'sometimes|required|integer'
        ];
    }

    public function conditionalRules()
    {
        $user = $this->route('user');

        return [
            [
                'fields' => 'name',
                'rules'  => '|unique:users,name,' . ($user ? $user->id : '')
            ],
            [
                'fields' => 'email',
                'rules'  => '|unique:users,email,' . ($user ? $user->id : '')
            ]
        ];
    }

    public function save($user)
    {
        $user->update($this->getData());

        $user->roles()->sync($this->get('role'));
    }

    public function store($password)
    {
        $data = $this->getData();

        $data['password']   = bcrypt($password);
        $data['type'] = 'internal';
        $data['created_by'] = auth()->id();

        $user = User::create($data);

        $user->roles()->sync($this->get('role'));

        return $user;
    }


    protected function getData()
    {
        $data = $this->only(['name', 'email', 'cc_email', 'active']);

        $data['locations'] = $this->get('locations') ? json_encode($this->get('locations')) : null;

        return $data;
    }

    public function upload($user)
    {
        if (! $this->hasFile('photo'))
            return;

        $filename = $this->processImage($this->file('photo'));

        $user->update([
            'photo' => $filename
        ]);

        return $filename;
    }

    protected function processImage($image)
    {
        $filename = $this->createFilename($image);

        $this->uploadImage($image, 120, 120, 'uploads/images/photos/user/' . $filename);

        return $filename;
    }
}

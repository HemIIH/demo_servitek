<?php

namespace App\Http\Controllers\Admin\Settings;


use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserSignatureRequest;
use App\Http\Requests\User\UserAddressRequest;
use App\Http\Requests\User\UserCredentialsRequest;
use App\Models\Settings\Textblocks;

class AccountController extends Controller
{

    /**
     * Edit user credentials.
     *
     * @return \Illuminate\View\View
     */
    public function editCredentials()
    {
        $data['user'] = auth()->user();

        return view('admin.settings.account.credentials', $data)
                ->with('title', trans('admin.Kontodaten bearbeiten'));
    }

    /**
     * Update user credentials.
     *
     * @param UserCredentialsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateCredentials(UserCredentialsRequest $request)
    {
        if(! $request->save()) {
            error('wrong_password');

            return redirect()->back();
        }

        success('credentials_updated');

        return redirect()->back();
    }

    /**
     * Edit a user's custom address.
     *
     * @return \Illuminate\View\View
     */
    public function editAddress()
    {
        $data['user'] = auth()->user();

        $data['address'] = Textblocks::whereIn('name', ['street', 'postal_code', 'city'])->pluck('value', 'name');

        return view('admin.settings.account.address', $data)
            ->with('title', trans('admin.Adresse bearbeiten'));
    }

    /**
     * Store a user's custom address.
     *
     * @param UserAddressRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAddress(UserAddressRequest $request)
    {
        $request->save();
        success('user_edited');

        return redirect()->back();
    }
    /**
     * Edit a user's signature.
     *
     * @return \Illuminate\View\View
     */
    public function editSignature()
    {
        $data['user'] = auth()->user();
        $data['signature'] = Textblocks::where('name', 'signature')->first();

        return view('admin.settings.account.signature', $data)
            ->with('title', trans('admin.Signatur bearbeiten'));
    }

    /**
     * Store a user's signature.
     *
     * @param UserSignatureRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSignature(UserSignatureRequest $request)
    {
        $request->save();
        success('user_edited');

        return redirect()->back();
    }
}

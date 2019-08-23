<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;

class ContractController extends Controller
{
    public function general($name)
    {
        $data['text'] = \DB::table('legal_texts')
            ->where('type', 'igz')
            ->where('sub_type', 'Manteltarifvertrag')
            ->where('section', $name)
            ->first();

        return view('admin.settings.misc.contract.general', $data);
    }

}

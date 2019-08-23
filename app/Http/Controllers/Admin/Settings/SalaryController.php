<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;

class SalaryController extends Controller
{
    public function general($name)
    {
        $data['text'] = \DB::table('legal_texts')
            ->where('type', 'igz')
            ->where('sub_type', 'Entgelttarifvertrag')
            ->where('section', $name)
            ->first();

        return view('admin.settings.misc.salaries.general', $data);
    }

    public function pay()
    {
        $data['regions'] = \DB::table('legal_salaries')->pluck('region')->unique();
        $data['dates']   = \DB::table('legal_salaries')->orderBy('valid_from')->pluck('valid_from')->unique();

        return view('admin.settings.misc.salaries.pay', $data);
    }

}

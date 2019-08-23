<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Controllers\Controller;

class SalaryController extends Controller
{
    public function get()
    {
        try {
            $entry = \DB::table('legal_salaries')
                ->where('region', request('region'))
                ->where('salary_group', request('salary_group'))
                ->where('valid_from', '<=', toSql(request('valid_from')))
                ->orderBy('valid_from', 'desc')
                ->first();

            return response()->json([
                'wage'  => money($entry->base_amount, false),
                'bonus' => money($entry->extra_pay, false)
            ]);
        } catch(\Exception $e) {
            return $e;
        }
    }

    public function getGroup()
    {
        return \DB::table('legal_salaries')
            ->where('region', request('region'))
            ->where('valid_from', request('valid_from'))
            ->get();
    }
}

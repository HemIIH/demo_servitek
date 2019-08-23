<?php

namespace App\Http\Controllers\Api\Employee;

use App\Models\Employee\Employee;
use App\Http\Controllers\Controller;

class SignatureController extends Controller
{

    /**
     * Upload signature.
     *
     * @param Employee $employee
     * @return string
     *
     */
    public function create(Employee $employee)
    {
        $data = request('data');
        $image = base64_decode(explode(",", $data)[1]);

        $filename = 'signature_employee_' . $employee->id . '.png';
        \Image::make($image)->save(public_path('uploads/images/signature/' . $filename));

        $employee->update([
            'signature' => $filename
        ]);

        return $filename;
    }

    /**
     * Delete employee signature.
     *
     * @param Employee $employee
     */
    public function delete(Employee $employee)
    {
        \File::delete(public_path('/uploads/images/signature/' . $employee->signature));

        $employee->update([
            'signature' => null
        ]);
    }


}

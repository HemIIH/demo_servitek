<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\Request;

class SendAttendanceListRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'contacts'   => 'required',
            'contacts.*' => 'email',
            'subject'    => 'required',
            'body'       => 'required',
        ];
    }
}

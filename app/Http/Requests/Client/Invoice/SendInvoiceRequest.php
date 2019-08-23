<?php

namespace App\Http\Requests\Client\Invoice;

use App\Http\Requests\Request;

class SendInvoiceRequest extends Request
{
    public function rules()
    {
        return [
            'contacts'     => 'required',
            'contacts.*'   => 'email',
            'mail_subject' => 'required',
            'mail_body'    => 'required'
        ];
    }
}

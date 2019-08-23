<?php

namespace App\Http\Controllers\Api\Employee;

use App\Models\Employee\Employee;
use App\Services\Helper\HasDocuments;
use App\Http\Requests\Employee\DocumentRequest;
use App\Http\Controllers\Controller;

class DocumentsController extends Controller
{
    use HasDocuments;

    protected $uploadPath = 'documents/employees';

    public function createPension(DocumentRequest $request, Employee $employee)
    {
        $data = $request->all();

        $pdf = \PDF::setPaper('A4')
            ->loadView('pdf.documents.pension_insurance_obligation', ['employee' => $employee], $data)
            ->output();

        $path = 'documents/employees/' . date('Y_m_d') . '_MA-' . $employee->id . '_' . request('name') . '.pdf';

        \Storage::put($path, $pdf);

        $employee->documents()->create([
            'name'        => 'Befreiung Renterversicherung',
            'path'        => $path,
            'created_by'  => auth()->user()->id
        ]);
    }

}

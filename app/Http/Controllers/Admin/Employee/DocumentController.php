<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Employee\Employee;

class DocumentController extends Controller
{

    /**
     * Show personal data of an employee.
     *
     * @param Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function baseData(Employee $employee)
    {
        return \PDF::setPaper('A4')
            ->loadView('pdf.documents.base_data', ['employee' => $employee])
            ->stream('Stammdaten.pdf');
    }

    /**
     * Show document/file.
     *
     * @param Employee $employee
     * @param Document $document
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee, Document $document)
    {
        if ($document->owner->id != $employee->id)
            return response('Keine Berechtigung', 404);
        
        $file = \Storage::get($document->path);

        return response($file, 200)->header('Content-Type', \Storage::mimeType($document->path));
    }

}

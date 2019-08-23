<?php

namespace App\Http\Requests\Employee;

use App\Models\Settings\Repos\TemplateRepository;

class DocumentRequest extends \App\Http\Requests\Document\DocumentRequest
{
    protected $template;

    public function __construct(TemplateRepository $template)
    {
        parent::__construct();

        $this->template = $template;
    }

    protected function storeDocument($template, $employee)
    {
        $text = $this->getTemplate($template->text, $employee);

        $pdf = \PDF::setPaper('A4')
            ->loadView('pdf.documents.' . $template->type, compact('template', 'text', 'employee'))
            ->output();

        $path = 'documents/employees/' . date('Y_m_d') . '_MA-' . $employee->id . '_' . $template->name . '.pdf';

        \Storage::put($path, $pdf);

        return $path;
    }

    protected function getTemplate($template, $employee)
    {
        $placeholder = $this->getPlaceholder($employee);

        foreach ($placeholder as $key => $value) {
            $template = str_replace('{' . strtoupper($key) . '}', $value, $template);
        }

        return $template;
    }

    protected function getPlaceholder($employee)
    {
        $employee = collect($employee)->only(
            'first_name',
            'last_name',
            'street',
            'postal_code',
            'city',
            'sex',
            'mobile',
            'email'
        );

        $placeholder = collect(request()->all())->merge($employee)->toArray();

        $placeholder['salutation'] = $employee['sex'] == 'm' ? 'Sehr geehrter Herr' : 'Sehr geehrte Frau';

        return $placeholder;
    }
}

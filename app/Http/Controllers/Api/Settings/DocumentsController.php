<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Requests\Textblock\TemplateRequest;

use App\Http\Controllers\Controller;
use App\Models\Settings\Repos\TemplateRepository;

class DocumentsController extends Controller
{
    protected $template;

    public function __construct(TemplateRepository $template)
    {
        $this->template = $template;
    }

    public function update(TemplateRequest $request, $name)
    {
        $request->save($name);
    }

    public function getByName($name)
    {
        return $this->template->byName($name);
    }

    public function createDocument($name, $employee)
    {
        $template = $this->getTemplate($name, $employee);

        $pdf = \PDF::setPaper('A4')
            ->loadView('pdf.documents.' . $name, compact('template', 'employee'));

        return $pdf->stream('Vorschau.pdf');
    }

    /**
     * Prepare template.
     *
     * @param string $name Name of template.
     * @param $employee
     * @return mixed
     */
    protected function getTemplate($name, $employee)
    {
        $template = $this->getByName($name)->value;

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

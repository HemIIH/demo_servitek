<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Textblock\TemplateRequest;
use App\Models\Settings\Repos\TemplateRepository;


class DocumentController extends Controller
{
    protected $template;

    public function __construct(TemplateRepository $template)
    {
        $this->template = $template;
    }

    /**
     * Edit template for document with given name.
     *
     * @param $name
     * @return \Illuminate\View\View
     */
    public function edit($name)
    {
        $data['template'] = $this->template->byName($name);

        return view('admin.settings.textblocks.documents.edit', $data);
    }

    /**
     * Update template for document with given name.
     *
     * @param TemplateRequest $request
     * @param $name
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TemplateRequest $request, $name)
    {
        $request->save($name);

        return redirect()->back();
    }

}

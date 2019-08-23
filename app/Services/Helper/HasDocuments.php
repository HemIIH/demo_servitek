<?php

namespace App\Services\Helper;

use App\Models\Document;
use App\Http\Requests\Employee\DocumentRequest;

trait HasDocuments
{

    public function getAll($resource)
    {
        return $resource->documents()->with('user')->get();
    }

    public function create(DocumentRequest $request, $resource, $name)
    {
        $request->store($resource, $name);
    }

    public function update(DocumentRequest $request, $resource, Document $document)
    {
        $request->save($resource, $document);
    }

    public function send($resource, Document $document)
    {
        \Mail::send(new \App\Mail\Document($document));
    }

    public function upload($resource)
    {
        $this->validate(request(), [
            'file'     => 'required|mimes:jpeg,bmp,png,pdf|max:2000',
            'name'     => 'required',
            'valid_to' => 'date|date_format:"d.m.Y"'
        ]);

        if (! request()->hasFile('file'))
            return;

        $name = $this->getFileName($resource);

        \Storage::putFileAs($this->uploadPath, request()->file('file'), $name);

        $resource->documents()->create([
            'name'        => request('name'),
            'path'        => $this->uploadPath . '/' . $name,
            'valid_to'    => request('valid_to'),
            'created_by'  => auth()->user()->id
        ]);
    }

    public function delete($resource, $id)
    {
        try {
            $document = $resource->documents()->where('id', $id)->firstOrFail();

            \Storage::delete($document->path);
            $document->delete();
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    protected function getFileName($resource)
    {
        return date('Y_m_d') . '_' . $resource->id . '_' . request('name') . '.' . request()->file('file')->getClientOriginalExtension();;
    }

}
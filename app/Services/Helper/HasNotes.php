<?php

namespace App\Services\Helper;

use App\Http\Requests\Note\NoteRequest;

trait HasNotes
{

    /**
     * Get all notes to a resource.
     *
     * @param $resource
     * @return mixed
     */
    public function getNotes($resource)
    {
        return $resource->notes()->with('user')->get();
    }

    /**
     * Add a note to a ressource.
     *
     * @param NoteRequest $request
     * @param $resource
     */
    public function addNote(NoteRequest $request, $resource)
    {
        $request->store($resource);
    }

    /**
     * Update a note to a ressource.
     *
     * @param NoteRequest $request
     * @param $resource
     */
    public function updateNote(NoteRequest $request, $resource)
    {
        $request->save($resource);
    }

    /**
     * Delete a note from a ressource.
     *
     * @param $resource
     */
    public function deleteNote($resource, $id)
    {
        $resource->notes()
            ->find($id)
            ->delete();
    }

}
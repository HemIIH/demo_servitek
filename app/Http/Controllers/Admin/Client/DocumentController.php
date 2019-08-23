<?php

namespace App\Http\Controllers\Admin\Client;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Client\Client;

class DocumentController extends Controller
{

    /**
     * Show document/file.
     *
     * @param Client $client
     * @param Document $document
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client, Document $document)
    {
        if ($document->owner->id != $client->id)
            return response('Keine Berechtigung', 404);

        $file = \Storage::get($document->path);

        return response($file, 200)->header('Content-Type', \Storage::mimeType($document->path));
    }

}

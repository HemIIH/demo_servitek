<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Requests\Textblock\TextblockRequest;
use App\Models\Settings\Repos\TextblocksRepository;

use App\Http\Controllers\Controller;

class TextblocksController extends Controller
{

    public function getByType(TextblocksRepository $textblocks, $type)
    {
        return $textblocks->byType($type);
    }

    public function update(TextblockRequest $request, $type)
    {
        $request->save($type);
    }

}

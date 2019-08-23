<?php

namespace App\Http\Controllers\Api\Client;

use App\Services\Helper\HasDocuments;
use App\Http\Controllers\Controller;

class DocumentsController extends Controller
{
    use HasDocuments;

    protected $uploadPath = 'documents/clients';

}

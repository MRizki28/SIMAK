<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\TypeDocument\TypeDocumentRequest;
use App\Repositories\TypeDocumentRepositories;
use App\Traits\HttpResponseTraits;
use Illuminate\Http\Request;

class TypeDocumentController extends Controller
{
    protected $typeDocumentRepositories;
    use HttpResponseTraits;

    public function __construct(TypeDocumentRepositories $typeDocumentRepositories)
    {
        $this->typeDocumentRepositories = $typeDocumentRepositories;
    }

    public function getAllData()
    {
        return $this->typeDocumentRepositories->getAllData();
    }

    public function createData(TypeDocumentRequest $request)
    {
        return  $this->typeDocumentRepositories->createData($request);
    }
}

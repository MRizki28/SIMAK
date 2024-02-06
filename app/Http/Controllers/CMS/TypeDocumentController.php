<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
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
        $data = $this->typeDocumentRepositories->getAllData();
        if ($data->isEmpty()) {
            return $this->dataNotFound();
        }else{
            return $this->success($data);
        }
    }
}

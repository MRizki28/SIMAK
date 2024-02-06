<?php

namespace App\Repositories;

use App\Http\Requests\TypeDocument\TypeDocumentRequest;
use App\Interfaces\TypeDocumentInterfaces;
use App\Models\TypeDocumentModel;
use App\Traits\HttpResponseTraits;

class TypeDocumentRepositories implements TypeDocumentInterfaces
{
    protected $typeDocumentModel;
    use HttpResponseTraits;

    public function __construct(TypeDocumentModel $typeDocumentModel)
    {
        $this->typeDocumentModel = $typeDocumentModel;
    }

    public function getAllData()
    {
        $data = $this->typeDocumentModel->all();
        if ($data->isEmpty()) {
            return $this->dataNotFound();
        }else{
            return $this->success($data);
        }
    }

    public function createData($request)
    {
        try {
            $data = $this->typeDocumentModel->create($request->all());
            return $this->success($data);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }
}
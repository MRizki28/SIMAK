<?php

namespace App\Interfaces;

use App\Http\Requests\TypeDocument\TypeDocumentRequest;

interface TypeDocumentInterfaces {
    public function getAllData();
    public function createData(TypeDocumentRequest $request);
}
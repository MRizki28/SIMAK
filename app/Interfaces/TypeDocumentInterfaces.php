<?php

namespace App\Interfaces;

use App\Http\Requests\TypeDocument\TypeDocumentRequest;
use Illuminate\Http\Request;

interface TypeDocumentInterfaces {
    public function getAllData();
    public function createData(TypeDocumentRequest $request);
    public function getDataById($id);
    public function getDataByUser();
    public function updateData(TypeDocumentRequest $request, $id);
    public function deleteData($id);
    public function getDataByUserYear(Request $request);
}
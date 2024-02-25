<?php

namespace App\Interfaces;

use App\Http\Requests\Position\PositionRequest;

interface PositionInterfaces
{
    public function getAllData();
    public function createData(PositionRequest $request);
    public function getDataById($id);
    public function updateData(PositionRequest $request, $id);
    public function deleteData($id);
}
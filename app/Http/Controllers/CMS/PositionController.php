<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\Position\PositionRequest;
use App\Repositories\PositionRepositories;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    protected $positionRepositories;

    public function __construct(PositionRepositories $positionRepositories)
    {
        $this->positionRepositories = $positionRepositories;
    }

    public function getAllData()
    {
        return $this->positionRepositories->getAllData();
    }

    public function createData(PositionRequest $request)
    {
        return $this->positionRepositories->createData($request);
    }

    public function getDataById($id)
    {
        return $this->positionRepositories->getDataById($id);
    }

    public function updateData(PositionRequest $request, $id)
    {
        return $this->positionRepositories->updateData($request, $id);
    }

    public function deleteData($id)
    {
        return $this->positionRepositories->deleteData($id);
    }
}

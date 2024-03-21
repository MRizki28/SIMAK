<?php


namespace App\Repositories;

use App\Http\Requests\Position\PositionRequest;
use App\Interfaces\PositionInterfaces;
use App\Models\PositionModel;
use App\Traits\HttpResponseTraits;

class PositionRepositories implements PositionInterfaces
{
    protected $positionModel;
    use HttpResponseTraits;

    public function __construct(PositionModel $positionModel)
    {
        $this->positionModel = $positionModel;
    }

    public function getAllData()
    {
        $data = $this->positionModel->all();
        if ($data->isEmpty()) {
            return $this->dataNotFound();
        } else {
            return $this->success($data);
        }
    }
}

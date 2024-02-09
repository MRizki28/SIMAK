<?php

namespace App\Repositories;

use App\Interfaces\YearInterfaces;
use App\Models\YearModel;
use App\Traits\HttpResponseTraits;

class YearRepositories implements YearInterfaces
{
    protected $yearModel;
    use HttpResponseTraits;

    public function __construct(YearModel $yearModel)
    {
        $this->yearModel = $yearModel;
    }

    public function getAllData()
    {
        $data = $this->yearModel::all();
        if ($data->isEmpty()) {
            return $this->dataNotFound();
        } else {
            return $this->success($data);
        }
    }
}

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

    public function createData(PositionRequest $request)
    {
        try {
            $reqAll = $request->all();
            foreach ($reqAll as $key => $value) {
                $reqAll[$key] = htmlspecialchars($value);
            }
            $data = $this->positionModel->create($reqAll);
            return $this->success($data);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function getDataById($id)
    {
        $data = $this->positionModel->where('id', $id)->first();

        if (!$data) {
            return $this->idOrDataNotFound();
        } else {
            return $this->success($data);
        }
    }

    public function updateData(PositionRequest $request, $id)
    {
        try {
            $data = $this->positionModel->where('id', $id)->first();
            $data->code_position = htmlspecialchars($request->input('code_position'));
            $data->position = htmlspecialchars($request->input('position'));
            $data->save();

            return $this->success($data);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function deleteData($id)
    {
        try {
            $data = $this->positionModel->where('id', $id)->first();
            if (!$data) {
                return $this->idOrDataNotFound();
            } else {
                $data->delete();
            }
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }
}

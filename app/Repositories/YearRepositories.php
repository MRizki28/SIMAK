<?php

namespace App\Repositories;

use App\Interfaces\YearInterfaces;
use App\Models\YearModel;
use App\Traits\HttpResponseTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function getPersonalYear()
    {
        try {
            $user = Auth::user()->id;
            $data = $this->yearModel->whereHas('arsip', function ($query) use ($user) {
                $query->where('id_user', $user);
            })->get();
            return $this->success($data);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function getEntireYear(Request $request)
    {
        try {
            $user = $request->query('id_user');
            $data = $this->yearModel->whereHas('arsip', function ($query) use ($user) {
                $query->where('id_user', $user)
                    ->where('is_private', '!=', true);
            })->get();
            if (!$data) {
                return $this->dataNotFound();
            } else {
                return $this->success($data);
            }
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }
}

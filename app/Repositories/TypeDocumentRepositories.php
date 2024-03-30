<?php

namespace App\Repositories;

use App\Http\Requests\TypeDocument\TypeDocumentRequest;
use App\Interfaces\TypeDocumentInterfaces;
use App\Models\TypeDocumentModel;
use App\Traits\HttpResponseTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        } else {
            return $this->success($data);
        }
    }

    public function getDataByUser()
    {
        try {
            $user  = Auth::user()->id;
            $data = $this->typeDocumentModel->where('id_user', $user)->get();
            return $this->success($data);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function getDataByUserYear(Request $request)
    {
        try {
            $id_year = $request->query('id_year');
            $user = Auth::user()->id;
            $data = $this->typeDocumentModel->whereHas('arsip', function ($query) use ($user, $id_year) {
                $query->where('id_user', $user)
                    ->where('id_year', $id_year);
            })->get();
            return $this->success($data);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function getDataEntireTypeDocument(Request $request)
    {
        try {
            $id_year = $request->query('id_year');
            $id_user = $request->query('id_user');
            $data = $this->typeDocumentModel->whereHas('arsip', function ($query) use ($id_user, $id_year) {
                $query->where('id_user', $id_user)
                    ->where('id_year', $id_year);
            })->get();
            return $this->success($data);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }


    public function createData(TypeDocumentRequest $request)
    {
        try {
            $user = Auth::user();
            $data = new $this->typeDocumentModel;
            $data->id_user = $user->id;
            $data->name_type_document = $request->input('name_type_document');
            $data->save();
            return $this->success($data);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th->getMessage()
            ]);
        }
    }

    public function getDataById($id)
    {
        $data = $this->typeDocumentModel::where('id', $id)->first();
        if (!$data) {
            return $this->idOrDataNotFound();
        } else {
            return $this->success($data);
        }
    }

    public function updateData(TypeDocumentRequest $request, $id)
    {
        try {
            $data = $this->typeDocumentModel::where('id', $id)->first();
            $data->name_type_document = htmlspecialchars($request->input('name_type_document'));
            $data->save();
            return $this->success($data);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function deleteData($id)
    {
        try {
            $data = $this->typeDocumentModel::where('id', $id)->first();
            if (!$data) {
                return $this->idOrDataNotFound();
            } else {
                $data->delete();
                return $this->delete();
            }
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }
}

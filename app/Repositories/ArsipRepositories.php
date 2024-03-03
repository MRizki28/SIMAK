<?php

namespace App\Repositories;

use App\Http\Requests\Arsip\ArsipRequest;
use App\Interfaces\ArsipInterfaces;
use App\Models\ArsipModel;
use App\Models\FileModel;
use App\Traits\HttpResponseTraits;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArsipRepositories implements ArsipInterfaces
{
    protected $arsipModel;
    protected $fileModel;

    use HttpResponseTraits;

    public function __construct(ArsipModel $arsipModel, FileModel $fileModel)
    {
        $this->arsipModel = $arsipModel;
        $this->fileModel = $fileModel;
    }

    public function list(Request $request)
    {
        $search = $request->input('search');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $limit = $request->input('limit') ? $request->input('limit') : 10;
        $page = (int) $request->input('page', 1);

        $query = $this->arsipModel::query()->with('typeDocument');

        if ($startDate && $endDate) {
            $query->whereBetween('date_arsip', [$startDate, $endDate]);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('code_arsip', 'like', '%' . $search . '%')
                    ->orWhere('date_arsip', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhereHas('typeDocument', function ($query) use ($search) {
                        $query->where('name_type_document', 'like', '%' . $search . '%');
                    });
            });
        }

        $data = $query->paginate($limit, ['*'], 'page', $page);

        if ($data->isEmpty()) {
            return $this->dataNotFound();
        } else {
            return $this->success($data);
        }
    }

    public function createData(ArsipRequest $request)
    {
        try {
            $user = Auth::user()->id;
            $data = new $this->arsipModel;
            $data->id_user = $user;
            $data->id_type_document = $request->input('id_type_document');
            $data->id_year = $request->input("id_year");
            $data->code_arsip = $request->input("code_arsip");
            $data->date_arsip = Carbon::parse($request->input('date_arsip'))->format('Y-m-d');
            $data->description = htmlspecialchars($request->input("description"));
            $data->in_or_out_arsip = $request->input('in_or_out_arsip');
            $data->is_private = $request->has('is_private') ? true : false;
            $data->save();

            $tbFile = [];
            if ($request->hasFile('file_arsip')) {
                foreach ($request->file('file_arsip') as $key => $file) {
                    $extention = $file->getClientOriginalExtension();
                    $filename  = 'ARSIP-' . Str::uuid() . '.' . $extention;
                    $file->move(public_path('uploads/arsip/'), $filename);

                    $tbFile[$key] = new $this->fileModel;
                    $tbFile[$key]->id_arsip = $data->id;
                    $tbFile[$key]->file_arsip = $filename;
                    $tbFile[$key]->save();
                }
            }

            return $this->success([
                'data' => $data,
                'file' => $tbFile
            ]);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function getFile($id_user, $id_arsip)
    {
        try {
            $data = FileModel::where('id_arsip', $id_arsip)
                ->whereHas('getArsip', function ($query) use ($id_user) {
                    $query->where('id_user', $id_user);
                })
                ->get();
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

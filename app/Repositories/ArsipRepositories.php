<?php

namespace App\Repositories;

use App\Http\Requests\Arsip\ArsipRequest;
use App\Interfaces\ArsipInterfaces;
use App\Models\ArsipModel;
use App\Traits\HttpResponseTraits;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArsipRepositories implements ArsipInterfaces
{
    protected $arsipModel;

    use HttpResponseTraits;

    public function __construct(ArsipModel $arsipModel)
    {
        $this->arsipModel = $arsipModel;
    }

    public function list(Request $request)
    {
        $search = $request->input('search');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $limit = $request->input('limit') ? $request->input('limit') : 1;
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
            $data = new $this->arsipModel;
            $data->id_type_document = $request->input('id_type_document');
            $data->id_year = $request->input("id_year");
            $data->code_arsip = $request->input("code_arsip");
            if ($request->hasFile('file_arsip')) {
                $file = $request->file('file_arsip');
                $extention = $file->getClientOriginalExtension();
                $filename  = 'ARSIP-' . Str::uuid() . '.' . $extention;
                $file->move(public_path('uploads/arsip/'), $filename);
                $data->file_arsip = $filename;
            }
            $data->date_arsip = Carbon::parse($request->input('date_arsip'))->format('Y-m-d');
            $data->description = htmlspecialchars($request->input("description"));
            $data->in_or_out_arsip = $request->input('in_or_out_arsip');
            $data->is_private = $request->has('is_private') ? true : false;
            $data->save();
            return $this->success($data);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }
}

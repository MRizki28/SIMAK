<?php

namespace App\Repositories;

use App\Interfaces\ArsipInterfaces;
use App\Models\ArsipModel;
use App\Models\TypeDocumentModel;
use App\Traits\HttpResponseTraits;
use Illuminate\Http\Request;

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
}

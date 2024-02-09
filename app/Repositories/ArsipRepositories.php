<?php

namespace App\Repositories;

use App\Interfaces\ArsipInterfaces;
use App\Models\ArsipModel;
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
        $limit     = $request->input('limit') ? $request->input('limit') : 10;
        $page      = (int) $request->input('page', 1);

        $fieldsToSearch = [
            'code_arsip',
            'date_arsip',
            'description',
            'id_type_document',
            'id_year'
        ];

        $query = $this->arsipModel::query();

        if ($startDate && $endDate) {
            $query->whereBetween('date_arsip', [$startDate, $endDate]);
        }

        if ($search) {
            $query->where(function ($q) use ($fieldsToSearch, $search) {
                foreach ($fieldsToSearch as $data) {
                    $q->orWhere($data, 'like', '%' . $search . '%');
                }
            });
        }

        $data = $query->paginate($limit, ['*'], 'page', $page);
        if ($data->isEmpty()) {
            return $this->dataNotFound();
        }else{
            return $this->success($data);
        }
    }
}

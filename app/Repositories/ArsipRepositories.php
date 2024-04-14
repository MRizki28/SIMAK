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
use Illuminate\Support\Facades\File;

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
        $limit = $request->input('limit') ? $request->input('limit') : 1;
        $page = (int) $request->input('page', 1);

        $user = Auth::user()->id;

        $query = $this->arsipModel::query()->with('typeDocument', 'user', 'year')->where('id_user', $user);

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
                    })->orWhereHas('user', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })->orWhereHas('year', function ($query) use ($search) {
                        $query->where('year', 'like', '%' . $search . '%');
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
            $data->is_private = $request->has('is_private') && $request->input('is_private') == 'true' ? true : false;

            $tbFile = [];
            if ($request->hasFile('file_arsip')) {
                foreach ($request->file('file_arsip') as $key => $file) {
                    $extention = $file->getClientOriginalExtension();
                    if (!in_array($extention, ['png', 'jpg', 'jpeg', 'pdf', 'docx', 'doc', 'xlsx', 'xls', 'csv'])) {
                        return response()->json([
                            'code' => 400,
                            'message' => 'Invalid file extention'
                        ]);
                    } else {
                        $data->save();
                        $filename  = 'ARSIP-' . Str::random(5) . '.' . $extention;
                        $file->move(public_path('uploads/arsip/'), $filename);
                        $tbFile[$key] = new $this->fileModel;
                        $tbFile[$key]->id_arsip = $data->id;
                        $tbFile[$key]->file_arsip = $filename;
                        $tbFile[$key]->save();
                    }
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

    public function getDataArsipByPersonal(Request $request)
    {
        try {
            $search = $request->input('search');
            $startDate = $request->input('startDate');
            $endDate = $request->input('endDate');
            $limit = $request->input('limit') ? $request->input('limit') : 10;
            $page = (int) $request->input('page', 1);

            $user = Auth::user()->id;
            $id_year = $request->query('id_year');
            $id_type_document = $request->query('id_type_document');
            $query = $this->arsipModel::query()->with('typeDocument', 'user', 'year')->where('id_user', $user)->where('id_type_document', $id_type_document)->where('id_year', $id_year);

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
                        })->orWhereHas('user', function ($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%');
                        })->orWhereHas('year', function ($query) use ($search) {
                            $query->where('year', 'like', '%' . $search . '%');
                        });
                });
            }

            $data = $query->paginate($limit, ['*'], 'page', $page);
            if ($data->isEmpty()) {
                return $this->dataNotFound();
            } else {
                return $this->success($data);
            }
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function getDataArsipByEntire(Request $request)
    {
        try {
            $search = $request->input('search');
            $startDate = $request->input('startDate');
            $endDate = $request->input('endDate');
            $limit = $request->input('limit') ? $request->input('limit') : 10;
            $page = (int) $request->input('page', 1);

            $id_user = $request->query('id_user');
            $id_year = $request->query('id_year');
            $id_type_document = $request->query('id_type_document');
            $query = $this->arsipModel::query()
                ->with('typeDocument', 'user', 'year')
                ->where('id_user', $id_user)
                ->where('id_type_document', $id_type_document)
                ->where('id_year', $id_year)
                ->where('is_private', 0); 

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
                        })->orWhereHas('user', function ($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%');
                        })->orWhereHas('year', function ($query) use ($search) {
                            $query->where('year', 'like', '%' . $search . '%');
                        });
                });
            }

            $data = $query->paginate($limit, ['*'], 'page', $page);
            if ($data->isEmpty()) {
                return $this->dataNotFound();
            } else {
                return $this->success($data);
            }
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function updateData(ArsipRequest $request, $id)
    {
        try {
            $user = Auth::user()->id;
            $data = $this->arsipModel->findOrFail($id);
            $data->id_user = $user;
            $data->id_type_document = $request->input('id_type_document');
            $data->id_year = $request->input("id_year");
            $data->code_arsip = $request->input("code_arsip");
            $data->date_arsip = Carbon::parse($request->input('date_arsip'))->format('Y-m-d');
            $data->description = htmlspecialchars($request->input("description"));
            $data->in_or_out_arsip = $request->input('in_or_out_arsip');
            $data->is_private = $request->has('is_private') && $request->input('is_private') == 'true' ? true : false;
            $data->save();

            return $this->success([
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function deleteData($id)
    {
        try {
            $data = $this->arsipModel->where('id', $id)->first();

            $fileArsip = $this->fileModel->where('id_arsip', $id)->get();
            foreach ($fileArsip as $file) {
                $location = public_path('uploads/arsip/') . $file->file_arsip;
                $file->delete();

                if (File::exists($location)) {
                    File::delete($location);
                }
            }
            $data->delete();

            return $this->delete();
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function getDataById($id)
    {
        try {
            $data = $this->arsipModel->with('getFile')->where('id', $id)->first();
            if (!$data) {
                return $this->idOrDataNotFound();
            } else {
                return $this->success($data);
            }
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function deleteFile($id)
    {
        try {
            $data = $this->fileModel->where('id', $id)->first();
            $location = public_path('uploads/arsip/') . $data->file_arsip;
            $data->delete();

            if (File::exists($location)) {
                File::delete($location);
            }
            return $this->delete();
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function addFile(ArsipRequest $request)
    {
        try {
            if ($request->hasFile('file_arsip')) {
                foreach ($request->file('file_arsip') as $file) {
                    $extention = $file->getClientOriginalExtension();
                    if (!in_array($extention, ['png', 'jpg', 'jpeg', 'pdf', 'docx', 'doc', 'xlsx', 'xls', 'csv'])) {
                        return response()->json([
                            'message' => 'Invalid file extention'
                        ]);
                    }
                    $filename  = 'ARSIP-' . Str::random(5) . '.' . $extention;
                    $file->move(public_path('uploads/arsip/'), $filename);
                    $data = new $this->fileModel;
                    $data->file_arsip = $filename;
                    $data->id_arsip = $request->input('id_arsip');
                    $data->save();
                }
            }

            return $this->success('Files uploaded successfully.');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }
}

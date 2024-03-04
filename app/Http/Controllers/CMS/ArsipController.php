<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\Arsip\ArsipRequest;
use App\Repositories\ArsipRepositories;
use Illuminate\Http\Request;

class ArsipController extends Controller
{
    protected $arsipRepositories;

    public function __construct(ArsipRepositories $arsipRepositories)
    {
        $this->arsipRepositories = $arsipRepositories;
    }

    public function list(Request $request)
    {
        return $this->arsipRepositories->list($request);
    }

    public function createData(ArsipRequest $request)
    {
        return $this->arsipRepositories->createData($request);
    }

    public function getFile($id_user, $id_arsip)
    {
        return $this->arsipRepositories->getFile($id_user, $id_arsip);
    }

    public function updateData(ArsipRequest $request, $id)
    {
        return $this->arsipRepositories->updateData($request, $id);
    }
}

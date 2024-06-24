<?php

namespace App\Interfaces;

use App\Http\Requests\Arsip\ArsipRequest;
use Illuminate\Http\Request;

interface ArsipInterfaces
{
    public function list(Request $request);
    public function createData(ArsipRequest $request);
    public function getFile(Request $request);
    public function updateData(ArsipRequest $request, $id);
    public function deleteData($id);
    public function getDataById($id);
    public function deleteFile($id);
    public function addFile(ArsipRequest $request);
    public function getDataArsipByPersonal(Request $request);
    public function getDataArsipByEntire(Request $request);
    public function getYearArsip(Request $request);
}

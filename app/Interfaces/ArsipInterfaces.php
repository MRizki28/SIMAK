<?php

namespace App\Interfaces;

use App\Http\Requests\Arsip\ArsipRequest;
use Illuminate\Http\Request;

interface ArsipInterfaces
{
    public function list(Request $request);
    public function createData(ArsipRequest $request);
}

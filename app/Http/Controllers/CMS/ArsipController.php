<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
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
}

<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\Position\PositionRequest;
use App\Repositories\PositionRepositories;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    protected $positionRepositories;

    public function __construct(PositionRepositories $positionRepositories)
    {
        $this->positionRepositories = $positionRepositories;
    }

    public function getAllData()
    {
        return $this->positionRepositories->getAllData();
    }
}

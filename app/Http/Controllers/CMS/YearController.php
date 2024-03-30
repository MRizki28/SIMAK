<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Repositories\YearRepositories;
use Illuminate\Http\Request;

class YearController extends Controller
{
    protected $yearRepositories;

    public function __construct(YearRepositories $yearRepositories)
    {
        $this->yearRepositories = $yearRepositories;
    }

    public function getAllData()
    {
        return $this->yearRepositories->getAllData();
    }

    public function getPersonalYear()
    {
        return $this->yearRepositories->getPersonalYear();
    }

    public function getEntireYear(Request $request)
    {
        return $this->yearRepositories->getEntireYear($request);
    }
}

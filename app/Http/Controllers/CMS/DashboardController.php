<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Repositories\DashboardRepositories;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $dashboardRepositories;

    public function __construct(DashboardRepositories $dashboardRepositories)
    {
        $this->dashboardRepositories = $dashboardRepositories;
    }

    public function dashboard()
    {
        return $this->dashboardRepositories->dashboard();
    }
}

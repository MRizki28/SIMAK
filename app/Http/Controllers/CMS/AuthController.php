<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthRequest;
use App\Http\Requests\Setting\SettingRequest;
use App\Repositories\AuthRepositories;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authRepositories;

    public function __construct(AuthRepositories $authRepositories)
    {
        $this->authRepositories = $authRepositories;
    }

    public function register(AuthRequest $request)
    {
        return $this->authRepositories->register($request);
    }

    public function getAllData()
    {
        return $this->authRepositories->getAllData();
    }

    public function getDataForArsip()
    {
        return $this->authRepositories->getDataForArsip();
    }

    public function getDataById($id)
    {
        return $this->authRepositories->getDataById($id);
    }

    public function resetPassword(Request $request, $id)
    {
        return $this->authRepositories->resetPassword($request,$id);
    }

    public function updateData(AuthRequest $request, $id)
    {
        return $this->authRepositories->updateData($request, $id);
    }

    public function login(Request $request)
    {
        return $this->authRepositories->login($request);
    }

    public function logout(Request $request)
    {
        return $this->authRepositories->logout($request);
    }

    public function deleteData($id)
    {
        return $this->authRepositories->deleteData($id);
    }

    public function setting(SettingRequest $request)
    {
        return $this->authRepositories->setting($request);
    }
}

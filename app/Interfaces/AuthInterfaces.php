<?php


namespace App\Interfaces;

use App\Http\Requests\Auth\AuthRequest;
use App\Http\Requests\Setting\SettingRequest;
use Illuminate\Http\Request;

interface AuthInterfaces {
    public function register(AuthRequest $request);
    public function getAllData();
    public function getDataForArsip();
    public function setting(SettingRequest $request);
    public function getDataById($id);
    public function resetPassword(Request $request, $id);
    public function updateData(AuthRequest $request, $id);
    public function login(Request $request);
    public function logout(Request $request);
    public function deleteData($id);
}
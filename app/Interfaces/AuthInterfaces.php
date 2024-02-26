<?php


namespace App\Interfaces;

use App\Http\Requests\Auth\AuthRequest;
use Illuminate\Http\Request;

interface AuthInterfaces {
    public function register(AuthRequest $request);
    public function getAllData();
    public function getDataById($id);
    public function resetPassword(Request $request, $id);
    public function deleteData($id);
}
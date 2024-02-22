<?php


namespace App\Interfaces;

use App\Http\Requests\Auth\AuthRequest;

interface AuthInterfaces {
    public function register(AuthRequest $request);
}
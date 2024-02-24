<?php


namespace App\Repositories;

use App\Http\Requests\Auth\AuthRequest;
use App\Interfaces\AuthInterfaces;
use App\Models\User;
use App\Traits\HttpResponseTraits;
use Illuminate\Support\Facades\Hash;

class AuthRepositories implements AuthInterfaces
{
    protected $userModel;
    use HttpResponseTraits;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function register(AuthRequest $request)
    {
        try {
            $data = new $this->userModel;
            $data->name = $request->input('name');
            $data->email = $request->input('email');
            $data->password = Hash::make($request->input('password'));
            $data->save();

            $token = $data->createToken('auth_token')->plainTextToken;
            return $this->success([
                'data' => $data,
                'token' => $token
            ]);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function getAllData()
    {
        $data = $this->userModel->all();
        if ($data->isEmpty()) {
            return $this->dataNotFound();
        } else {
            return $this->success($data);
        }
    }
}

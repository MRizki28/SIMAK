<?php


namespace App\Repositories;

use App\Http\Requests\Auth\AuthRequest;
use App\Interfaces\AuthInterfaces;
use App\Models\User;
use App\Traits\HttpResponseTraits;
use Illuminate\Http\Request;
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
            $password = '12345678';
            $data = new $this->userModel;
            $data->id_position = htmlspecialchars($request->input('id_position'));
            $data->name = htmlspecialchars($request->input('name'));
            $data->email = htmlspecialchars($request->input('email'));
            $data->password = htmlspecialchars(Hash::make($password));
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
        $data = $this->userModel->with('position')->get();
        if ($data->isEmpty()) {
            return $this->dataNotFound();
        } else {
            return $this->success($data);
        }
    }

    public function getDataById($id)
    {
        $data = $this->userModel->where('id', $id)->first();
        if (!$data) {
            return $this->idOrDataNotFound();
        } else {
            return $this->success($data);
        }
    }

    public function resetPassword(Request $request, $id)
    {
        try {
            $data = $this->userModel->where('id', $id)->first();
            $defaultPassword = Hash::make('12345678');
            $data->password = $defaultPassword;
            $data->save();

            return response()->json([
                'message' => 'success reset password'
            ]);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function updateData(AuthRequest $request, $id)
    {
        try {
            $data = $this->userModel->where('id', $id)->first();
            $data->id_position = htmlspecialchars($request->input('id_position'));
            $data->name = htmlspecialchars($request->input('name'));
            $data->email = htmlspecialchars($request->input('email'));
            $data->save();
            return $this->success($data);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function deleteData($id)
    {
        try {
            $data = $this->userModel->where('id', $id)->first();
            if (!$data) {
                return $this->idOrDataNotFound();
            } else {
                $data->delete();
                return $this->delete();
            }
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }
}

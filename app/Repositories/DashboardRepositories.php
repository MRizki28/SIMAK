<?php

namespace App\Repositories;

use App\Interfaces\DashboardInterfaces;
use App\Models\ArsipModel;
use App\Models\TypeDocumentModel;
use App\Models\User;
use App\Traits\HttpResponseTraits;
use Illuminate\Support\Facades\Auth;

class DashboardRepositories implements DashboardInterfaces
{
    use HttpResponseTraits;
    public function dashboard()
    {
        $id_user = Auth::user()->id;
        $typeDocument = TypeDocumentModel::where('id_user', $id_user)->count();
        $personalArsip = ArsipModel::where('id_user', $id_user)->count();
        $user = User::count();
        $entireArsip = ArsipModel::count();
        return $this->success([
            'typeDocument' => $typeDocument,
            'personalArsip' => $personalArsip,
            'totalUser' => $user,
            'totalSeluruhArsip' => $entireArsip
        ]);
    }
}
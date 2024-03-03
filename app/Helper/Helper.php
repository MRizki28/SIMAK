<?php

namespace App\Helper;

use App\Models\FileModel;
use App\Models\User;

class Helper
{
    public static   function isValidUserId($id_user)
    {
        return User::where('id', $id_user)->exists();
    }

    public static function isValidArsipId($id_arsip)
    {
        return FileModel::where('id_arsip', $id_arsip)->exists();
    }
}

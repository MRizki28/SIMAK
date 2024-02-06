<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeDocumentModel extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'tb_type_document';
    protected $fillable = [
        'id',
        'id_user',
        'name_type_document'
    ];
}

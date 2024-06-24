<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipModel extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'tb_arsip';
    protected $fillable = [
        'id',
        'id_user',
        'id_type_document',
        'code_arsip',
        'date_arsip',
        'description',
        'in_or_out_arsip',
        'is_private'
    ];

    public function typeDocument()
    {
        return $this->belongsTo(TypeDocumentModel::class, 'id_type_document');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function getFile()
    {
        return $this->hasMany(FileModel::class, 'id_arsip');
    }
}

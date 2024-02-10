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
        'id_year',
        'code_arsip',
        'file_arsip',
        'date_arsip',
        'description',
        'is_private'
    ];

    public function typeDocument()
    {
        return $this->belongsTo(TypeDocumentModel::class, 'id_type_document');
    }
}

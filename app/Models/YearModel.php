<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YearModel extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'tb_year';
    protected $fillable = [
        'id',
        'year'
    ];

    public function arsip()
    {
        return $this->hasMany(ArsipModel::class, 'id_year');
    }
}

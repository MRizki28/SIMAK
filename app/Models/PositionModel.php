<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PositionModel extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'tb_position';
    protected $fillable = [
        'id',
        'code_position',
        'position'
    ];
}

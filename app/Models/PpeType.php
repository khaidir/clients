<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PpeType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ppe_type';

    protected $fillable = [
        'goods',
        'description',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}

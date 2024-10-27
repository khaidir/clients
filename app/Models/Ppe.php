<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ppe extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ppe';

    protected $fillable = [
        'type_id',
        'code',
        'merk',
        'colour',
        'condition',
        'notes',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}

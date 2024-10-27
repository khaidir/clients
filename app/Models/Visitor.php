<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visitor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'visitor';

    protected $fillable = [
        'user_id',
        'description',
        'destination',
        'duration',
        'date_request',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}

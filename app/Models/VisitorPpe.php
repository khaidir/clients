<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisitorPpe extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'visitor_ppe';

    protected $fillable = [
        'visitor_id',
        'ppe_id',
        'date_pickup',
        'date_return',
        'notes',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}

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
        'token_id',
        'pic_id',
        'user_id',
        'fullname',
        'email',
        'citizenship_id',
        'citizenship_doc',
        'description',
        'destination',
        'duration',
        'date_request',
        'approve_1',
        'approve_2',
        'approve_3',
        'status',
    ];
}

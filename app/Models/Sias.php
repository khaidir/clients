<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sias extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sia';

    protected $fillable = [
        'user_id',
        'company_id',
        'description',
        'request_by',
        'approved_by',
        'doc_verified_by',
        'license_verified_by',
        'inducted_by',
        'evaluated_by',
        'dete_request',
        'status'
    ];
}

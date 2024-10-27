<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiaExtended extends Model
{

    use HasFactory, SoftDeletes;

    protected $table = 'sia_extended';

    protected $fillable = [
        'requested_by',
        'approved_by',
        'verified_by',
    ];

    protected $dates = ['created_at', 'updated_at'];


}

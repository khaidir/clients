<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiaExtended extends Model
{

    use HasFactory, SoftDeletes;

    protected $table = 'sia_extended';

    protected $fillable = [
        'user_id',
        'company_id',
        'no_contract',
        'type_contract',
        'description_of_task',
        'periode_start',
        'periode_end',
        'requested_at',
        'request_by', //end user
        'approved_by', //hod
        'verified_by', //h&s
        'sia_id',
    ];

    protected $dates = ['created_at', 'updated_at'];


}

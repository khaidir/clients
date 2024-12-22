<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pic extends Model
{
    use HasFactory;

    protected $table = 'pic';

    protected $fillable = [
        'user_id',
        'name',
        'segment',
        'description',
        'email',
        'status'
    ];
}

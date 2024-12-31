<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisitorPerson extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'visitor_person';

    protected $fillable = [
        'visitor_id',
        'citizenship_number',
        'citizenship_docs',
        'foreign',
        'name',
        'ocuppational',
        'notes',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    // Jika ada relasi dengan model Visitor, Anda bisa menambahkan metode berikut
    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }
}

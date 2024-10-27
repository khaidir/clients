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
        'name',
        'citizenship',
        'docs_citizenship',
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

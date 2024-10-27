<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sia_person extends Model
{

    use HasFactory, SoftDeletes;

    protected $table = 'sia_person';

    protected $fillable = [
        'sia_id',
        'id_card',
        'fullname',
        'email',
        'token',
        'position',
        'cert_expire',
        'bpjs_number',
        'score_induction',
        'ktp',
        'ktp_checked',
        'card_id',
        'card_checked',
        'passport',
        'pp_checked',
        'bpjs',
        'bpjs_checked',
        'contract',
        'ct_checked',
        'cert_competence',
        'cc_checked',
        'medical_checkup',
        'mc_checked',
        'license_driver',
        'ld_checked',
        'license_vaccinated',
        'lv_checked',
        'user_id',
        'status',
        'post'
    ];

    protected $dates = ['cert_expire', 'created_at', 'updated_at', 'deleted_at'];

}

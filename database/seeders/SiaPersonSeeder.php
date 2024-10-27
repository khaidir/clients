<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;
use DB;

class SiaPersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sia_person')->insert([
            [
                'sia_id' => 1,
                'card_id' => '123456789',
                'fullname' => 'John Doe',
                'email' => 'johndoe@example.com',
                'token' => Str::random(40),
                'position' => 'Manager',
                'cert_expire' => now()->addYear(1), // Sertifikat berlaku 1 tahun dari sekarang
                'bpjs_number' => 'BPJS123456',
                'score_induction' => '85',

                // Attachment
                'ktp' => 'ktp_johndoe.png',
                'ktp_checked' => true,
                'card_id' => 'card_johndoe.png',
                'card_checked' => true,
                'passport' => 'passport_johndoe.png',
                'pp_checked' => false,
                'bpjs' => 'bpjs_johndoe.png',
                'bpjs_checked' => true,
                'contract' => 'contract_johndoe.pdf',
                'ct_checked' => false,
                'cert_competence' => 'cert_competence_johndoe.pdf',
                'cc_checked' => true,
                'medical_checkup' => 'medical_checkup_johndoe.pdf',
                'mc_checked' => true,
                'license_driver' => 'license_driver_johndoe.png',
                'ld_checked' => false,
                'license_vaccinated' => 'license_vaccinated_johndoe.png',
                'lv_checked' => true,

                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sia_id' => 2,
                'card_id' => '987654321',
                'fullname' => 'Jane Smith',
                'email' => 'janesmith@example.com',
                'token' => Str::random(40),
                'position' => 'Engineer',
                'cert_expire' => now()->addMonths(6), // Sertifikat berlaku 6 bulan dari sekarang
                'bpjs_number' => 'BPJS654321',
                'score_induction' => '90',

                // Attachment
                'ktp' => 'ktp_janesmith.png',
                'ktp_checked' => false,
                'card_id' => 'card_janesmith.png',
                'card_checked' => true,
                'passport' => 'passport_janesmith.png',
                'pp_checked' => true,
                'bpjs' => 'bpjs_janesmith.png',
                'bpjs_checked' => false,
                'contract' => 'contract_janesmith.pdf',
                'ct_checked' => true,
                'cert_competence' => 'cert_competence_janesmith.pdf',
                'cc_checked' => false,
                'medical_checkup' => 'medical_checkup_janesmith.pdf',
                'mc_checked' => false,
                'license_driver' => 'license_driver_janesmith.png',
                'ld_checked' => true,
                'license_vaccinated' => 'license_vaccinated_janesmith.png',
                'lv_checked' => false,

                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

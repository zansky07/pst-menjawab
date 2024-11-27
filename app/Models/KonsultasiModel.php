<?php

namespace App\Models;

use CodeIgniter\Model;

class KonsultasiModel extends Model
{
    protected $table = 'konsultasi';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama_konsumen',
        'email_konsumen',
        'no_wa_konsumen',
        'topik',
        'kategori',
        'lingkup',
        'deskripsi',
        'token_konsultasi',
        'status_konsultasi',
        'jadwal_konsultasi',
        'link_zoom',
        'alasan_penolakan',
        'notula',
        'dokumentasi',
        'konsultan_id'
    ];
}

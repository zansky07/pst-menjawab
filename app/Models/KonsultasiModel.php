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
        'whatsapp_konsumen',
        'topik',
        'kategori',
        'lingkup',
        'deskripsi',
        'token_konsultasi',
        'tanggal_reservasi',
        'status_konsultasi',
        'jadwal_konsultasi',
        'link_zoom',
        'kehadiran',
        'alasan_penolakan',
        'notula',
        'dokumentasi',
        'konsultan_id'
    ];
}

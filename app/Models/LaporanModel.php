<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{
    protected $table = 'laporan';
    protected $primaryKey = 'laporan_id';
    protected $allowedFields = [
        'konsultasi_id',
        'feedback1',
        'feedback2',
        'feedback3',
        'feedback4',
        'feedback5',
        'feedback6'
    ];

    public function getFeedbackWithDetails()
    {
        // Join dengan tabel laporan
        return $this->db->table('laporan')
            ->select('laporan.*,konsultasi.token_konsultasi AS token_konsultasi ,konsultasi.topik AS konsultasi_topik, konsultasi.jadwal_konsultasi AS waktu_konsultasi, konsultan.nama AS nama_konsultan')
            ->join('konsultasi', 'laporan.konsultasi_id = konsultasi.id', 'left') // Left join untuk mendapatkan feedback tanpa laporan
            ->join('konsultan', 'konsultasi.konsultan_id = konsultan.id', 'left')
            ->get()
            ->getResultArray();
    }
}

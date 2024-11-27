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
}

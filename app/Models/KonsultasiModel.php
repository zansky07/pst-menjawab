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

        /**
     * Mengambil data statistik berdasarkan filter status dan periode.
     *
     * @param string $status  Filter status (e.g., 'selesai', 'ditolak', 'proses', atau 'semua').
     * @param array|string $periode  Filter periode dalam bentuk array ['start' => 'YYYY-MM-DD', 'end' => 'YYYY-MM-DD'] atau 'semua'.
     * @return array  Data statistik dalam bentuk ['label' => jumlah].
     */
    public function getStatistics($status = 'semua', $periode = 'semua')
    {
        $builder = $this->db->table($this->table);

        // Filter berdasarkan status konsultasi
        if ($status !== 'semua') {
            $builder->where('status_konsultasi', $status);
        }

        // Filter berdasarkan periode tanggal reservasi
        if (is_array($periode) && isset($periode['start'], $periode['end'])) {
            $builder->where('DATE(tanggal_reservasi) >=', $periode['start']);
            $builder->where('DATE(tanggal_reservasi) <=', $periode['end']);
        }

        // Ambil jumlah konsultasi berdasarkan tanggal
        $builder->select('DATE(tanggal_reservasi) as tanggal, COUNT(*) as jumlah');
        $builder->groupBy('DATE(tanggal_reservasi)');
        $builder->orderBy('tanggal', 'ASC');
        $query = $builder->get();

        // Format hasil untuk dikembalikan
        $result = [];
        foreach ($query->getResultArray() as $row) {
            $result[$row['tanggal']] = (int) $row['jumlah'];
        }

        return $result;
    }

    /**
     * Mengambil jumlah total konsultasi berdasarkan status.
     *
     * @param string $status  Filter status (e.g., 'selesai', 'ditolak', 'proses', atau 'semua').
     * @return int Jumlah total konsultasi.
     */
    
    public function getTotalByStatus($status = 'semua')
    {
        $builder = $this->db->table($this->table);

        // Filter berdasarkan status konsultasi
        if ($status !== 'semua') {
            $builder->where('status_konsultasi', $status);
        }

        return $builder->countAllResults();
    }

    /**
     * Mengambil statistik agregat (total selesai, ditolak, dll.).
     *
     * @return array Statistik agregat berdasarkan status_konsultasi.
     */
    public function getAggregateStatistics()
    {
        $builder = $this->db->table($this->table);

        // Ambil jumlah per status konsultasi
        $builder->select('status_konsultasi, COUNT(*) as jumlah');
        $builder->groupBy('status_konsultasi');
        $query = $builder->get();

        // Format hasil untuk dikembalikan
        $result = [];
        foreach ($query->getResultArray() as $row) {
            $result[$row['status_konsultasi']] = (int) $row['jumlah'];
        }

        return $result;
    }
}

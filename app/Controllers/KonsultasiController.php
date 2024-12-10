<?php
namespace App\Controllers;

use App\Models\KonsultasiModel;

class KonsultasiController extends BaseController
{
    protected $konsultasiModel;

    public function __construct()
    {
        $this->konsultasiModel = new KonsultasiModel();
    }

    public function create()
    {
        return view('form_reservasi_user');
    }

    public function submit()
    {
        // Ambil data dari form
        $nama = $this->request->getPost('nama');
        $email = $this->request->getPost('email');
        $whatsapp = $this->request->getPost('whatsapp');
        $topik = $this->request->getPost('topik');
        $kategori = $this->request->getPost('kategori');
        $lingkup = $this->request->getPost('lingkup');
        $deskripsi = $this->request->getPost('deskripsi');

        // Validasi data menggunakan regex
        $namaPattern = "/^[a-zA-Z\s]{1,50}$/";
        $emailPattern = "/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/";
        $whatsappPattern = "/^08[1-9][0-9]{6,10}$/";
        $topikPattern = "/^[\w\s]{3,100}$/";
        $kategoriPattern = "/^[\w\s]{3,50}$/";
        $lingkupPattern = "/^[\w\s]{3,50}$/";
        $deskripsiPattern = "/^[\w\s\.\,]{3,500}$/";

        if (
            !preg_match($namaPattern, $nama) ||
            !preg_match($emailPattern, $email) ||
            !preg_match($whatsappPattern, $whatsapp) ||
            !preg_match($topikPattern, $topik) ||
            !preg_match($kategoriPattern, $kategori) ||
            !preg_match($lingkupPattern, $lingkup) ||
            !preg_match($deskripsiPattern, $deskripsi)
        ) {
            session()->setFlashdata('error', 'Data yang Anda masukkan tidak valid. Silakan coba lagi.');
            return redirect()->to('/consultation/reserve')->withInput();
        }

        // Buat token unik untuk reservasi
        $token = strtoupper(uniqid('PST'));

        // Data yang akan disimpan
        $data = [
            'nama_konsumen' => $nama,
            'email_konsumen' => $email,
            'whatsapp' => $whatsapp,
            'topik' => $topik,
            'kategori' => $kategori,
            'lingkup' => $lingkup,
            'deskripsi' => $deskripsi,
            'token_konsultasi' => $token,
            'status_konsultasi' => 'Sedang diproses', // Status default
            'tanggal_reservasi' => date('Y-m-d H:i:s'), // Tanggal reservasi saat submit
        ];

        // Simpan data ke database menggunakan KonsultasiModel
        $this->konsultasiModel->insert($data);

        // Redirect ke halaman utama setelah submit
        session()->setFlashdata('success', 'Reservasi berhasil dibuat dengan token: ' . $token);
        return redirect()->to('/');
    }

    public function checkStatus()
    {
        // Load model
        $konsultasiModel = new \App\Models\KonsultasiModel();

        // Ambil token dari input form
        $token = $this->request->getPost('token');

        // Cari data reservasi berdasarkan token
        $reservation = $konsultasiModel->where('token_konsultasi', $token)->first();

        // Buat array data kosong
        $data = [];

        if ($reservation) {
            // Setel locale ke bahasa Indonesia
            setlocale(LC_TIME, 'id_ID.UTF-8');

            // Ambil tanggal reservasi dari database
            $tanggal_reservasi = $reservation['tanggal_reservasi'];
            $jadwal_konsultasi = $reservation['jadwal_konsultasi'];

            // Format tanggal menjadi bahasa Indonesia
            $tanggal_reservasi_indo = strftime('%d %B %Y', strtotime($tanggal_reservasi));
            $jadwal_konsultasi_indo = strftime('%d %B %Y', strtotime($jadwal_konsultasi));

            // Jika token ditemukan, kirimkan data ke view
            $data['reservation'] = [
                'tanggal_reservasi' => $tanggal_reservasi_indo,
                'status' => $reservation['status_konsultasi'],
                // disetujui
                'zoom' => $reservation['link_zoom'],
                'waktu_pertemuan' => $jadwal_konsultasi_indo,
                // ditolak
                'alasan' => $reservation['alasan_penolakan'],
                // selesai
                'kehadiran' => $reservation['kehadiran'],
                'notula' => $reservation['notula'],
                'dokumentasi' => $reservation['dokumentasi']
            ];
            $data['token'] = $token;
        } else {
            // Redirect dengan flashdata berisi pesan error dan token
            return redirect()
                ->to('/consultation/checkReservation')
                ->with('error', "Token '$token' tidak valid atau tidak ditemukan.")
                ->withInput();
        }

        return view('reservation_status_user', $data);
    }


    public function detail($id)
    {
        // Periksa apakah pengguna sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/admin/login')->with('error', 'Silakan login terlebih dahulu!');
        }
        $konsultasiModel = new KonsultasiModel();
        $data['konsultasi'] = $konsultasiModel->find($id);

        if (!$data['konsultasi']) {
            return redirect()->to('/dashboard')->with('error', 'Data tidak ditemukan.');
        }

        return view('konsultasi_detail_admin', $data);
    }

    public function updateStatus($id)
    {
        $konsultasiModel = new KonsultasiModel();

        // Retrieve the posted data
        $status_konsultasi = $this->request->getPost('status_konsultasi');
        $alasan_penolakan = $this->request->getPost('alasan_penolakan');
        $kehadiran_konsumen = $this->request->getPost('kehadiran_konsumen');

        // Prepare the data for updating
        $data = [
            'status_konsultasi' => $status_konsultasi,
        ];

        // Conditionally add other fields if they exist
        if ($status_konsultasi === 'Ditolak') {
            $data['alasan_penolakan'] = $alasan_penolakan;
        }

        if ($status_konsultasi === 'Selesai') {
            $data['kehadiran'] = $kehadiran_konsumen;
        }

        // Update the record
        $konsultasiModel->update($id, $data);

        $konsultasi = $konsultasiModel->find($id);

        // If status is "Disetujui", redirect to scheduling page
        if ($status_konsultasi === 'Disetujui') {
            if (empty($konsultasi['jadwal_konsultasi'])) {
                return redirect()->to("/admin/consultation/schedule/{$id}")->with('message', 'Status diperbarui. Silakan jadwalkan konsultasi.');
            } else {
                return redirect()->to('/admin/dashboard')->with('message', 'Status diperbarui. Jadwal konsultasi sudah tersedia.');
            }
        }
        // Otherwise, redirect back to dashboard
        return redirect()->to('/admin/dashboard')->with('message', 'Status berhasil diperbarui.');
    }

    public function delete($id)
    {
        // Periksa apakah pengguna sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/admin/login')->with('error', 'Silakan login terlebih dahulu!');
        }

        $konsultasiModel = new konsultasiModel();
        $konsultasiModel->delete($id);

        return redirect()->to('/dashboard')->with('message', 'Data berhasil dihapus');
    }
}

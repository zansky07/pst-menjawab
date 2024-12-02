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
            'status_konsultasi' => 'Pending', // Status default
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

        $data = [];

        if ($reservation) {
            // Jika token ditemukan, kirimkan data ke view
            $data['reservation'] = [
                'date' => $reservation['jadwal_konsultasi'],  // Tanggal konsultasi
                'status' => $reservation['status_konsultasi'] // Status konsultasi
            ];
            $data['token'] = $token;
        } else {
            // Jika token tidak ditemukan
            $data['error'] = "Token tidak valid atau tidak ditemukan.";
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

        $status_konsultasi = $this->request->getPost('status_konsultasi');
        $konsultasiModel->update($id, ['status_konsultasi' => $status_konsultasi]);

        return redirect()->to('/statistik')->with('message', 'Status berhasil diperbarui.');
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

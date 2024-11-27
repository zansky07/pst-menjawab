<?php

namespace App\Controllers;

use App\Models\KonsultasiModel;
use App\Models\LaporanModel;

class User extends BaseController
{
    protected $konsultasiModel;
    protected $laporanModel;

    public function __construct()
    {
        $this->konsultasiModel = new KonsultasiModel();
        $this->laporanModel = new LaporanModel();
    }

    public function index(): string
    {
        return view('home_user');
    }

    public function chatbot(): string
    {
        return view('chatbot');
    }

    public function konsultasi(): string
    {
        return view('konsultasi_user');
    }

    public function reservasi(): string
    {
        return view('form_reservasi_user');
    }

    public function submit_reservasi() 
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


    public function token()
    {
        return view('form_token_user');
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

    public function feedback()
    {
        // Ambil token dari POST
        $token = $this->request->getPost('token');

        // Kirim token ke view
        return view('form_feedback_user', ['token' => $token]);
    }

    public function submit_feedback()
    {
    // Aturan validasi
    $rules = [
        'token' => 'required',
        'konsultasi' => 'required|numeric|greater_than[0]|less_than_equal_to[10]',
        'kesulitan' => 'required|numeric|greater_than[0]|less_than_equal_to[10]',
        'kepuasan' => 'required|numeric|greater_than[0]|less_than_equal_to[10]',
        'terjawab' => 'required|in_list[Ya,Tidak]',
    ];

    if (!$this->validate($rules)) {
        // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan kesalahan
        session()->setFlashdata('error', $this->validator->listErrors());
        return redirect()->back()->withInput();
    }

    // Ambil data dari form
    $token = $this->request->getPost('token');
    $feedback1 = $this->request->getPost('kendala');
    $feedback2 = $this->request->getPost('konsultasi');
    $feedback3 = $this->request->getPost('kesulitan');
    $feedback4 = $this->request->getPost('terjawab');
    $feedback5 = $this->request->getPost('kepuasan');
    $feedback6 = $this->request->getPost('kritik_saran');

    // Ambil konsultasi berdasarkan token
    $konsultasi = $this->konsultasiModel->where('token_konsultasi', $token)->first();

    if (!$konsultasi) {
        // Token tidak ditemukan
        session()->setFlashdata('error', 'Token tidak valid.');
        return redirect()->back()->withInput();
    }

    // Data yang akan disimpan ke tabel laporan
    $data = [
        'konsultasi_id' => $konsultasi['id'],
        'feedback1' => $feedback1,
        'feedback2' => $feedback2,
        'feedback3' => $feedback3,
        'feedback4' => $feedback4,
        'feedback5' => $feedback5,
        'feedback6' => $feedback6
    ];

    // Simpan data ke database
    $this->laporanModel->insert($data);

    // Redirect dengan pesan sukses
    session()->setFlashdata('success', 'Feedback berhasil dikirim.');
    return redirect()->to('/');
    }

}

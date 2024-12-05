<?php
namespace App\Controllers;

use App\Models\KonsultasiModel;
use App\Models\LaporanModel;

class FeedbackController extends BaseController
{
    protected $konsultasiModel;
    protected $laporanModel;

    public function __construct()
    {
        $this->konsultasiModel = new KonsultasiModel();
        $this->laporanModel = new LaporanModel();
    }

    public function create()
    {
        // Ambil token dari POST
        $token = $this->request->getPost('token');
    
        // Periksa apakah token ada di KonsultasiModel
        $konsultasiModel = new \App\Models\KonsultasiModel();
        $konsultasi = $konsultasiModel->where('token_konsultasi', $token)->first();
    
        // Ambil ID konsultasi
        $konsultasiId = $konsultasi['id'];
    
        // Periksa apakah konsultasi_id ada di LaporanModel dan feedback1 sudah terisi
        $laporanModel = new \App\Models\LaporanModel();
        $laporan = $laporanModel->where('konsultasi_id', $konsultasiId)->first();
    
        if ($laporan && !empty($laporan['feedback1'])) {
            // Jika feedback1 sudah terisi, set flash data error dan redirect
            session()->setFlashdata('error', "Survei kepuasan konsumen sudah pernah diisi untuk token '$token' .");
            return redirect()->to('/consultation/checkReservation')->withInput();
        }
    
        // Kirim token ke view jika laporan ditemukan dan feedback1 belum terisi
        return view('form_feedback_user', ['token' => $token]);
    }    

    public function submit()
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

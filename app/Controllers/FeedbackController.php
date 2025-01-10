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

    if (!$konsultasi) {
        // Jika token tidak ditemukan, set flash data error dan redirect
        session()->setFlashdata('error', 'Masukkan token terlebih dahulu.');
        return redirect()->to('/consultation/checkReservation');
    }
    
    // Ambil ID konsultasi
    $konsultasiId = $konsultasi['id'];
    
    // Periksa apakah konsultasi_id ada di LaporanModel dan feedback1 sudah terisi
    $laporanModel = new \App\Models\LaporanModel();
    $laporan = $laporanModel->where('konsultasi_id', $konsultasiId)->first();
    
    if ($laporan && !empty($laporan['feedback1'])) {
        // Jika feedback1 sudah terisi, set flash data error dan redirect
        session()->setFlashdata('error', "Survei kepuasan konsumen sudah pernah diisi untuk token '$token'.");
        return redirect()->to('/consultation/checkReservation')->withInput();
    }
    
    // Kirim token ke view jika laporan ditemukan dan feedback1 belum terisi
    return view('form_feedback_user', ['token' => $token]);
    }

    public function submit()
    {
        // Aturan validasi
        $rules = [
            'token' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Token wajib diisi.',
                ],
            ],
            'kendala' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi "-" jika ingin mengosongkan.',
                ],
            ],
            'konsultasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kemungkinan konsultasi lagi wajib diisi.',
                ],
            ],
            'kepuasan_web' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kepuasan penggunaan web wajib diisi.',
                ],
            ],
            'kepuasan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kepuasan terhadap layanan wajib diisi.',
                ],
            ],
            'terjawab' => [
                'rules' => 'required|in_list[Ya,Tidak]',
                'errors' => [
                    'required' => 'Harap pilih apakah pertanyaan terjawab.',
                    'in_list' => 'Pilihan tidak valid.',
                ],
            ],
            'kritik_saran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi "-" jika ingin mengosongkan.',
                ],
            ],
        ];

        // Validasi input
        if (!$this->validate($rules)) {
            // Ambil token dari input
            $token = $this->request->getPost('token');
    
            // Set pesan error
            session()->setFlashdata('error', $this->validator->listErrors());
    
            // Redirect ke metode create() dengan token
            return $this->create();
        }

        // Ambil data dari form
        $data = [
            'konsultasi_id' => $this->konsultasiModel->where('token_konsultasi', $this->request->getPost('token'))->first()['id'],
            'feedback1' => $this->request->getPost('kendala'),
            'feedback2' => $this->request->getPost('konsultasi'),
            'feedback3' => $this->request->getPost('kepuasan_web'),
            'feedback4' => $this->request->getPost('terjawab'),
            'feedback5' => $this->request->getPost('kepuasan'),
            'feedback6' => $this->request->getPost('kritik_saran'),
        ];

        // Simpan data ke database
        $this->laporanModel->save($data);

        // Redirect dengan pesan sukses
        return redirect()->to('/')->with('success', 'Feedback berhasil dikirim.');
    }
}

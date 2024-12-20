<?php

namespace App\Controllers;

use App\Models\KonsultasiModel;
use App\Controllers\BaseController;
use App\Helpers\WAHelper;


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
        $data = $this->request->getPost();

        // Validasi data menggunakan regex
        $validationErrors = [];

        if (!preg_match("/^[a-zA-Z\s]{1,50}$/", $data['nama'])) {
            $validationErrors['nama'] = "Nama harus berupa huruf dan maksimal 50 karakter.";
        }

        if (!preg_match("/^[\w.\-]+@([\w-]+\.)+[\w-]{2,4}$/", $data['email'])) {
            $validationErrors['email'] = "Email tidak valid.";
        }

        if (!preg_match("/^08[1-9][0-9]{6,10}$/", $data['whatsapp'])) {
            $validationErrors['whatsapp'] = "Nomor tidak valid. Masukkan nomor yang benar dan harus diawali dengan 08.";
        }

        if (!preg_match("/^[\w\s]{3,100}$/", $data['topik'])) {
            $validationErrors['topik'] = "Topik harus berisi 3-100 karakter kata.";
        }

        if (!preg_match("/^[\w\s\.\,]{3,500}$/", $data['deskripsi'])) {
            $validationErrors['deskripsi'] = "Deskripsi harus berisi 3-500 karakter kata.";
        }

        // Jika ada error validasi
        if (!empty($validationErrors)) {
            session()->setFlashdata('validationErrors', $validationErrors);
            return redirect()->to('/consultation/reserve')->withInput();
        }

        // Buat token unik untuk reservasi
        $token = strtoupper(uniqid('PST'));

        // Data yang akan disimpan
        $data = [
            'nama_konsumen' => $data['nama'],
            'email_konsumen' => $data['email'],
            'whatsapp_konsumen' => $data['whatsapp'],
            'topik' => $data['topik'],
            'kategori' => $data['kategori'],
            'lingkup' => $data['lingkup'],
            'deskripsi' => $data['deskripsi'],
            'token_konsultasi' => $token,
            'status_konsultasi' => 'Sedang diproses', // Status default
            'tanggal_reservasi' => date('Y-m-d H:i:s'), // Tanggal reservasi saat submit
        ];

        // Simpan data ke database menggunakan KonsultasiModel
        $this->konsultasiModel->insert($data);

        // Kirim email pemberitahuan
        $email = \Config\Services::email();
        $email->setTo($data['email_konsumen']);
        $email->setFrom('mfauzanfk@gmail.com', 'PST Menjawab');
        $email->setSubject('Reservasi Konsultasi Online Berhasil');
        $email->setMessage("
            <p>Halo <strong>{$data['nama_konsumen']}</strong>,</p>
            <p>Reservasi konsultasi Anda berhasil! Berikut detailnya:</p>
            <ul>
                <li><strong>Nama:</strong> {$data['nama_konsumen']}</li>
                <li><strong>Topik:</strong> {$data['topik']}</li>
                <li><strong>Kategori:</strong> {$data['kategori']}</li>
                <li><strong>Lingkup:</strong> {$data['lingkup']}</li>
                <li><strong>Deskripsi:</strong> {$data['deskripsi']}</li>
                <li><strong>Token:</strong> {$data['token_konsultasi']}</li>
            </ul>
            <p>Kami akan menghubungi Anda untuk langkah selanjutnya.</p>
            <p>Terima kasih,<br>PST Menjawab BPS DKI Jakarta</p>
        ");

        $message = "🔔 [ *RESERVASI KONSULTASI ONLINE BERHASIL* ] 🔔\n\n";
                $message .= "Halo, {$data['nama_konsumen']}!\n\n";
                $message .= "Reservasi konsultasi Anda berhasil! Berikut detailnya:\n\n";
                $message .= "*Nama:* {$data['nama_konsumen']}\n\n";
                $message .= "*Topik:* {$data['topik']}\n";
                $message .= "*Kategori:* {$data['kategori']}\n";
                $message .= "*Lingkup:* {$data['lingkup']}\n";
                $message .= "*Deskripsi:* {$data['deskripsi']}\n";
                $message .= "*Token:* {$data['token_konsultasi']}\n\n";
                $message .= "Kami akan menghubungi Anda untuk langkah selanjutnya.\n";
                $message .= "Terima kasih, *PST Menjawab BPS DKI Jakarta*";

        // Kirim notifikasi ke WhatsApp

        WAHelper::send_wa_notification($data['whatsapp_konsumen'], $message);

        if ($email->send() ) {
            session()->setFlashdata('success', 'Reservasi berhasil. Email pemberitahuan telah dikirim.');
        } else {
            session()->setFlashdata('error', 'Reservasi berhasil, tetapi email tidak dapat dikirim.');
        }

        // Redirect ke halaman utama setelah submit
        session()->setFlashdata('success', 'Reservasi dibuat dengan token: ' . $token);


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
            return redirect()->to('/admin/dashboard')->with('error', 'Data tidak ditemukan.');
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

        return redirect()->to('/admin/dashboard')->with('message', 'Data berhasil dihapus');
    }

    public function postConsultation()
    {
        // Periksa apakah pengguna sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/admin/login')->with('error', 'Silakan login terlebih dahulu!');
        }

        return view('post_konsultasi');
    }
}

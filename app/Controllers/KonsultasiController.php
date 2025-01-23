<?php

namespace App\Controllers;

use App\Models\KonsultasiModel;
use App\Models\KonsultanModel;
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

        if (!preg_match("/^[\w\s\.,'\"!?\-\(\)]+$/", $data['deskripsi'])) {
            $validationErrors['deskripsi'] = "Deskripsi harus berisi 3-500 karakter kata dan tanda baca diperbolehkan.";
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
    
        // Ambil token dari input form menggunakan method GET
        $token = $this->request->getGet('token');
    
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
                'id'=> $reservation['id'],
                'tanggal_reservasi' => $tanggal_reservasi_indo,
                'status' => $reservation['status_konsultasi'],
                'zoom' => $reservation['link_zoom'],
                'waktu_pertemuan' => $jadwal_konsultasi_indo,
                'alasan' => $reservation['alasan_penolakan'],
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

        // Retrieve the posted data - check both normal and hidden status inputs
        $status_konsultasi = $this->request->getPost('status_konsultasi') ?? $this->request->getPost('status_konsultasi_hidden');
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
        } else if ($status_konsultasi == 'Ditolak') {
            // Kirim email pemberitahuan penolakan
            $email = \Config\Services::email();
            $email->setTo($konsultasi['email_konsumen']);
            $email->setFrom('mfauzanfk@gmail.com', 'PST Menjawab');
            $email->setSubject('Permintaan Anda Telah Ditolak!');
            $emailMessage = "
                <p>Halo <strong>{$konsultasi['nama_konsumen']}</strong>,</p>
                <p>Maaf, Reservasi Konsultasi Anda Telah Kami Tolak! Berikut detailnya:</p>
                <ul>
                    <li><strong>Nama:</strong> {$konsultasi['nama_konsumen']}</li>
                    <li><strong>Topik:</strong> {$konsultasi['topik']}</li>
                    <li><strong>Alasan Penolakan:</strong> {$data['alasan_penolakan']}</li>
                    <li><strong>Token:</strong> {$konsultasi['token_konsultasi']}</li>
                </ul>
                <p>Mohon Maaf Atas Ketidaknyamanannya.</p>
                <p>Terima kasih,<br>PST Menjawab BPS DKI Jakarta</p>
            ";
            $email->setMessage($emailMessage);

            if ($email->send()) {
                log_message('info', 'Email berhasil dikirim ke ' . $konsultasi['email_konsumen']);
            } else {
                log_message('error', $email->printDebugger(['headers']));
            }

            // Kirim notifikasi WhatsApp penolakan
            $message = "🔔 [ *RESERVASI KONSULTASI ONLINE ANDA DITOLAK* ] 🔔\n\n";
            $message .= "Halo, {$konsultasi['nama_konsumen']}!\n\n";
            $message .= "Maaf, Reservasi konsultasi Anda telah kami tolak! Berikut detailnya:\n\n";
            $message .= "*Nama:* {$konsultasi['nama_konsumen']}\n";
            $message .= "*Topik:* {$konsultasi['topik']}\n";
            $message .= "*Alasan Penolakan:* {$data['alasan_penolakan']}\n";
            $message .= "*Token:* {$konsultasi['token_konsultasi']}\n\n";
            $message .= "Mohon maaf atas ketidaknyamanannya.\n";
            $message .= "Terima kasih, *PST Menjawab BPS DKI Jakarta*";

            WAHelper::send_wa_notification($konsultasi['whatsapp_konsumen'], $message);

        } else if ($status_konsultasi == 'Selesai') {
            if ($kehadiran_konsumen == 'Datang') {
                // Email untuk konsumen yang datang
                $email = \Config\Services::email();
                $email->setTo($konsultasi['email_konsumen']);
                $email->setFrom('mfauzanfk@gmail.com', 'PST Menjawab');
                $email->setSubject('Proses Konsultasi Selesai');
                $emailMessage = "
                    <p>Halo <strong>{$konsultasi['nama_konsumen']}</strong>,</p>
                    <p>Terima Kasih Sudah Hadir, Reservasi Konsultasi Anda Telah Selesai! Berikut detailnya:</p>
                    <ul>
                        <li><strong>Nama:</strong> {$konsultasi['nama_konsumen']}</li>
                        <li><strong>Topik:</strong> {$konsultasi['topik']}</li>
                        <li><strong>Kategori:</strong> {$konsultasi['kategori']}</li>
                        <li><strong>Lingkup:</strong> {$konsultasi['lingkup']}</li>
                        <li><strong>Deskripsi:</strong> {$konsultasi['deskripsi']}</li>
                        <li><strong>Token:</strong> {$konsultasi['token_konsultasi']}</li>
                        <li><strong>Jadwal:</strong> {$konsultasi['jadwal_konsultasi']}</li>
                    </ul>
                    <p>Kami mohon kesediaannya mengisi form feedback berikut:</p>
                    <p>http://pstmenjawab.my.id/consultation/status?token={$konsultasi['token_konsultasi']}</p>
                    <p>Terima kasih,<br>PST Menjawab BPS DKI Jakarta</p>
                ";
                $email->setMessage($emailMessage);

                if ($email->send()) {
                    log_message('info', 'Email berhasil dikirim ke ' . $konsultasi['email_konsumen']);
                } else {
                    log_message('error', $email->printDebugger(['headers']));
                }

                // WhatsApp untuk konsumen yang datang
                $message = "🔔 [ *KONSULTASI ONLINE TELAH SELESAI* ] 🔔\n\n";
                $message .= "Halo, {$konsultasi['nama_konsumen']}!\n\n";
                $message .= "Terima Kasih Sudah Hadir, Reservasi konsultasi Anda telah selesai! Berikut detailnya:\n\n";
                $message .= "*Nama:* {$konsultasi['nama_konsumen']}\n";
                $message .= "*Topik:* {$konsultasi['topik']}\n";
                $message .= "*Kategori:* {$konsultasi['kategori']}\n";
                $message .= "*Lingkup:* {$konsultasi['lingkup']}\n";
                $message .= "*Deskripsi:* {$konsultasi['deskripsi']}\n";
                $message .= "*Token:* {$konsultasi['token_konsultasi']}\n";
                $message .= "*Jadwal:* {$konsultasi['jadwal_konsultasi']}\n\n";
                $message .= "Kami mohon kesediaan Anda untuk mengisi form feedback berikut:\n";
                $message .= "[Link Form Feedback]\n\n";
                $message .= "Terima kasih, *PST Menjawab BPS DKI Jakarta*";

                WAHelper::send_wa_notification($konsultasi['whatsapp_konsumen'], $message);

            } else if ($kehadiran_konsumen == 'Tidak datang') {
                // Email untuk konsumen yang tidak datang
                $email = \Config\Services::email();
                $email->setTo($konsultasi['email_konsumen']);
                $email->setFrom('mfauzanfk@gmail.com', 'PST Menjawab');
                $email->setSubject('Proses Konsultasi Selesai');
                $emailMessage = "
                    <p>Halo <strong>{$konsultasi['nama_konsumen']}</strong>,</p>
                    <p>Terima Kasih, Reservasi Konsultasi Anda Telah Selesai! Berikut detailnya:</p>
                    <ul>
                        <li><strong>Nama:</strong> {$konsultasi['nama_konsumen']}</li>
                        <li><strong>Topik:</strong> {$konsultasi['topik']}</li>
                        <li><strong>Kategori:</strong> {$konsultasi['kategori']}</li>
                        <li><strong>Lingkup:</strong> {$konsultasi['lingkup']}</li>
                        <li><strong>Deskripsi:</strong> {$konsultasi['deskripsi']}</li>
                        <li><strong>Token:</strong> {$konsultasi['token_konsultasi']}</li>
                        <li><strong>Status Kehadiran:</strong> {$konsultasi['kehadiran']}</li>
                    </ul>
                    <p>Mohon Maaf Atas Ketidaknyamanannya. Semoga kita dapat berjumpa di lain waktu</p>
                    <p>Terima kasih,<br>PST Menjawab BPS DKI Jakarta</p>
                ";
                $email->setMessage($emailMessage);

                if ($email->send()) {
                    log_message('info', 'Email berhasil dikirim ke ' . $konsultasi['email_konsumen']);
                } else {
                    log_message('error', $email->printDebugger(['headers']));
                }

                // WhatsApp untuk konsumen yang tidak datang
                $message = "🔔 [ *KONSULTASI ONLINE TELAH SELESAI* ] 🔔\n\n";
                $message .= "Halo, {$konsultasi['nama_konsumen']}!\n\n";
                $message .= "Terima Kasih, Reservasi konsultasi Anda telah selesai! Berikut detailnya:\n\n";
                $message .= "*Nama:* {$konsultasi['nama_konsumen']}\n";
                $message .= "*Topik:* {$konsultasi['topik']}\n";
                $message .= "*Kategori:* {$konsultasi['kategori']}\n";
                $message .= "*Lingkup:* {$konsultasi['lingkup']}\n";
                $message .= "*Deskripsi:* {$konsultasi['deskripsi']}\n";
                $message .= "*Token:* {$konsultasi['token_konsultasi']}\n";
                $message .= "*Status Kehadiran:* {$konsultasi['kehadiran']}\n\n";
                $message .= "Mohon Maaf Atas Ketidaknyamanannya. Semoga kita dapat berjumpa di lain waktu.\n";
                $message .= "Terima kasih, *PST Menjawab BPS DKI Jakarta*";

                WAHelper::send_wa_notification($konsultasi['whatsapp_konsumen'], $message);
            }
        }

        // Redirect back to dashboard with success message
        return redirect()->to('/admin/dashboard')->with('message', 'Status berhasil diperbarui.');
    }


    public function delete($id)
    {
        // Periksa apakah pengguna sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/admin/login')->with('error', 'Silakan login terlebih dahulu!');
        }

        $konsultasiModel = new konsultasiModel();

        // Menghapus data
        $isDeleted = $konsultasiModel->delete($id);
    
        if ($isDeleted) {
            // Penghapusan berhasil
            session()->setFlashdata('delete_status', 'success');
            session()->setFlashdata('message', 'Data berhasil dihapus!');
        } else {
            // Penghapusan gagal
            session()->setFlashdata('delete_status', 'error');
            session()->setFlashdata('message', 'Data gagal dihapus!');
        }

        return redirect()->to('/admin/dashboard')->with('message', 'Data berhasil dihapus');
    }

    public function postConsultation($id)
    {
        // Periksa apakah pengguna sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/admin/login')->with('error', 'Silakan login terlebih dahulu!');
        }
    
        $konsultasiModel = new KonsultasiModel();
        $konsultanModel = new KonsultanModel();
    
        // Temukan konsultasi berdasarkan ID
        $data['konsultasi'] = $konsultasiModel->find($id);
    
        // Ambil konsultan_id dari data konsultasi
        $konsultan_id = $data['konsultasi']['konsultan_id'];
    
        // Temukan konsultan berdasarkan konsultan_id
        $data['konsultan'] = $konsultanModel->find($konsultan_id);
    
        return view('post_konsultasi', $data);
    }    

    public function postDocum($id)
    {

        $notula = '';
        $i = 1;
        while ($this->request->getPost("pertanyaan$i") && $this->request->getPost("jawaban$i")) {
            $notula .= "Pertanyaan $i: " . $this->request->getPost("pertanyaan$i") . "\n" .
                    "Jawaban $i: " . $this->request->getPost("jawaban$i") . "\n";
            $i++;
        }

        $data = [
            'notula' => $notula,
            'kehadiran' => 'Datang',
            'status_konsultasi' => 'Selesai'
        ];

        if ($file = $this->request->getFile('dokumentasi')) {
            if ($file->isValid() && !$file->hasMoved()) {
                $token = $this->konsultasiModel->find($id)['token_konsultasi']; // Ambil token dari model
                $newName = 'konsultasi_' . $token . '_' . time() . '.' . $file->getClientExtension();
                $file->move(FCPATH . 'assets/images/dokum', $newName);
                $data['dokumentasi'] = $newName;
            }
        }

        $this->konsultasiModel->update($id, $data);

        return redirect()->to("/admin/consultation/detail/{$id}");
    }
}

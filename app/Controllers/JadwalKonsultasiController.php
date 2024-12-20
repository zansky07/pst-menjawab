<?php
namespace App\Controllers;

use App\Models\KonsultasiModel;
use App\Models\KonsultanModel;
use App\Helpers\WAHelper;

class JadwalKonsultasiController extends BaseController
{
    protected $konsultasiModel;
    protected $konsultanModel;

    public function __construct()
    {
        $this->konsultasiModel = new KonsultasiModel();
        $this->konsultanModel = new KonsultanModel();
    }

    public function index($id)
    {
        helper('form');

        if (!session()->get('logged_in')) {
            return redirect()->to('/admin/login')->with('error', 'Silakan login terlebih dahulu!');
        }

        $data['konsultasi'] = $this->konsultasiModel->find($id);
        $data['konsultan'] = $this->konsultanModel->findAll();

        if (!$data['konsultasi']) {
            return redirect()->to('/admin/consultation/detail/$id')->with('error', 'Data konsultasi tidak ditemukan.');
        }

        // Pisahkan tanggal dan waktu
        if (!empty($data['konsultasi']['jadwal_konsultasi'])) {
            $jadwalParts = explode(' ', $data['konsultasi']['jadwal_konsultasi']);
            $data['konsultasi']['tanggal_konsultasi'] = $jadwalParts[0]; // Tanggal
            $data['konsultasi']['waktu_konsultasi'] = $jadwalParts[1]; // Waktu
        }

        return view('jadwal_konsultasi', $data);
    }

    public function store()
{
    // Cek autentikasi admin
    if (!session()->get('logged_in')) {
        return redirect()->to('/admin/login')->with('error', 'Silakan login terlebih dahulu!');
    }

    // Validasi input
    $rules = [
        'konsultasi_id' => 'required|numeric',
        'jadwal_konsultasi' => 'required',
        'waktu_konsultasi' => 'required',
        'link_zoom' => 'required|valid_url',
        'konsultan_id' => 'required|numeric'
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()
            ->with('errors', $this->validator->getErrors())
            ->withInput();
    }

    try {
        // Gabungkan tanggal dan waktu
        $jadwal_konsultasi = $this->request->getPost('jadwal_konsultasi') . ' ' .
            $this->request->getPost('waktu_konsultasi');

        // Data yang akan diupdate
        $data = [
            'jadwal_konsultasi' => date('Y-m-d H:i:s', strtotime($jadwal_konsultasi)),
            'link_zoom' => $this->request->getPost('link_zoom'),
            'konsultan_id' => $this->request->getPost('konsultan_id'),
            'status_konsultasi' => 'Disetujui' // Update status konsultasi
        ];

        $konsultasi_id = $this->request->getPost('konsultasi_id');
        $tanggal = $this->request->getPost('jadwal_konsultasi');
        $jam = $this->request->getPost('waktu_konsultasi');
        $konsultasi = $this->konsultasiModel->find($konsultasi_id);

        if (!$konsultasi) {
            return redirect()->back()->with('error', 'Data konsultasi tidak ditemukan.');
        }

        // Update data konsultasi
        $this->konsultasiModel->update($konsultasi_id, $data);

        // Kirim email pemberitahuan
        $email = \Config\Services::email();
        $email->setTo($konsultasi['email_konsumen']);
        $email->setFrom('mfauzanfk@gmail.com', 'PST Menjawab');
        $email->setSubject('Permintaan Anda Telah Diterima');
        $emailMessage = "
            <p>Halo <strong>{$konsultasi['nama_konsumen']}</strong>,</p>
            <p>Reservasi Konsultasi Anda Telah Kami Jadwalkan! Berikut detailnya:</p>
            <ul>
                <li><strong>Nama:</strong> {$konsultasi['nama_konsumen']}</li>
                <li><strong>Topik:</strong> {$konsultasi['topik']}</li>
                <li><strong>Tanggal:</strong> {$tanggal}</li>
                <li><strong>Jam:</strong> {$jam} WIB</li>
                <li><strong>Link Zoom:</strong> {$data['link_zoom']}</li>
                <li><strong>Token:</strong> {$konsultasi['token_konsultasi']}</li>
            </ul>
            <p>Kami mohon kehadirannya.</p>
            <p>Terima kasih,<br>PST Menjawab BPS DKI Jakarta</p>
        ";
        $email->setMessage($emailMessage);

        if ($email->send()) {
            log_message('info', 'Email berhasil dikirim ke ' . $konsultasi['email_konsumen']);
        } else {
            log_message('error', $email->printDebugger(['headers']));
        }

        // Kirim notifikasi ke WhatsApp
        $message = "🔔 [ *RESERVASI KONSULTASI ONLINE SUDAH DIJADWALKAN* ] 🔔\n\n";
        $message .= "Halo, {$konsultasi['nama_konsumen']}!\n\n";
        $message .= "Reservasi konsultasi Anda sudah dijadwalkan! Berikut detailnya:\n\n";
        $message .= "*Nama:* {$konsultasi['nama_konsumen']}\n";
        $message .= "*Topik:* {$konsultasi['topik']}\n";
        $message .= "*Tanggal:* {$tanggal}\n";
        $message .= "*Jam:* {$jam} WIB\n";
        $message .= "*Link Zoom:* {$data['link_zoom']}\n";
        $message .= "*Token:* {$konsultasi['token_konsultasi']}\n\n";
        $message .= "Kami mohon kehadiran Anda.\n";
        $message .= "Terima kasih, *PST Menjawab BPS DKI Jakarta*";

        WAHelper::send_wa_notification($konsultasi['whatsapp_konsumen'], $message);

        // Redirect ke halaman notifikasi dengan pesan sukses
        return redirect()->to('/admin/consultation/detail/' . $konsultasi_id)
            ->with('success', 'Jadwal konsultasi berhasil disimpan dan pemberitahuan telah dikirim.');

    } catch (\Exception $e) {
        log_message('error', '[JadwalKonsultasiController::store] Error: ' . $e->getMessage());
        return redirect()->back()
            ->with('error', 'Terjadi kesalahan saat menyimpan jadwal')
            ->withInput();
    }
}


    public function notification($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/admin/login')->with('error', 'Silakan login terlebih dahulu!');
        }

        if ($id === null) {
            $id = $this->request->getPost('konsultasi_id');
        }

        // Ambil data konsultasi
        $data['konsultasi'] = $this->konsultasiModel->find($id);

        // Cek apakah data konsultasi ditemukan
        if (!$data['konsultasi']) {
            return redirect()->to('/admin/consultation/detail/$id')->with('error', 'Data konsultasi tidak ditemukan.');
        }

        // Setelah memastikan data konsultasi ada, baru ambil data konsultan
        $data['konsultan'] = $this->konsultanModel->find($data['konsultasi']['konsultan_id']);

        // Cek apakah data konsultan ditemukan
        if (!$data['konsultan']) {
            return redirect()->to('/admin/consultation/detail/$id')->with('error', 'Data konsultan tidak ditemukan.');
        }

        return view('notifikasi_konsultasi', $data);
    }

    public function sendNotification($id)
    {
        // Check admin authentication
        if (!session()->get('logged_in')) {
            return redirect()->to('/admin/login')->with('error', 'Silakan login terlebih dahulu!');
        }

        // Retrieve consultation and consultant data
        $konsultasi = $this->konsultasiModel->find($id);
        $konsultan = $this->konsultanModel->find($konsultasi['konsultan_id']);

        if (!$konsultasi || !$konsultan) {
            return redirect()->to("/admin/consultation/detail/{$id}")->with('error', 'Data konsultasi atau konsultan tidak ditemukan.');
        }

        // Determine notification type from form submission
        $notificationType = $this->request->getPost('notification_type');
        $recipient = $this->request->getPost('recipient');

        // Prepare notification content
        $notificationData = [
            'konsultasi_id' => $id,
            'jadwal_konsultasi' => $konsultasi['jadwal_konsultasi'],
            'link_zoom' => $konsultasi['link_zoom']
        ];

        try {
            switch ($recipient) {
                case 'konsumen':
                    $email = $konsultasi['email_konsumen'];
                    $whatsapp = $konsultasi['no_wa_konsumen'];
                    $nama = $konsultasi['nama_konsumen'];
                    break;

                case 'konsultan':
                    $email = $konsultan['email'];
                    $whatsapp = $konsultan['whatsapp'];
                    $nama = $konsultan['nama'];
                    break;

                default:
                    throw new \Exception('Invalid recipient selection');
            }

            // Send notification based on type
            switch ($notificationType) {
                case 'email':
                    $message = "Notifikasi email berhasil dikirim ke {$nama}";
                    break;

                case 'whatsapp':
                    $message = "Notifikasi WhatsApp berhasil dikirim ke {$nama}";
                    break;

                case 'both':
                    $message = "Notifikasi email dan WhatsApp berhasil dikirim ke {$nama}";
                    break;

                default:
                    throw new \Exception('Invalid notification type');
            }

            // Update consultation status if needed
            $this->konsultasiModel->update($id, ['status_notifikasi' => 'Terkirim']);

            // Redirect to admin dashboard with success message
            return redirect()->to("/admin/consultation/detail/{$id}")->with('success', $message);

        } catch (\Exception $e) {
            // Log the error
            log_message('error', 'Notification Error: ' . $e->getMessage());

            return redirect()->to("/admin/consultation/detail/{$id}")
                ->with('error', 'Gagal mengirim notifikasi: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        // Check admin authentication
        if (!session()->get('logged_in')) {
            return redirect()->to('/admin/login')->with('error', 'Silakan login terlebih dahulu!');
        }

        // Retrieve the consultation record
        $konsultasi = $this->konsultasiModel->find($id);

        if (!$konsultasi) {
            return redirect()->to("/admin/consultation/detail/{$id}")->with('error', 'Data konsultasi tidak ditemukan.');
        }

        try {
            // Data to be updated with null values
            $data = [
                'jadwal_konsultasi' => null,
                'link_zoom' => null,
                'konsultan_id' => null
            ];

            // Update the consultation record
            $this->konsultasiModel->update($id, $data);

            // Redirect to admin dashboard with success message
            return redirect()->to("/admin/consultation/detail/{$id}")->with('success', 'Jadwal konsultasi berhasil dihapus.');

        } catch (\Exception $e) {
            // Log the error
            log_message('error', 'Delete Consultation Error: ' . $e->getMessage());

            return redirect()->to("/admin/consultation/detail/{$id}")
                ->with('error', 'Terjadi kesalahan saat menghapus jadwal konsultasi.');
        }
    }

    public function sendEmail()
    {
        $data = $this->request->getJSON(true);
        $email = $data['email'];
        $linkZoom = $data['linkZoom'];
        $jadwal = $data['jadwal'];
        $id_konsultasi = $data['id_konsultasi'];

        $konsultasi = $this->konsultasiModel->find($id_konsultasi);
        $konsultan = $this->konsultanModel->find($konsultasi['konsultan_id']);

        try {
            $emailService = \Config\Services::email();
            $emailService->setTo($email);
            $emailService->setFrom('mfauzanfk@gmail.com', 'PST Menjawab');
            $emailService->setSubject('Notifikasi Jadwal Konsultasi');
            $emailMessage = "
                <p>Halo <strong>{$konsultan['nama']}</strong>,</p>
                <p>Anda ditugaskan memandu konsultasi online ! Berikut detailnya:</p>
                <strong>Detail Permintaan :</strong><hr>
                <ul>
                    <li><strong>Nama Konsumen:</strong> {$konsultasi['nama_konsumen']}</li>
                    <li><strong>Topik:</strong> {$konsultasi['topik']}</li>
                    <li><strong>Kategori:</strong> {$konsultasi['kategori']}</li>
                    <li><strong>Lingkup:</strong> {$konsultasi['lingkup']}</li>
                    <li><strong>Deskripsi:</strong> {$konsultasi['deskripsi']}</li>                
                </ul>
                <br>
                <strong>Detail Pertemuan :</strong><hr>
                <ul>
                    <li><strong>Link Zoom:</strong> {$linkZoom}</li>
                    <li><strong>Jadwal:</strong> {$jadwal}</li>
                </ul>
                <p>Silakan tindak lanjuti sesuai prosedur.</p>
                <p>Terima kasih,<br>PST Menjawab BPS DKI Jakarta</p>
            ";

            $emailService->setMessage($emailMessage);

            if ($emailService->send()) {
                return $this->response->setJSON(['success' => true]);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal mengirim email']);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function sendWhatsApp()
    {
        $data = $this->request->getJSON(true);
        $whatsapp = $data['whatsapp'];
        $linkZoom = $data['linkZoom'];
        $jadwal = $data['jadwal'];
        $id_konsultasi = $data['id_konsultasi'];

        $konsultasi = $this->konsultasiModel->find($id_konsultasi);
        $konsultan = $this->konsultanModel->find($konsultasi['konsultan_id']);

        try {
            // Kirim notifikasi ke WhatsApp
            $message = "🔔 [ *RESERVASI KONSULTASI ONLINE* ] 🔔\n\n";
            $message .= "Halo, {$konsultan['nama']}!\n\n";
            $message .= "Anda ditugaskan memandu konsultasi online ! Berikut detailnya:\n\n";
            $message .= "*Detail Konsultasi:*\n\n";
            $message .= "*Nama:* {$konsultasi['nama_konsumen']}\n";
            $message .= "*Topik:* {$konsultasi['topik']}\n";
            $message .= "*Kategori:* {$konsultasi['kategori']}\n";
            $message .= "*Lingkup:* {$konsultasi['lingkup']}\n";
            $message .= "*Deskripsi:* {$konsultasi['deskripsi']}\n\n";
            $message .= "*Detail Pertemuan:*\n\n";
            $message .= "*Link Zoom:* {$linkZoom}\n";
            $message .= "*Jadwal:* {$jadwal}\n\n";
            $message .= "Silakan tindak lanjuti sesuai prosedur.\n";
            $message .= "Terima kasih \n*PST Menjawab BPS DKI Jakarta*";

            // Gunakan helper atau library API WhatsApp
            WAHelper::send_wa_notification($whatsapp, $message);

            return $this->response->setJSON(['success' => true]);
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => $e->getMessage()]);
        }
    }


}
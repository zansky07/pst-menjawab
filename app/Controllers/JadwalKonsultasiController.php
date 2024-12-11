<?php
namespace App\Controllers;

use App\Models\KonsultasiModel;
use App\Models\KonsultanModel;

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

            // Update data konsultasi
            $this->konsultasiModel->update($konsultasi_id, $data);

            // Redirect ke halaman notifikasi dengan pesan sukses
            return redirect()->to('/admin/consultation/notification/' . $konsultasi_id)
                ->with('success', 'Jadwal konsultasi berhasil disimpan');

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
}
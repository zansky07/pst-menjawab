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
        helper('form'); // Load the form helper

        // Cek autentikasi admin
        if (!session()->get('logged_in')) {
            return redirect()->to('/admin/login')->with('error', 'Silakan login terlebih dahulu!');
        }

        $data['konsultasi'] = $this->konsultasiModel->find($id);
        $data['konsultan'] = $this->konsultanModel->findAll();

        if (!$data['konsultasi']) {
            return redirect()->to('/admin/dashboard')->with('error', 'Data konsultasi tidak ditemukan.');
        }

        return view('jadwal_konsultasi', $data);
    }

    public function store()
    {
        // Cek autentikasi admin
        if (!session()->get('logged_in')) {
            return redirect()->to('/admin/login')->with('error', 'Silakan login terlebih dahulu!');
        }

        $data = [
            'jadwal_konsultasi' => $this->request->getPost('jadwal_konsultasi') . ' ' . $this->request->getPost('waktu_konsultasi'),
            'link_zoom' => $this->request->getPost('link_zoom'),
            'konsultan_id' => $this->request->getPost('konsultan_id'),
            'status_konsultasi' => 'Scheduled'
        ];

        $konsultasi_id = $this->request->getPost('konsultasi_id');
        // $this->konsultasiModel->update($konsultasi_id, $data);

        // Redirect ke halaman notifikasi
        return redirect()->to('/admin/consultation/notification/' . $konsultasi_id);
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
            return redirect()->to('/admin/dashboard')->with('error', 'Data konsultasi tidak ditemukan.');
        }

        // Setelah memastikan data konsultasi ada, baru ambil data konsultan
        $data['konsultan'] = $this->konsultanModel->find($data['konsultasi']['konsultan_id']);

        // Cek apakah data konsultan ditemukan
        if (!$data['konsultan']) {
            return redirect()->to('/admin/dashboard')->with('error', 'Data konsultan tidak ditemukan.');
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
            return redirect()->to('/admin/dashboard')->with('error', 'Data konsultasi atau konsultan tidak ditemukan.');
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
            return redirect()->to('/admin/dashboard')->with('success', $message);

        } catch (\Exception $e) {
            // Log the error
            log_message('error', 'Notification Error: ' . $e->getMessage());

            return redirect()->to('/admin/dashboard')
                ->with('error', 'Gagal mengirim notifikasi: ' . $e->getMessage());
        }
    }

}

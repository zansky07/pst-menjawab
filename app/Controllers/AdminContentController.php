<?php
namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\LaporanModel;
use App\Models\KonsultanModel;
use App\Models\KonsultasiModel;

class AdminContentController extends BaseController
{
        public function index(): string
        {
            // Periksa apakah pengguna sudah login
            if (!session()->get('logged_in')) {
                return redirect()->to('/admin/login')->with('error', 'Silakan login terlebih dahulu!');
            }
    
            $konsultasiModel = new KonsultasiModel();

            $data['requests'] = $konsultasiModel->orderBy('id', 'DESC')->paginate(10);
            $data['pager'] = $konsultasiModel->pager; // Add pager to the data array
    
            return view('dashboard_admin', $data); // Ensure the correct view path
        }
    
        public function filterDashboard()
        {
            // Periksa apakah pengguna sudah login
            if (!session()->get('logged_in')) {
                return redirect()->to('/admin/login')->with('error', 'Silakan login terlebih dahulu!');
            }

            $status = $this->request->getPost('status');
    
            // Load model
            $konsultasiModel = new KonsultasiModel();
    
            // Buat query dengan kondisi filter
            if ($status) {
                $requests = $konsultasiModel->where('status_konsultasi', $status)->paginate(4);
            } else {
                $requests = $konsultasiModel->paginate(10);
            }
    
            $pager = $konsultasiModel->pager;
    
            return view('dashboard_admin', ['requests' => $requests, 'pager' => $pager]);
        }    

        public function statistik()
        {
            if (!session()->get('logged_in')) {
                return redirect()->to('/admin/login')->with('error', 'Silakan login terlebih dahulu!');
            }
            $db = \Config\Database::connect();
            $visitorModel = $db->table('visitors');
            $konsultasiModel = new KonsultasiModel();

            // **Jumlah pengunjung total**
            $data['jumlahPengunjung'] = $visitorModel->countAllResults();

            // **Jumlah pengunjung harian**
            $today = new \CodeIgniter\I18n\Time('now');
            $data['jumlahPengunjungHarian'] = $visitorModel
                ->where('DATE(visited_at)', $today->toDateString())
                ->countAllResults();

            // Hitung jumlah permintaan konsultasi
            $data['jumlahPermintaan'] = $konsultasiModel->countAll();

            // Hitung jumlah permintaan yang disetujui
            $data['jumlahDisetujui'] = $konsultasiModel->where('status_konsultasi', 'disetujui')->countAllResults();

            // Hitung jumlah permintaan yang ditolak
            $data['jumlahDitolak'] = $konsultasiModel->where('status_konsultasi', 'ditolak')->countAllResults();

            // Ambil nilai filter dari query string, dengan nilai default 'semua'
            $data['status'] = $this->request->getGet('status') ?? 'semua';
            $data['periode'] = $this->request->getGet('periode') ?? 'semua';

            // Terapkan filter berdasarkan status
            if ($data['status'] !== 'semua') {
                $konsultasiModel->where('status_konsultasi', $data['status']);
            }

            // Default tanggal
            $startDate = null;
            $endDate = new \CodeIgniter\I18n\Time('now');

            // Tentukan tanggal start berdasarkan periode
            switch ($data['periode']) {
                case '1bulan':
                    $startDate = $endDate->subMonths(1);
                    break;
                case '3bulan':
                    $startDate = $endDate->subMonths(3);
                    break;
                case '6bulan':
                    $startDate = $endDate->subMonths(6);
                    break;
                case '12bulan':
                    $startDate = $endDate->subMonths(12);
                    break;
                default:
                    $startDate = null; // Tidak ada filter periode
                    break;
            }

            // Terapkan filter berdasarkan tanggal jika ada
            if ($startDate) {
                $konsultasiModel->where('tanggal_reservasi >=', $startDate->toDateString());
            }

            $data['chartData'] = $konsultasiModel->getStatistics($data['status'], [
                'start' => $startDate ? $startDate->toDateString() : null,
                'end' => $endDate->toDateString(),
            ]);

            $data['requests'] = $konsultasiModel->paginate(10); // Data dengan pagination
            $data['pager'] = $konsultasiModel->pager; // Pager untuk navigasi pagination

            return view('statistik_admin', $data);
        }
        
        private function exportCSV($data)
        {
            $filename = 'data.csv';
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
        
            $output = fopen('php://output', 'w');
            // Menulis header CSV
            fputcsv($output, ['Status', 'Tanggal Reservasi']);
        
            // Menulis data
            foreach ($data as $row) {
                fputcsv($output, [$row['status_konsultasi'], $row['tanggal_reservasi']]);
            }
        
            fclose($output);
        }

        private function exportXLSX($data)
        {
            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
        
            // Menulis header
            $sheet->setCellValue('A1', 'Status');
            $sheet->setCellValue('B1', 'Tanggal Reservasi');
        
            // Menulis data
            $row = 2;
            foreach ($data as $item) {
                $sheet->setCellValue('A' . $row, $item['status_konsultasi']);
                $sheet->setCellValue('B' . $row, $item['tanggal_reservasi']);
                $row++;
            }
        
            // Menyimpan file Excel
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $filename = 'data.xlsx';
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            $writer->save('php://output');
        }
        
        private function exportWord($data)
        {
            $phpWord = new \PhpOffice\PhpWord\PhpWord();
            $section = $phpWord->addSection();
        
            // Menulis header
            $section->addText('Status | Tanggal Reservasi', ['bold' => true]);
        
            // Menulis data
            foreach ($data as $item) {
                $section->addText("{$item['status_konsultasi']} | {$item['tanggal_reservasi']}");
            }
        
            // Menyimpan file Word
            $filename = 'data.docx';
            header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            $phpWord->save('php://output');
        }

        public function export()
        {
            if (!session()->get('logged_in')) {
                return redirect()->to('/admin/login')->with('error', 'Silakan login terlebih dahulu!');
            }
        
            $konsultasiModel = new KonsultasiModel();
        
            // Ambil nilai filter dari query string, dengan nilai default 'semua'
            $data['status'] = $this->request->getGet('status') ?? 'semua';
            $data['periode'] = $this->request->getGet('periode') ?? 'semua';
        
            // Terapkan filter berdasarkan status
            if ($data['status'] !== 'semua') {
                $konsultasiModel->where('status_konsultasi', $data['status']);
            }
        
            // Terapkan filter berdasarkan periode
            if ($data['periode'] !== 'semua') {
                $date = new \CodeIgniter\I18n\Time('now');
                switch ($data['periode']) {
                    case '1bulan':
                        $date->subMonths(1);
                        break;
                    case '3bulan':
                        $date->subMonths(3);
                        break;
                    case '6bulan':
                        $date->subMonths(6);
                        break;
                    case '12bulan':
                        $date->subMonths(12);
                        break;
                }
                $konsultasiModel->where('tanggal_reservasi >=', $date);
            }
        
            // Ambil data yang sesuai dengan filter
            $data = $konsultasiModel->findAll();
        
            // Tentukan format ekspor
            $format = $this->request->getGet('format');
            switch ($format) {
                case 'csv':
                    $this->exportCSV($data);
                    break;
                case 'xlsx':
                    $this->exportXLSX($data);
                    break;
                case 'word':
                    $this->exportWord($data);
                    break;
                default:
                    return redirect()->to('/admin/statistics')->with('error', 'Format ekspor tidak valid.');
            }
        }        
        
        public function pengaturan() { 
        // Periksa apakah pengguna sudah login 
        if (!session()->get('logged_in')) { 
            return redirect()->to('/admin/login')->with('error', 'Silakan login terlebih dahulu!'); 
        } 
        $adminModel = new AdminModel(); 
        $konsultanModel = new KonsultanModel(); 
        $data['admins'] = $adminModel->findAll(); 
        $data['konsultans'] = $konsultanModel->findAll(); 
        return view('pengaturan_admin', $data); 
        }

        public function pengaturan_admin() { 
            // Periksa apakah pengguna sudah login 
            if (!session()->get('logged_in')) { 
                return redirect()->to('/admin/login')->with('error', 'Silakan login terlebih dahulu!'); 
            } 
            $adminModel = new AdminModel();  
            $data['admins'] = $adminModel->findAll(); 
            return view('pengaturan_admin', $data); 
        }

        public function pengaturan_konsultan() { 
            // Periksa apakah pengguna sudah login 
            if (!session()->get('logged_in')) { 
                return redirect()->to('/admin/login')->with('error', 'Silakan login terlebih dahulu!'); 
            } 
            $konsultanModel = new KonsultanModel(); 
            $data['konsultans'] = $konsultanModel->findAll(); 
            return view('pengaturan_konsultan', $data); 
        }

        public function feedback(){
            if (!session()->get('logged_in')) { 
                return redirect()->to('/admin/login')->with('error', 'Silakan login terlebih dahulu!'); 
            }
            
            $model = new LaporanModel();

            // Ambil data feedback beserta laporan dan konsultan terkait
            $feedbacks = $model->getFeedbackWithDetails();

            // Hitung jumlah "Ya" dan "Tidak" untuk kebutuhan terjawab
            $terjawabYa = 0;
            $terjawabTidak = 0;

            $totalKepuasan = ['layanan' => 0, 'web' => 0, 'kemungkinan' => 0];
            $totalFeedback = count($feedbacks);

            foreach ($feedbacks as $feedback) {
                // Hitung kebutuhan terjawab
                if ($feedback['feedback4'] === 'Ya') {
                    $terjawabYa++;
                } elseif ($feedback['feedback4'] === 'Tidak') {
                    $terjawabTidak++;
                }

                // Hitung total kepuasan
                $totalKepuasan['layanan'] += (int) $feedback['feedback5'];
                $totalKepuasan['web'] += (int) $feedback['feedback3'];
                $totalKepuasan['kemungkinan'] += (int) $feedback['feedback2'];
            }

            
            
            $proporsiTerjawab = [
                'Ya' => $terjawabYa ,
                'Tidak' => $terjawabTidak,
            ];

            // Hitung rata-rata kepuasan
            $averageKepuasan = [
                'layanan' => $totalFeedback > 0 ? $totalKepuasan['layanan'] / $totalFeedback : 0,
                'web' => $totalFeedback > 0 ? $totalKepuasan['web'] / $totalFeedback : 0,
                'kemungkinan' => $totalFeedback > 0 ? $totalKepuasan['kemungkinan'] / $totalFeedback : 0,
            ];

            // Kirim data ke view
            $data = [
                'proporsiTerjawab' => $proporsiTerjawab,
                'averageKepuasan' => $averageKepuasan,
                'feedbacks' => $feedbacks, // Data lengkap untuk tabel
            ];

            return view('feedback_view', $data);
        
        }
}

<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\KonsultasiModel;
use App\Models\KonsultanModel;
use TCPDF;

class ExportController extends BaseController
{
    protected $konsultasiModel;
    protected $konsultanModel;

    public function __construct()
    {
        $this->konsultasiModel = new KonsultasiModel();
        $this->konsultanModel = new KonsultanModel();
    }

    private function addDocumentationImage($pdf, $dokumentasi)
    {
        if ($dokumentasi) {
            $imagePath = FCPATH . 'assets/images/dokum/' . $dokumentasi;
            if (file_exists($imagePath)) {
                // Get image dimensions
                list($width, $height) = getimagesize($imagePath);
                
                // Calculate aspect ratio
                $ratio = $width / $height;
                
                // Set maximum width for the image (considering page margins)
                $maxWidth = 170; // PDF width minus margins
                
                // Calculate new height maintaining aspect ratio
                $newWidth = min($width, $maxWidth);
                $newHeight = $newWidth / $ratio;
                
                // Add a new page if the current position plus image height exceeds page height
                if ($pdf->GetY() + $newHeight > $pdf->getPageHeight() - 20) {
                    $pdf->AddPage();
                }
                
                // Center the image
                $x = ($pdf->getPageWidth() - $newWidth) / 2;
                
                // Add image to PDF
                $pdf->Image($imagePath, $x, $pdf->GetY(), $newWidth);
                
                // Move position below the image
                $pdf->SetY($pdf->GetY() + $newHeight + 5);
            }
        }
    }

    public function exportPDF($id)
    {
        try {
            $data = $this->konsultasiModel
                ->select('konsultasi.*, konsultan.nama as nama_konsultan, konsultan.email as email_konsultan, konsultan.whatsapp as whatsapp_konsultan')
                ->join('konsultan', 'konsultan.id = konsultasi.konsultan_id')
                ->find($id);

            if (!$data) {
                return redirect()->back()->with('error', 'Data konsultasi tidak ditemukan');
            }

            // Buat instance TCPDF
            $pdf = new TCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);

            // Set informasi dokumen
            $pdf->SetCreator('PST System');
            $pdf->SetAuthor('PST System');
            $pdf->SetTitle('TRANSAKSI PST MENJAWAB');

            // Set margins
            $pdf->SetMargins(20, 20, 20);
            $pdf->SetHeaderMargin(5);
            $pdf->SetFooterMargin(10);

            // Hapus header dan footer default
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);

            // Tambah halaman
            $pdf->AddPage();

            // Set font untuk judul
            $pdf->SetFont('helvetica', 'B', 16);

            // Logo Dokum di pojok kiri atas
            $logoDokumPath = FCPATH . 'assets/images/dokum/logo.png';
            if (file_exists($logoDokumPath)) {
                $pdf->Image($logoDokumPath, 20, 10, 30, 15);
            }

            // Logo PST Menjawab di samping judul
            $logoPSTPath = FCPATH . 'assets/images/logo-pst.png';
            
            // Hitung posisi untuk logo PST dan judul
            $pageWidth = $pdf->getPageWidth();
            $startY = 15;  // Posisi Y untuk logo dan judul
            
            if (file_exists($logoPSTPath)) {
                // Posisikan logo PST di sebelah kiri judul
                $pdf->Image($logoPSTPath, ($pageWidth/2) - 60, $startY, 20, 20); // 20 adalah lebar logo
                
                // Judul di sebelah kanan logo
                $pdf->SetXY(($pageWidth/2) - 35, $startY);
                $pdf->Cell(70, 10, 'TRANSAKSI PST MENJAWAB', 0, 1, 'L');
            } else {
                // Jika logo tidak ada, tampilkan judul di tengah
                $pdf->Cell(0, 10, 'TRANSAKSI PST MENJAWAB', 0, 1, 'C');
            }
            
            $pdf->Ln(10);

            // Nomor Transaksi
            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->Cell(0, 10, 'DETAIL KONSULTASI #' . $id, 0, 1, 'C');
            $pdf->Ln(10);

            // Function untuk menambahkan baris data
            $addDataRow = function($label, $value) use ($pdf) {
                if ($value !== null && $value !== '') {
                    $pdf->SetFont('helvetica', 'B', 11);
                    $pdf->Cell(60, 7, $label, 0, 0);
                    $pdf->SetFont('helvetica', '', 11);
                    
                    // Jika label adalah 'Notula', gunakan format khusus
                    if ($label === 'Notula') {
                        $pdf->Cell(5, 7, ':', 0, 1);
                        $pdf->Ln(2);
                        $this->formatNotula($pdf, $value);
                    } 
                    // Jika label adalah 'Dokumentasi', hanya tampilkan nama file
                    elseif ($label === 'Dokumentasi') {
                        $pdf->Cell(5, 7, ':', 0, 1);
                        // Gambar akan ditampilkan secara terpisah
                    }
                    else {
                        if (strlen($value) > 50) {
                            $pdf->Cell(5, 7, ':', 0, 0);
                            $x = $pdf->GetX();
                            $y = $pdf->GetY();
                            $pdf->MultiCell(0, 7, $value, 0, 'L');
                            if ($pdf->GetY() - $y < 7) {
                                $pdf->SetY($y + 7);
                            }
                        } else {
                            $pdf->Cell(5, 7, ':', 0, 0);
                            $pdf->Cell(0, 7, $value, 0, 1);
                        }
                    }
                }
            };

            // [Sections untuk Data Konsumen dan Konsultan tetap sama...]
            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->Cell(0, 10, 'Data Konsumen', 0, 1, 'L');
            $pdf->SetDrawColor(200, 200, 200);
            $pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + 170, $pdf->GetY());
            $pdf->Ln(5);

            $addDataRow('Nama', $data['nama_konsumen']);
            $addDataRow('Email', $data['email_konsumen']);
            $addDataRow('WhatsApp', $data['whatsapp_konsumen']);
            $pdf->Ln(5);

            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->Cell(0, 10, 'Data Konsultan', 0, 1, 'L');
            $pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + 170, $pdf->GetY());
            $pdf->Ln(5);

            $addDataRow('Nama', $data['nama_konsultan']);
            $addDataRow('Email', $data['email_konsultan']);
            $addDataRow('WhatsApp', $data['whatsapp_konsultan']);
            $pdf->Ln(5);

            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->Cell(0, 10, 'Detail Konsultasi', 0, 1, 'L');
            $pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + 170, $pdf->GetY());
            $pdf->Ln(5);

            $addDataRow('Topik', $data['topik']);
            $addDataRow('Kategori', $data['kategori']);
            $addDataRow('Lingkup', $data['lingkup']);
            $addDataRow('Deskripsi', $data['deskripsi']);
            $addDataRow('Token Konsultasi', $data['token_konsultasi']);
            $addDataRow('Tanggal Reservasi', date('d/m/Y', strtotime($data['tanggal_reservasi'])));
            $addDataRow('Status', $this->getStatusLabel($data['status_konsultasi']));
            $addDataRow('Jadwal', $data['jadwal_konsultasi']);
            $addDataRow('Link Zoom', $data['link_zoom']);
            $addDataRow('Kehadiran', $data['kehadiran']);
            $pdf->Ln(5);

            // Hasil Konsultasi dengan gambar dokumentasi
            if ($data['status_konsultasi'] == 'completed' || $data['notula'] || $data['dokumentasi']) {
                $pdf->SetFont('helvetica', 'B', 12);
                $pdf->Cell(0, 10, 'Hasil Konsultasi', 0, 1, 'L');
                $pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + 170, $pdf->GetY());
                $pdf->Ln(5);

                if ($data['notula']) {
                    $addDataRow('Notula', $data['notula']);
                }

                if ($data['dokumentasi']) {
                    $pdf->SetFont('helvetica', 'B', 12);
                    $pdf->Cell(0, 10, 'Dokumentasi', 0, 1, 'L');
                    $pdf->Ln(2);
                    $this->addDocumentationImage($pdf, $data['dokumentasi']);
                }
            }

            // Output PDF
            $filename = 'TRANSAKSI_PST_MENJAWAB_' . $id . '_' . date('Ymd_His') . '.pdf';
            $pdf->Output($filename, 'D');

        } catch (\Exception $e) {
            log_message('error', '[ExportController::exportPDF] Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengekspor PDF');
        }
    }

    private function formatNotula($pdf, $notula) {
        // [Method formatNotula tetap sama seperti sebelumnya...]
        $lines = explode("\n", $notula);
        
        foreach ($lines as $line) {
            if (trim($line) === '') continue;
            
            if (strpos($line, 'Pertanyaan') === 0) {
                $pdf->SetFont('helvetica', 'B', 11);
                $pdf->setFillColor(240, 240, 240);
                $parts = explode(':', $line, 2);
                $questionNumber = trim($parts[0]);
                $questionText = isset($parts[1]) ? trim($parts[1]) : '';
                
                $pdf->Cell(0, 7, $questionNumber . ':', 0, 1, 'L', true);
                if ($questionText) {
                    $pdf->SetFont('helvetica', '', 11);
                    $pdf->MultiCell(0, 7, $questionText, 0, 'L', true);
                }
                $pdf->Ln(2);
            } 
            elseif (strpos($line, 'Jawaban') === 0) {
                $pdf->SetFont('helvetica', 'B', 11);
                $parts = explode(':', $line, 2);
                $answerLabel = trim($parts[0]);
                $answerText = isset($parts[1]) ? trim($parts[1]) : '';
                
                $pdf->Cell(0, 7, $answerLabel . ':', 0, 1, 'L');
                if ($answerText) {
                    $pdf->SetFont('helvetica', '', 11);
                    $pdf->MultiCell(0, 7, $answerText, 0, 'L');
                }
                $pdf->Ln(3);
            }
            else {
                $pdf->SetFont('helvetica', '', 11);
                $pdf->MultiCell(0, 7, $line, 0, 'L');
                $pdf->Ln(2);
            }
        }
    }

    private function getStatusLabel($status)
    {
        $labels = [
            'pending' => 'Menunggu',
            'accepted' => 'Diterima',
            'rejected' => 'Ditolak',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan'
        ];

        return $labels[$status] ?? $status;
    }
}
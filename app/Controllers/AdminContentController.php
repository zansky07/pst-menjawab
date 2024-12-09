<?php
namespace App\Controllers;

use App\Models\KonsultasiModel;
use App\Models\KonsultanModel;
use App\Models\AdminModel;

class AdminContentController extends BaseController
{
        public function index(): string
        {
            // Periksa apakah pengguna sudah login
            if (!session()->get('logged_in')) {
                return redirect()->to('/admin/login')->with('error', 'Silakan login terlebih dahulu!');
            }
    
            $konsultasiModel = new KonsultasiModel();
    
            $data['requests'] = $konsultasiModel->paginate(10);
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

    public function statistik() { 
        // Periksa apakah pengguna sudah login 
        if (!session()->get('logged_in')) {
            return redirect()->to('/admin/login')->with('error', 'Silakan login terlebih dahulu!');
        } 
            $konsultasiModel = new KonsultasiModel(); $data['requests'] = $konsultasiModel->findAll(); 
            return view('statistik_admin', $data); 
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
}

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
        $data['requests'] = $konsultasiModel->findAll();

        return view('dashboard_admin', $data);
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

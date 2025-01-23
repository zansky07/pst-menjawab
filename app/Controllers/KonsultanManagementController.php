<?php
namespace App\Controllers;

use App\Models\KonsultanModel;

class KonsultanManagementController extends BaseController
{
    public function create()
    {
         // Periksa apakah pengguna sudah login 
        if (!session()->get('logged_in')) { 
            return redirect()->to('/admin/login')->with('error', 'Silakan login terlebih dahulu!'); 
        } 

        // Periksa apakah pengguna memiliki role superadmin
        if (session()->get('role') !== 'superadmin') {
            return redirect()->to('/admin/dashboard')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini!');
        }

        return view('tambah_konsultan');
    }

    public function store()
    {
        $konsultanModel = new KonsultanModel();
        
        // Validasi input
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required|max_length[100]',
            'email' => 'required|valid_email|is_unique[konsultan.email]|max_length[50]',
            'whatsapp' => 'required|max_length[20]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $validation->getErrors()
            ]);
        }

        // Simpan data konsultan baru
        $konsultanModel->save([
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'whatsapp' => $this->request->getPost('whatsapp')
        ]);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Konsultan berhasil ditambahkan!'
        ]);
    }

    public function delete($id)
    {
        $konsultanModel = new KonsultanModel();

        // Menghapus data
        $isDeleted = $konsultanModel->delete($id);
    
        if ($isDeleted) {
            // Penghapusan berhasil
            session()->setFlashdata('delete_status', 'success');
            session()->setFlashdata('message', 'Data berhasil dihapus!');
        } else {
            // Penghapusan gagal
            session()->setFlashdata('delete_status', 'error');
            session()->setFlashdata('message', 'Data gagal dihapus!');
        }

        return redirect()->to('/admin/settings/consultant')->with('message', 'Konsultan berhasil dihapus!');
    }

    public function detail($id)
    {
        $konsultanModel = new KonsultanModel();
        $data['konsultan'] = $konsultanModel->find($id);

        return view('detail_konsultan', $data);
    }
}

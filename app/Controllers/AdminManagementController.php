<?php
namespace App\Controllers;

use App\Models\AdminModel;

class AdminManagementController extends BaseController
{
    public function create()
    {
        // Periksa apakah pengguna sudah login 
        if (!session()->get('logged_in')) { 
            return redirect()->to('/admin/login')->with('error', 'Silakan login terlebih dahulu!'); 
        } 
        return view('tambah_admin');
    }

    public function store()
    {
        $adminModel = new AdminModel();
        
        // Validasi input
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'username' => 'required|is_unique[admin.username]|max_length[20]',
            'nama' => 'required|max_length[20]',
            'email' => 'required|valid_email|max_length[50]',
            'password' => 'required|min_length[6]',
            'whatsapp' => 'required|max_length[20]',
            'role' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Hash password
        $password = $this->request->getPost('password');
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Simpan data admin baru
        $adminModel->save([
            'username' => $this->request->getPost('username'),
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'password' => $hashedPassword,
            'whatsapp' => $this->request->getPost('whatsapp'),
            'role' => $this->request->getPost('role')
        ]);

        return redirect()->to('/admin/settings/admin')->with('message', 'Admin berhasil ditambahkan!');
    
    }

    public function delete($id)
    {
        $adminModel = new AdminModel();

        // Menghapus data
        $isDeleted = $adminModel->delete($id);
    
        if ($isDeleted) {
            // Penghapusan berhasil
            session()->setFlashdata('delete_status', 'success');
            session()->setFlashdata('message', 'Data berhasil dihapus!');
        } else {
            // Penghapusan gagal
            session()->setFlashdata('delete_status', 'error');
            session()->setFlashdata('message', 'Data gagal dihapus!');
        }
    

        return redirect()->to('/admin/settings/admin')->with('message', 'Admin berhasil dihapus!');
    }

    public function detail($id)
    {
        $adminModel = new AdminModel();
        $data['admin'] = $adminModel->find($id);

        return view('detail_admin', $data);
    }


}

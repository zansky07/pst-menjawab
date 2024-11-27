<?php

namespace App\Controllers;
use App\Models\AdminModel;
use App\Models\KonsultasiModel;
use App\Models\KonsultanModel;

class Admin extends BaseController
{
    public function login(): string
    {
        return view('login_admin');
    }

    public function masuk()
    {
        $adminModel = new AdminModel();
        
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        
        // Cari data admin berdasarkan username
        $admin = $adminModel->where('username', $username)->first();

        if ($admin) {
            // Verifikasi password (gunakan password_hash di produksi)
            if (password_verify($password, $admin['password'])) {
                // Simpan sesi login
                session()->set([
                    'id'       => $admin['id'],
                    'username' => $admin['username'],
                    'logged_in' => true
                ]);

                return redirect()->to('/admin');
            } else {
                return redirect()->back()->with('error', 'Password salah!');
            }
        } else {
            return redirect()->back()->with('error', 'Username tidak ditemukan!');
        }
    }

    public function logout()
    {
        session()->destroy(); // Hapus sesi
        return redirect()->to('/staff');
    }

    public function dashboard(): string
    {
        // Periksa apakah pengguna sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/staff')->with('error', 'Silakan login terlebih dahulu!');
        }

        $konsultasiModel = new KonsultasiModel();
        $data['requests'] = $konsultasiModel->findAll();

        return view('dashboard_admin', $data);
    }

    public function detail($id)
    {
        // Periksa apakah pengguna sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/staff')->with('error', 'Silakan login terlebih dahulu!');
        }
        $konsultasiModel = new KonsultasiModel();
        $data['konsultasi'] = $konsultasiModel->find($id);

        if (!$data['konsultasi']) {
            return redirect()->to('/dashboard')->with('error', 'Data tidak ditemukan.');
        }

        return view('konsultasi_detail_admin', $data);
    }

    public function updateStatus($id)
    {
        $konsultasiModel = new KonsultasiModel();

        $status_konsultasi = $this->request->getPost('status_konsultasi');
        $konsultasiModel->update($id, ['status_konsultasi' => $status_konsultasi]);

        return redirect()->to('/statistik')->with('message', 'Status berhasil diperbarui.');
    }
    public function delete($id)
    {
        // Periksa apakah pengguna sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/staff')->with('error', 'Silakan login terlebih dahulu!');
        }

        $konsultasiModel = new konsultasiModel();
        $konsultasiModel->delete($id);

        return redirect()->to('/dashboard')->with('message', 'Data berhasil dihapus');
    }

    public function statistik() { 
    // Periksa apakah pengguna sudah login 
    if (!session()->get('logged_in')) {
        return redirect()->to('/staff')->with('error', 'Silakan login terlebih dahulu!');
    } 
        $konsultasiModel = new KonsultasiModel(); $data['requests'] = $konsultasiModel->findAll(); 
        return view('statistik_admin', $data); 
    }

    public function pengaturan() { 
    // Periksa apakah pengguna sudah login 
    if (!session()->get('logged_in')) { 
        return redirect()->to('/staff')->with('error', 'Silakan login terlebih dahulu!'); 
    } 
    $adminModel = new AdminModel(); 
    $konsultanModel = new KonsultanModel(); 
    $data['admins'] = $adminModel->findAll(); 
    $data['konsultans'] = $konsultanModel->findAll(); 
    return view('pengaturan_admin', $data); 
    }

    public function tambahAdmin()
    {
        // Periksa apakah pengguna sudah login 
        if (!session()->get('logged_in')) { 
            return redirect()->to('/staff')->with('error', 'Silakan login terlebih dahulu!'); 
        } 
        return view('tambah_admin');
    }

    public function simpanAdmin()
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

        return redirect()->to('/pengaturan')->with('message', 'Admin berhasil ditambahkan!');
    }

    public function detailAdmin($id)
    {
        $adminModel = new AdminModel();
        $data['admin'] = $adminModel->find($id);

        return view('detail_admin', $data);
    }

    public function deleteAdmin($id)
    {
        $adminModel = new AdminModel();
        $adminModel->delete($id);

        return redirect()->to('/pengaturan')->with('message', 'Admin berhasil dihapus!');
    }


    public function tambahKonsultan()
    {
        // Periksa apakah pengguna sudah login 
        if (!session()->get('logged_in')) { 
            return redirect()->to('/staff')->with('error', 'Silakan login terlebih dahulu!'); 
        } 
        return view('tambah_konsultan');
    }

    public function simpanKonsultan()
    {
        $konsultanModel = new KonsultanModel();
        
        // Validasi input
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required|max_length[100]',
            'email' => 'required|valid_email|max_length[50]',
            'whatsapp' => 'required|max_length[20]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Simpan data konsultan baru
        $konsultanModel->save([
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'whatsapp' => $this->request->getPost('whatsapp')
        ]);

        return redirect()->to('/pengaturan')->with('message', 'Konsultan berhasil ditambahkan!');
    }

    public function detailKonsultan($id)
    {
        $konsultanModel = new KonsultanModel();
        $data['konsultan'] = $konsultanModel->find($id);

        return view('detail_konsultan', $data);
    }

    public function deleteKonsultan($id)
    {
        $konsultanModel = new KonsultanModel();
        $konsultanModel->delete($id);

        return redirect()->to('/pengaturan')->with('message', 'Konsultan berhasil dihapus!');
    }
}

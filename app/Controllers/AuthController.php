<?php
namespace App\Controllers;

use App\Models\AdminModel;

class AuthController extends BaseController
{
    public function login()
    {
        return view('login_admin');
    }

    public function loginSubmit()
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

                return redirect()->to('/admin/dashboard');
            } else {
                return redirect()->back()->with('error', 'Password salah!');
            }
        } else {
            return redirect()->back()->with('error', 'Username tidak ditemukan!');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin/login');
    }
}
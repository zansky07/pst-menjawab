<?php

namespace App\Controllers;

use App\Models\KeywordModel;

class KeywordManagementController extends BaseController
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

        return view('tambah_keyword');
    }

    public function store()
{
    $rules = [
        'keyword' => [
            'rules' => 'required|min_length[3]|max_length[20]',
            'errors' => [
                'required'   => 'Keyword wajib diisi.',
                'min_length' => 'Keyword minimal 3 karakter.',
                'max_length' => 'Keyword maksimal 20 karakter.'
            ]
        ],
        'link' => [
            // wajib diawali http:// atau https://
            'rules' => 'required|regex_match[/^https?:\/\/.+$/]|max_length[200]',
            'errors' => [
                'required'    => 'Link wajib diisi.',
                'regex_match' => 'Link harus diawali dengan http:// atau https://',
                'max_length'  => 'Link maksimal 200 karakter.'
            ]
        ]
    ];

    if (! $this->validate($rules)) {
        return $this->response->setJSON([
            'success' => false,
            'errors'  => $this->validator->getErrors()
        ]);
    }

    $model = new KeywordModel();
    $saved = $model->add(
        $this->request->getPost('keyword'),
        $this->request->getPost('link')
    );

    if ($saved) {
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Keyword berhasil ditambahkan!'
        ]);
    }

    return $this->response->setJSON([
        'success' => false,
        'errors'  => ['db' => 'Gagal menyimpan data ke database.']
    ]);
}



    public function edit($id)
    {
        $model = new KeywordModel();
        $data['keyword'] = $model->find($id);

        return view('detail_keyword', $data);
    }

    public function update($id)
    {
        $rules = [
        'keyword' => [
            'rules' => 'required|min_length[3]|max_length[20]',
            'errors' => [
                'required'   => 'Keyword wajib diisi.',
                'min_length' => 'Keyword minimal 3 karakter.',
                'max_length' => 'Keyword maksimal 20 karakter.'
            ]
        ],
        'link' => [
            // wajib diawali http:// atau https://
            'rules' => 'required|regex_match[/^https?:\/\/.+$/]|max_length[200]',
            'errors' => [
                'required'    => 'Link wajib diisi.',
                'regex_match' => 'Link harus diawali dengan http:// atau https://',
                'max_length'  => 'Link maksimal 200 karakter.'
            ]
        ]
    ];

    if (! $this->validate($rules)) {
        return $this->response->setJSON([
            'success' => false,
            'errors'  => $this->validator->getErrors()
        ]);
    }

    $model = new KeywordModel();
    $saved = $model->update(
            $id,
            $this->request->getPost('keyword'),
            $this->request->getPost('link')
        );

    if ($saved) {
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Keyword berhasil ditambahkan!'
        ]);
    }

    return $this->response->setJSON([
        'success' => false,
        'errors'  => ['db' => 'Gagal menyimpan data ke database.']
    ]);
    }

    public function delete($id)
    {
        $model = new KeywordModel();
        $deleted = $model->delete($id);

        if ($deleted) {
            session()->setFlashdata('delete_status', 'success');
            session()->setFlashdata('message', 'Data keyword berhasil dihapus!');
        } else {
            session()->setFlashdata('delete_status', 'error');
            session()->setFlashdata('message', 'Data keyword gagal dihapus!');
        }

        return redirect()->to('/admin/settings/keyword');
    }

    // Endpoint JSON untuk chatbot
    public function getJson()
    {
        $model = new KeywordModel();
        return $this->response->setJSON($model->getAll());
    }
}

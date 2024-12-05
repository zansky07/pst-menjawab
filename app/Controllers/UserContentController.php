<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class UserContentController extends Controller
{
    public function __construct()
    {
        helper('url');
    }
    public function index()
    {
        // Menampilkan halaman beranda
        return view('home/index');
    }

    public function chatbot(): string
    {
        return view('chatbot');
    }

    public function consultation(): string
    {
        return view('konsultasi_user');
    }
    public function token()
    {
        return view('form_token_user');
    }
}

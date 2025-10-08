<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\VideoModel;

class UserContentController extends Controller
{
    public function __construct()
    {
        helper('url');
    }
    public function index()
    {
        // Menampilkan halaman beranda
        $videoModel = new VideoModel();
        $video = $videoModel->first();

        return view('home/index', [
            'videoLink' => $video ? $video['link_video'] : null
        ]);
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

<?php

namespace App\Controllers;

use App\Models\VideoModel;

class VideoController extends BaseController {

    public function index()
    {
        $model = new VideoModel();
        $video = $model->first(); // ambil video pertama (karena hanya satu)

        return view('pengaturan_video', [
            'videoLink' => $video ? $video['link_video'] : null
        ]);
    }

    public function update()
    {
        $model = new VideoModel();
        $newLink = $this->request->getPost('video_link');

        // --- Konversi otomatis link YouTube menjadi format embed ---
        $embedLink = $this->convertToEmbed($newLink);

        $video = $model->first();

        if ($video) {
            $update = $model->update($video['id'], ['link_video' => $embedLink]);
        } else {
            $update = $model->insert(['link_video' => $embedLink]);
        }

        if ($update) {
            return redirect()->to(base_url('/admin/settings/video'))
                ->with('update_status', 'success')
                ->with('message', 'Link video berhasil diperbarui!');
        } else {
            return redirect()->to(base_url('/admin/settings/video'))
                ->with('update_status', 'error')
                ->with('message', 'Gagal memperbarui link video.');
        }
    }

    /**
     * Fungsi konversi link YouTube ke format embed
     */
    private function convertToEmbed($url)
    {
        if (!preg_match('/(youtube\.com|youtu\.be)/', $url)) {
            return null; // atau langsung tolak via redirect
        }

        // --- Kasus 1: format panjang https://www.youtube.com/watch?v=xxxxx&ab_channel=...
        if (strpos($url, 'watch?v=') !== false) {
            $videoId = explode('watch?v=', $url)[1];
            $videoId = preg_split('/[?&]/', $videoId)[0]; // ambil ID sebelum tanda ? atau &
            return 'https://www.youtube.com/embed/' . $videoId;
        }

        // --- Kasus 2: format pendek https://youtu.be/xxxxx?si=...
        if (strpos($url, 'youtu.be/') !== false) {
            $videoId = explode('youtu.be/', $url)[1];
            $videoId = preg_split('/[?&]/', $videoId)[0]; // hapus semua parameter tambahan
            return 'https://www.youtube.com/embed/' . $videoId;
        }

        // --- Kasus 3: format embed sudah benar ---
        if (strpos($url, 'youtube.com/embed/') !== false) {
            $videoId = explode('youtube.com/embed/', $url)[1];
            $videoId = preg_split('/[?&]/', $videoId)[0];
            return 'https://www.youtube.com/embed/' . $videoId;
        }

        // --- Default: kembalikan apa adanya ---
        return $url;
    }




}

<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RecordVisitor implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $uri = $request->getUri()->getPath();
        if (strpos($uri, 'admin') === false) {
            $db = \Config\Database::connect();
            $builder = $db->table('visitors');

            // Data pengunjung
            $ipAddress = $request->getIPAddress();
            $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown';


            // Periksa apakah kunjungan telah tercatat dalam 30 menit terakhir
            $timeLimit = date('Y-m-d H:i:s', strtotime('-30 minutes'));
            $existingVisit = $builder->where('ip_address', $ipAddress)
                                    ->where('user_agent', $userAgent)
                                    ->where('visited_at >=', $timeLimit)
                                    ->get()
                                    ->getRow();

            if (!$existingVisit) {
                // Simpan data kunjungan baru
                $builder->insert([
                    'ip_address' => $ipAddress,
                    'user_agent' => $userAgent,
                ]);
            }

        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu implementasi di sini
    }
}

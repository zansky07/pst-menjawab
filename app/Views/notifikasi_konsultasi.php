<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirim Notifikasi</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>

<body class="bg-pink-50">
    <!-- Header/Navbar -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <img src="/images/logo.png" alt="Logo" class="h-8 w-auto">
                    <span class="ml-2 text-gray-900 font-medium">PST Menjawab BPS Provinsi DKI Jakarta</span>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="/dashboard" class="text-gray-900">Dashboard</a>
                    <a href="/statistik" class="text-gray-900">Statistik</a>
                    <a href="/pengaturan" class="text-gray-900">Pengaturan</a>
                </div>
            </div>
        </div>
    </nav>

    <body class="bg-pink-50">
        <div class="max-w-7xl mx-auto py-10 px-4">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-bold mb-6">Kirim Notifikasi</h2>

                <form action="<?= base_url('admin/consultation/notification/send/' . $konsultasi['id']) ?>"
                    method="post">
                    <input type="hidden" name="konsultasi_id" value="<?= $konsultasi['id'] ?>">
                    <input type="hidden" name="recipient" value="konsumen">
                    <input type="hidden" name="notification_type" value="both">

                    <!-- Konsumen Section -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Nama Konsumen</label>
                            <input type="text"
                                value="<?= isset($konsultasi['nama_konsumen']) ? esc($konsultasi['nama_konsumen']) : '' ?>"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 bg-pink-50" readonly>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Alamat Email Konsumen</label>
                                <div class="flex gap-2">
                                    <input type="email"
                                        value="<?= isset($konsultasi['email_konsumen']) ? esc($konsultasi['email_konsumen']) : '' ?>"
                                        class="flex-1 border border-gray-300 rounded-md px-4 py-2 bg-pink-50" readonly>
                                    <button type="button"
                                        class="bg-orange-500 text-white px-4 py-2 rounded-md hover:bg-orange-600">
                                        Kirim Notifikasi Email
                                    </button>
                                </div>
                            </div>

                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Nomor WA Konsumen</label>
                                <div class="flex gap-2">
                                    <input type="text"
                                        value="<?= isset($konsultasi['no_wa_konsumen']) ? esc($konsultasi['no_wa_konsumen']) : '' ?>"
                                        class="flex-1 border border-gray-300 rounded-md px-4 py-2 bg-pink-50" readonly>
                                    <button type="button"
                                        class="bg-orange-500 text-white px-4 py-2 rounded-md hover:bg-orange-600">
                                        Kirim Notifikasi WhatsApp
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Konsultan Section -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Nama Konsultan</label>
                            <input type="text" value="<?= isset($konsultan['nama']) ? esc($konsultan['nama']) : '' ?>"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 bg-pink-50" readonly>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Alamat Email Konsultan</label>
                                <div class="flex gap-2">
                                    <input type="email"
                                        value="<?= isset($konsultan['email']) ? esc($konsultan['email']) : '' ?>"
                                        class="flex-1 border border-gray-300 rounded-md px-4 py-2 bg-pink-50" readonly>
                                    <button type="button"
                                        class="bg-orange-500 text-white px-4 py-2 rounded-md hover:bg-orange-600">
                                        Kirim Notifikasi Email
                                    </button>
                                </div>
                            </div>

                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Nomor WA Konsultan</label>
                                <div class="flex gap-2">
                                    <input type="text"
                                        value="<?= isset($konsultan['whatsapp']) ? esc($konsultan['whatsapp']) : '' ?>"
                                        class="flex-1 border border-gray-300 rounded-md px-4 py-2 bg-pink-50" readonly>
                                    <button type="button"
                                        class="bg-orange-500 text-white px-4 py-2 rounded-md hover:bg-orange-600">
                                        Kirim Notifikasi WhatsApp
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Link Zoom</label>
                        <input type="text"
                            value="<?= isset($konsultasi['link_zoom']) ? esc($konsultasi['link_zoom']) : '' ?>"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 bg-pink-50" readonly>
                    </div>

                    <br> 
                    
                    <!-- Action Buttons -->
                    <div class="flex justify-end space-x-4">
                        <button type="submit"
                            href="<?= base_url('admin/dashboard') ?>"
                            class="bg-orange-500 text-white px-6 py-3 rounded-md font-semibold hover:bg-orange-700">
                            Simpan
                        </button>
                        <a href="<?= base_url('admin/dashboard') ?>"
                            class="bg-gray-700 text-white px-6 py-3 rounded-md font-semibold hover:bg-gray-800">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <footer class="bg-pink-100 mt-10">
            <div class="max-w-7xl mx-auto py-4 px-4">
                <p class="text-center text-gray-500 text-sm">
                    © 2024 BPS Provinsi DKI Jakarta. All rights reserved.
                </p>
            </div>
        </footer>
    </body>

</html>
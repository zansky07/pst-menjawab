<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success'); ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error'); ?>
    </div>
<?php endif; ?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelayanan Statistik Terpadu BPS Provinsi DKI Jakarta</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">

    <style>
        .service img {
            width: 50px;
            margin-bottom: 10px;
        }

        .service {
            transition: transform 0.2s;
        }

        .service:hover {
            transform: scale(1.05);
        }

        .welcome {
            font-size: 2.5vw;
            /* Ukuran berdasarkan lebar viewport */
            color: white;
            text-align: center;
            font-weight: bold;
            padding: 10px;
        }

        /* Gaya dasar untuk h2 */
        .welcome2 {
            font-size: 1.5vw;
            color: white;
            text-align: center;
            padding: 10px;
        }

        .fitur {
            min-height: 20rem;
            /* Set minimum height */
        }

        /* Responsif dengan media query */
        @media (max-width: 768px) {
            .welcome {
                font-size: 3.5vw;
                /* Teks lebih besar untuk layar kecil */
            }

            .welcome2 {
                font-size: 2.5vw;
            }
        }

        @media (max-width: 480px) {
            .welcome {
                font-size: 3vw;
                /* Teks lebih besar untuk layar yang lebih kecil */
            }

            .welcome2 {
                font-size: 2vw;
            }
        }

        section {
            border-radius: 40px;
        }
    </style>
</head>

<body style="margin: 0;" class="bg-oranye-1">
    <main class="container mx-auto mt-0 bg-oranye-1" style="background-image: url('<?= base_url('assets/images/bg-welcome.png') ?>'); background-size: cover; background-position: top; height: 70vh;">
        <!-- Video Thumbnail -->
        <div class="text-center mb-8">
            <h1 class="welcome">SELAMAT DATANG DI PST MENJAWAB</h1>
            <h2 class="welcome2">PELAYANAN STATISTIK TERPADU</h2>
            <h2 class="welcome2">BPS PROVINSI DKI JAKARTA</h2>
            <img src="<?= base_url('assets/images/vid.jpg') ?>" alt="Panduan" class="mx-auto">
        </div>

        <!-- Konsultasi Statistik -->
        <section class="text-center bg-biru-4 text-oranye-2 py-2 mb-8 w-1/2 mx-auto">
            <h2 class="text-2xl font-bold">Konsultasi Statistik</h2>
        </section>

        <div class="fitur grid grid-cols-1 md:grid-cols-3 mx-auto place-items-center space-y-1">
            <!-- Service 1 -->
            <div class="fitur text-center bg-oranye-3 shadow-lg p-6 rounded-lg transform hover:scale-105 transition max-w-sm">
                <img src="<?= base_url('assets/images/konsultasi-langsung.png') ?>" alt="Konsultasi Langsung" class="mx-auto w-12 mb-4">
                <h3 class="text-xl font-semibold">Konsultasi Langsung</h3>
                <p class="text-gray-600">Deskripsi layanan konsultasi langsung.</p>
            </div>
            <!-- Service 2 -->
            <a href="/chatbot" class="fitur text-center block bg-oranye-3 shadow-lg p-6 rounded-lg transform hover:scale-105 transition max-w-sm">
                <img src="<?= base_url('assets/images/chatbot.png') ?>" alt="Tanya-Jawab via Chat Bot" class="mx-auto w-12 mb-4">
                <h3 class="text-xl font-semibold">Tanya-Jawab via Chat Bot</h3>
                <p class="text-gray-600">Deskripsi layanan tanya-jawab via chat bot.</p>
            </a>
            <!-- Service 3 -->
            <a href="/consultation" class="fitur text-center block bg-oranye-3 shadow-lg p-6 rounded-lg transform hover:scale-105 transition max-w-sm">
                <img src="<?= base_url('assets/images/meeting.png') ?>" alt="Konsultasi via Pertemuan Daring" class="mx-auto w-12 mb-4">
                <h3 class="text-xl font-semibold">Konsultasi via Pertemuan Daring</h3>
                <p class="text-gray-600">Deskripsi layanan konsultasi via pertemuan daring.</p>
            </a>
        </div>

        <!-- Layanan Lainnya -->
        <section class="text-center bg-biru-4 text-oranye-2 py-2 mt-16 w-1/2 mx-auto">
            <h2 class="text-2xl font-bold">Layanan Lainnya</h2>
        </section>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mt-8">
            <!-- Service 4 -->
            <div class="fitur text-center bg-oranye-3 shadow-lg p-6 rounded-lg transform hover:scale-105 transition">
                <img src="<?= base_url('assets/images/cart.png') ?>" alt="Pengajuan Permintaan Data" class="mx-auto w-12 mb-4">
                <h3 class="text-lg font-semibold bg-biru-4 text-oranye-2">Penjualan Produk Statistik</h3>
                <p class="text-gray-600">Deskripsi layanan penjualan produk statistik.</p>
            </div>
            <!-- Service 5 -->
            <div class="fitur text-center bg-oranye-3 shadow-lg p-6 rounded-lg transform hover:scale-105 transition">
                <img src="<?= base_url('assets/images/buku.png') ?>" alt="Publikasi" class="mx-auto w-12 mb-4">
                <h3 class="text-lg font-semibold">Perpustakaan</h3>
                <p class="text-gray-600">Deskripsi layanan perpustakaan.</p>
            </div>
            <!-- Service 6 -->
            <div class="fitur text-center bg-oranye-3 shadow-lg p-6 rounded-lg transform hover:scale-105 transition">
                <img src="<?= base_url('assets/images/SILATIPA.png') ?>" alt="Survei" class="mx-auto w-12 mb-4">
                <h3 class="text-lg font-semibold">SILATIPA</h3>
                <p class="text-gray-600">Deskripsi layanan SILATIPA.</p>
            </div>
            <!-- Service 7 -->
            <div class="fitur text-center bg-oranye-3 shadow-lg p-6 rounded-lg transform hover:scale-105 transition">
                <img src="<?= base_url('assets/images/papan.png') ?>" alt="Informasi Terkini" class="mx-auto w-12 mb-4">
                <h3 class="text-lg font-semibold">Rekomendasi Kegiatan Statistik</h3>
                <p class="text-gray-600">Deskripsi layanan rekomendasi kegiatan statistik.</p>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
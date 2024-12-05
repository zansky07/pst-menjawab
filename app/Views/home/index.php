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
    </style>
</head>

<body style="margin: 0;">
    <main class="container mx-auto mt-0" style="background-image: url('<?= base_url('assets/images/bg-welcome.png') ?>'); background-size: cover; background-position: top; height: 50vh;">
        <!-- Video Thumbnail -->
        <div class="text-center mb-8">
            <img src="<?= base_url('assets/images/vid.jpg') ?>" alt="Panduan" class="mx-auto">
            <p class="text-gray-600 mt-2">Panduan User Video</p>
        </div>

        <!-- Konsultasi Statistik -->
        <section class="text-center bg-yellow-500 text-white py-4 mb-8">
            <h2 class="text-2xl font-bold">Konsultasi Statistik</h2>
        </section>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Service 1 -->
            <div class="bg-white shadow-lg p-6 rounded-lg transform hover:scale-105 transition">
                <img src="konsultasi-langsung.png" alt="Konsultasi Langsung" class="mx-auto w-12 mb-4">
                <h3 class="text-xl font-semibold">Konsultasi Langsung</h3>
                <p class="text-gray-600">Deskripsi layanan konsultasi langsung.</p>
            </div>
            <!-- Service 2 -->
            <a href="/chatbot" class="block bg-white shadow-lg p-6 rounded-lg transform hover:scale-105 transition">
                <img src="icon2.png" alt="Tanya-Jawab via Chat Bot" class="mx-auto w-12 mb-4">
                <h3 class="text-xl font-semibold">Tanya-Jawab via Chat Bot</h3>
                <p class="text-gray-600">Deskripsi layanan tanya-jawab via chat bot.</p>
            </a>
            <!-- Service 3 -->
            <a href="/consultation" class="block bg-white shadow-lg p-6 rounded-lg transform hover:scale-105 transition">
                <img src="icon3.png" alt="Konsultasi via Pertemuan Daring" class="mx-auto w-12 mb-4">
                <h3 class="text-xl font-semibold">Konsultasi via Pertemuan Daring</h3>
                <p class="text-gray-600">Deskripsi layanan konsultasi via pertemuan daring.</p>
            </a>
        </div>

        <!-- Layanan Lainnya -->
        <section class="text-center bg-yellow-500 text-white py-4 mt-16">
            <h2 class="text-2xl font-bold">Layanan Lainnya</h2>
        </section>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mt-8">
            <!-- Service 4 -->
            <div class="bg-white shadow-lg p-6 rounded-lg transform hover:scale-105 transition">
                <img src="icon4.png" alt="Pengajuan Permintaan Data" class="mx-auto w-12 mb-4">
                <h3 class="text-lg font-semibold">Pengajuan Permintaan Data</h3>
                <p class="text-gray-600">Deskripsi layanan pengajuan permintaan data.</p>
            </div>
            <!-- Service 5 -->
            <div class="bg-white shadow-lg p-6 rounded-lg transform hover:scale-105 transition">
                <img src="icon5.png" alt="Publikasi" class="mx-auto w-12 mb-4">
                <h3 class="text-lg font-semibold">Publikasi</h3>
                <p class="text-gray-600">Deskripsi layanan publikasi.</p>
            </div>
            <!-- Service 6 -->
            <div class="bg-white shadow-lg p-6 rounded-lg transform hover:scale-105 transition">
                <img src="icon6.png" alt="Survei" class="mx-auto w-12 mb-4">
                <h3 class="text-lg font-semibold">Survei</h3>
                <p class="text-gray-600">Deskripsi layanan survei.</p>
            </div>
            <!-- Service 7 -->
            <div class="bg-white shadow-lg p-6 rounded-lg transform hover:scale-105 transition">
                <img src="icon7.png" alt="Informasi Terkini" class="mx-auto w-12 mb-4">
                <h3 class="text-lg font-semibold">Informasi Terkini</h3>
                <p class="text-gray-600">Deskripsi layanan informasi terkini.</p>
            </div>
        </div>
    </main>
    <div class="container-fluid bg-warning text-white text-center py-3">
        <p>&copy; 2024 BPS Provinsi DKI Jakarta</p>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
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
<body>
    <header class="bg-warning text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-2 text-center">
                    <img src="logo.png" alt="Logo" width="50">
                </div>
                <div class="col-md-10">
                    <h1 class="mb-0">Pelayanan Statistik Terpadu BPS Provinsi DKI Jakarta Aku</h1>
                </div>
            </div>
        </div>
    </header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/konsultasi">Konsultasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/chatbot">Chatbot</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/konsultasi/cekReservasi">Cek Reservasi</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container my-4">
        <div class="row">
            <div class="col-12 text-center mb-4">
                <img src="video-thumbnail.png" alt="Panduan User Video" class="img-fluid">
                <p>Panduan User Video</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center bg-warning text-white py-2 mb-4">
                <h2>Konsultasi Statistik</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="service bg-light p-3 text-center h-100">
                    <img src="icon1.png" alt="Konsultasi Langsung">
                    <h3>Konsultasi Langsung</h3>
                    <p>Deskripsi layanan konsultasi langsung.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <a href="/chatbot" class="text-decoration-none text-dark">
                    <div class="service bg-light p-3 text-center h-100">
                        <img src="icon2.png" alt="Tanya-Jawab via Chat Bot">
                        <h3>Tanya-Jawab via Chat Bot</h3>
                        <p>Deskripsi layanan tanya-jawab via chat bot.</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="/konsultasi" class="text-decoration-none text-dark">
                    <div class="service bg-light p-3 text-center h-100">
                        <img src="icon3.png" alt="Konsultasi via Pertemuan Daring">
                        <h3>Konsultasi via Pertemuan Daring</h3>
                        <p>Deskripsi layanan konsultasi via pertemuan daring.</p>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center bg-warning text-white py-2 mb-4">
                <h2>Layanan Lainnya</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="service bg-light p-3 text-center h-100">
                    <img src="icon4.png" alt="Pengajuan Permintaan Data">
                    <h3>Pengajuan Permintaan Data</h3>
                    <p>Deskripsi layanan pengajuan permintaan data.</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="service bg-light p-3 text-center h-100">
                    <img src="icon5.png" alt="Publikasi">
                    <h3>Publikasi</h3>
                    <p>Deskripsi layanan publikasi.</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="service bg-light p-3 text-center h-100">
                    <img src="icon6.png" alt="Survei">
                    <h3>Survei</h3>
                    <p>Deskripsi layanan survei.</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="service bg-light p-3 text-center h-100">
                    <img src="icon7.png" alt="Informasi Terkini">
                    <h3>Informasi Terkini</h3>
                    <p>Deskripsi layanan informasi terkini.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-warning text-white text-center py-3">
        <p>&copy; 2024 BPS Provinsi DKI Jakarta</p>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

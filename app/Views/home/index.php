<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelayanan Statistik Terpadu BPS Provinsi DKI Jakarta</title>
    <link rel="icon" href="/assets/images/logo-pst.png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">

    <style>
        a{
            text-decoration: none;
        }

        a:hover{
            text-decoration: none; 
        }

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
            font-size: 2vw;
            color: white;
            text-align: center;
            font-weight: bold;
            padding: 10px;
            font-family: Arial, sans-serif;
        }


        /* Gaya dasar untuk h2 */
        .welcome2 {
            font-size: 1.5vw;
            color: white;
            text-align: center;
            padding: 10px;
            font-family: Arial, sans-serif;
        }

        .fitur {
            min-height: 20rem;
            /* Set minimum height */
            cursor: pointer;
        }

        .hidden {
            display: none;
        }

        .modal {
            z-index: 1000;
        }

        .modal-content {
            transform: scale(0.95);
            opacity: 0;
            transition: transform 0.3s ease-out, opacity 0.3s ease-out;
        }

        .modal.show .modal-content {
            transform: scale(1);
            opacity: 1;
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

            .modal-content {
                padding: 1.5rem;
                font-size: 0.9rem;
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

            .modal-content {
                font-size: 0.8rem;
            }

            #closeModalBtn {
                top: 8px;
                right: 8px;
                font-size: 1.5rem;
            }
        }

        section {
            border-radius: 40px;
        }

        /* Responsif untuk Tablet */
        @media (max-width: 1024px) {
            .welcome {
                font-size: 4vw;
                /* Ukuran font lebih kecil di tablet */
            }

            .welcome2 {
                font-size: 3.5vw;
                /* Ukuran font lebih kecil di tablet */
            }

            .grid {
                grid-template-columns: 1fr 1fr;
                /* 2 kolom pada layar tablet */
            }

            .fitur {
                padding: 1rem;
                /* Padding lebih kecil untuk fiturnya */
            }

            .container {
                padding-left: 1rem;
                padding-right: 1rem;
                /* Padding container dikurangi pada layar tablet */
            }
        }

        /* Responsif untuk Smartphone */
        @media (max-width: 768px) {
            .welcome {
                font-size: 3vw;
                /* Ukuran font lebih kecil untuk smartphone */
            }

            .welcome2 {
                font-size: 2vw;
                /* Ukuran font lebih kecil untuk smartphone */
            }

            .grid {
                grid-template-columns: 1fr;
                /* 1 kolom pada layar smartphone */
            }

            .fitur {
                padding: 0.5rem;
                /* Padding lebih kecil untuk fitur */
            }

            .container {
                padding-left: 0.5rem;
                padding-right: 0.5rem;
                /* Padding container lebih kecil */
            }

            /* Menyesuaikan gambar dalam fitur */
            .service img {
                width: 40px;
                /* Ukuran gambar lebih kecil pada smartphone */
            }

            .alert {
                font-size: 12px;
                /* Ukuran font alert lebih kecil pada smartphone */
            }

            p {
                font-size: 11px;
            }

            h3.text-lg,
            h3.text-xl {
                font-size: 12px;
            }
        }

        /* Pastikan grid layout tetap responsif untuk ukuran lebih kecil */
        @media (max-width: 480px) {
            .grid {
                grid-template-columns: 1fr;
                /* 1 kolom pada perangkat lebih kecil */
            }

            .fitur {
                min-height: auto;
                /* Sesuaikan tinggi fitur */
            }

            .text-left {
                text-align: center;
                /* Untuk memastikan teks lebih rapi di layar kecil */
            }
        }
    </style>
</head>

<body style="margin: 0; height: 260vh;" class="bg-oranye-1">
    <main class="container-fluid mx-auto mt-0 bg-oranye-1" style="background-image: url('<?= base_url('assets/images/bg-welcome.png') ?>'); background-size: cover; background-position: top; height: 65vh;">
        <nav class="bg-white shadow shadow-gray-300 fixed top-0 left-0 w-full px-8 z-50">
            <div class="md:h-16 h-28 mx-auto md:px-4 container flex items-center justify-between flex-wrap md:flex-nowrap">
                <div class="flex items-center space-x-4">
                    <img src="/assets/images/logo-pst.png" alt="Logo" class="h-10 w-10">
                    <span class="text-gray-800 hover:text-oranye-2 font-semibold text-sm md:text-base"><a href="/"> PST Menjawab BPS Provinsi DKI Jakarta </a></span>
                </div>
                <div class="text-oranye-4 order-3 w-full md:w-auto md:order-2">
                    <ul class="flex font-semibold items-center justify-between space-x-4">
                        <li class="hover:text-oranye-2">
                            <a href="/consultation">Konsultasi</a>
                        </li>
                        <li class="hover:text-oranye-2">
                            <a href="/chatbot">Chatbot</a>
                        </li>
                        <li class="hover:text-oranye-2">
                            <a href="/consultation/checkReservation">Cek Reservasi</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Video Thumbnail -->
        <div class="text-center mb-8">
            <br><br><br><br>
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
            <h1 class=" welcome">SELAMAT DATANG DI PST MENJAWAB</h1>
            <h2 class="welcome2">PELAYANAN STATISTIK TERPADU</h2>
            <h2 class="welcome2">BPS PROVINSI DKI JAKARTA</h2>
            <img src="<?= base_url('assets/images/vid.jpg') ?>" alt="Panduan" class="mx-auto" style="margin-top: 40px;">
        </div>

        <!-- Konsultasi Statistik -->
        <section class="text-center bg-biru-4 text-oranye-2 py-2 mb-8 w-1/2 mx-auto" style="margin-top: 20px;">
            <h2 class="text-2xl font-bold">Konsultasi Statistik</h2>
        </section>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-8 mt-8 mx-auto justify-items-center text-center w-4/5">
            <!-- Service 1 -->
            <div id="consultationCard" class="fitur text-center bg-oranye-3 shadow-lg p-6 rounded-lg transform hover:scale-105 transition max-w-sm">
                <h3 class="text-xl font-semibold bg-biru-4 text-oranye-2">Konsultasi Langsung</h3>
                <img src="<?= base_url('assets/images/konsultasi-langsung.png') ?>" alt="Konsultasi Langsung" class="mx-auto w-28 mb-4" style="margin-top: 20px;">
                <p class="text-white text-left">Anda dapat melakukan konsultasi secara langsung dengan mengunjungi BPS Provinsi DKI Jakarta atau kantor BPS di kabupaten/kota seluruh Indonesia. Layanan ini memungkinkan Anda untuk bertatap muka dengan petugas BPS, sehingga mempermudah penyampaian kebutuhan data atau pertanyaan Anda secara lebih mendalam.</p>
            </div>
            <!-- Service 2 -->
            <a href="/chatbot" class="fitur text-center block bg-oranye-3 shadow-lg p-6 rounded-lg transform hover:scale-105 hover:text-oranye-2 transition max-w-sm">
                <h3 class="text-xl font-semibold bg-biru-4 text-oranye-2">Tanya-Jawab via Chat Bot</h3>
                <img src="<?= base_url('assets/images/chatbot.png') ?>" alt="Tanya-Jawab via Chat Bot" class="mx-auto w-28 mb-4" style="margin-top: 20px;">
                <p class="text-white text-left">Anda dapat mengajukan pertanyaan umum melalui chatbot, dan chatbot akan memberikan jawaban secara otomatis dengan cepat dan akurat. Fitur ini memudahkan Anda mendapatkan informasi langsung tanpa perlu menunggu lama, dengan jawaban yang relevan dan tepat sesuai dengan pertanyaan yang diajukan.</p>
            </a>
            <!-- Service 3 -->
            <a href="/consultation/reserve" class="fitur text-center block bg-oranye-3 shadow-lg p-6 rounded-lg transform hover:scale-105 hover:text-oranye-2 transition max-w-sm">
                <h3 class="text-xl font-semibold bg-biru-4 text-oranye-2">Konsultasi via Pertemuan Daring</h3>
                <img src="<?= base_url('assets/images/meeting.png') ?>" alt="Konsultasi via Pertemuan Daring" class="mx-auto w-28 mb-4" style="margin-top: 20px;">
                <p class="text-white text-left">Layanan ini memungkinkan Anda untuk berkomunikasi secara langsung dengan petugas melalui pertemuan daring, sehingga Anda tetap dapat memperoleh informasi atau menyampaikan kebutuhan data tanpa harus pergi ke kantor BPS.</p>
            </a>
        </div>

        <!-- Modal -->
        <div id="consultationModal" class="modal hidden fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50">
            <div class="modal-content bg-orange-400 text-white rounded-lg p-6 w-11/12 md:w-3/4 lg:w-1/3 relative transform scale-95 opacity-0 transition-transform duration-300">
                <button id="closeModalBtn" class="absolute top-4 right-4 text-white text-xl font-bold">&times;</button>
                <h2 class="text-xl font-semibold">Ingin konsultasi secara langsung?</h2>
                <hr>
                <p class="mt-4">Kunjungi kantor BPS Provinsi DKI Jakarta dengan alamat berikut:</p>
                <a href="https://maps.app.goo.gl/7pusYpQhNL4hNvKG7">
                    <p class="mt-2 font-bold">Jl. Salemba Tengah No.36 38, RT.2/RW.4, Paseban, Senen, Central Jakarta City, Jakarta 10440</p>
                </a>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126911.81092355371!2d106.78849620141449!3d-6.264506171010917!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f44329ef4425%3A0xa230b346572fa767!2sBadan%20Pusat%20Statistik%20(BPS)%20-%20Provinsi%20DKI%20Jakarta!5e0!3m2!1sen!2sid!4v1734628633494!5m2!1sen!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>


        <!-- Layanan Lainnya -->
        <section class="text-center bg-biru-4 text-oranye-2 py-2 mt-16 w-1/2 mx-auto" style="margin-top:20vh;">
            <h2 class="text-2xl font-bold">Layanan Lainnya</h2>
        </section>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mt-8 mx-auto text-center" style="max-width: 80%;">
            <!-- Service 4 -->
            <a href="https://pst.bps.go.id/login" class="fitur text-center bg-oranye-3 shadow-lg p-6 rounded-lg transform hover:scale-105 transition">
                <h3 class="text-lg font-semibold bg-biru-4 text-oranye-2">Penjualan Produk Statistik</h3>
                <img src="<?= base_url('assets/images/cart.png') ?>" alt="Pengajuan Permintaan Data" class="mx-auto w-20 mb-4" style="margin-top: 20px;">
                <p class=" text-white text-left">Layanan penjualan data mikro, publikasi elektronik, dan peta digital wilkerstat.

                </p>
            </a>
            <!-- Service 5 -->
            <a href="https://perpustakaan.bps.go.id/" class="fitur text-center bg-oranye-3 shadow-lg p-6 rounded-lg transform hover:scale-105 transition">
                <h3 class="text-lg font-semibold bg-biru-4 text-oranye-2">Perpustakaan</h3>
                <img src="<?= base_url('assets/images/buku.png') ?>" alt="Publikasi" class="mx-auto w-20 mb-4" style="margin-top: 20px;">
                <p class=" text-white text-left">Layanan Perpustakaan BPS menyediakan akses publikasi statistik terbitan resmi dari Badan Pusat Statistik (BPS) yang mencakup berbagai kategori, seperti kependudukan, sosial, sosial ekonomi, pertanian, dan lainnya.</p>
            </a>
            <!-- Service 6 -->
            <a href="https://play.google.com/store/apps/details/SILATIPA?id=jakarta.bps.go.id.layanan3100&hl=id" class="fitur text-center bg-oranye-3 shadow-lg p-6 rounded-lg transform hover:scale-105 transition">
                <h3 class="text-lg font-semibold bg-biru-4 text-oranye-2">SILATIPA</h3>
                <img src="<?= base_url('assets/images/SILATIPA.png') ?>" alt="Survei" class="mx-auto w-20 mb-4" style="margin-top: 20px;">
                <p class=" text-white text-left">SILATIPA adalah aplikasi yang menampilkan produk statistik dari BPS Provinsi DKI Jakarta, dengan menu yang mencakup Data Strategis, Data Unggulan, Statistik Sektoral, Permintaan Data, Berita terkini, dan sebagainya.</p>
            </a>
            <!-- Service 7 -->
            <a href="https://pst.bps.go.id/login" class="fitur text-center bg-oranye-3 shadow-lg p-6 rounded-lg transform hover:scale-105 transition">
                <h3 class="text-lg font-semibold bg-biru-4 text-oranye-2">Rekomendasi Kegiatan</h3>
                <img src="<?= base_url('assets/images/papan.png') ?>" alt="Informasi Terkini" class="mx-auto w-20 mb-4" style="margin-top: 20px;">
                <p class=" text-white text-left">Rekomendasi Kegiatan Statistik adalah layanan untuk instansi pemerintah yang akan melakukan survei dan membutuhkan saran terkait kegiatan statistik, membantu merencanakan dan mengembangkan survei yang efektif dan sesuai kebutuhan.</p>
            </a>
            </div>
            <div class="relative" id="footer">
                <img src="/assets/images/footer.png" alt="footer" class="w-full">
                <div class="absolute inset-0 flex flex-col items-center justify-end text-white text-center px-5 text-lg pb-12">
                    <div class="flex justify-between items-center w-full max-w-6xl mb-8 space-x-8"> <div class="w-1/3 text-left">
                            <div class="flex items-center space-x-4">
                                <img src="/assets/images/logo-pst.png" alt="Logo" class="h-12 w-12">
                                <h3 class="text-xl font-semibold">Badan Pusat Statistik Provinsi DKI Jakarta</h3>
                            </div>
                            <p class="mt-4 text-base">Jl. Salemba Tengah No. 36-38 Paseban Senen Jakarta Pusat <br>
                                <span>Phone (021) 31928493</span>
                                <br>
                                <span>Fax. (021) 3152004</span>
                                <br>
                                <span>E-mail: bps3100@bps.go.id</span>
                            </p>
                        </div>
                        <div class="w-1/3 text-left">
                            <h4 class="text-xl font-semibold">Website Lainnya:</h4>
                            <ul class="list-none text-base">
                                <li>
                                    <a href="https://www.bps.go.id" class="underline">Website BPS Indonesia</a>
                                </li>
                                <li>
                                    <a href="https://jakarta.bps.go.id" class="underline">Website BPS Provinsi DKI Jakarta</a>
                                </li>
                                <li>
                                    <a href="https://pst.bps.go.id" class="underline">Website Pelayanan Statistik Terpadu</a>
                                </li>
                                <li>
                                    <a href="https://silastik.bps.go.id" class="underline">Website SILASTIK</a>
                                </li>
                            </ul>
                        </div>
                        <div class="w-1/3 text-left">
                            <h4 class="text-xl font-semibold">Sosial Media:</h4>
                            <ul class="list-none text-base">
                                <li>
                                    <a href="https://www.facebook.com/bpsdkijakarta/" class="underline">Facebook</a>
                                </li>
                                <li>
                                    <a href="https://x.com/bpsdkijakarta/" class="underline">Twitter</a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/bpsdkijakarta/" class="underline">Instagram</a>
                                </li>
                                <li>
                                    <a href="https://www.youtube.com/c/BPSDKI" class="underline">YouTube</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-6 text-sm"> &copy; 2024 Badan Pusat Statistik Provinsi DKI Jakarta. All rights reserved. </div>
                </div>
            </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Menampilkan modal dengan animasi
        document.getElementById('consultationCard').addEventListener('click', function () {
            const modal = document.getElementById('consultationModal');
            modal.classList.remove('hidden');
            setTimeout(() => modal.classList.add('show'), 10); // Tambahkan class `show` setelah render
        });

        // Menutup modal ketika tombol "X" diklik
        document.getElementById('closeModalBtn').addEventListener('click', function () {
            const modal = document.getElementById('consultationModal');
            modal.classList.remove('show');
            setTimeout(() => modal.classList.add('hidden'), 300); // Sembunyikan modal setelah animasi selesai
        });

        // Menutup modal ketika klik di luar area modal
        document.getElementById('consultationModal').addEventListener('click', function (event) {
            if (event.target === this) {
                const modal = document.getElementById('consultationModal');
                modal.classList.remove('show');
                setTimeout(() => modal.classList.add('hidden'), 300);
            }
        });


    </script>
</body>

</html>
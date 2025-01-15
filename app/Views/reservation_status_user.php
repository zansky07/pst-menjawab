<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PST Menjawab | Status Reservasi</title>
    <link rel="icon" href="/assets/images/logo-pst.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/form.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>

<body class="bg-oranye-1 mt-28 md:mt-16">
    <nav class="bg-white shadow shadow-gray-300 fixed top-0 left-0 w-full px-8 z-50">
        <div class="md:h-16 h-28 mx-auto md:px-4 container flex items-center justify-between flex-wrap md:flex-nowrap">
            <div class="flex items-center space-x-4">
                <img src="/assets/images/logo-pst.png" alt="Logo" class="h-10 w-10">
                <span class="text-gray-800 hover:text-oranye-2 font-semibold text-sm md:text-base"><a href="/"> PST
                        Menjawab BPS Provinsi DKI Jakarta </a></span>
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
    <div class="max-w-lg mx-auto rounded-lg shadow-lg mt-20">
        <form action="/consultation/status" method="get">
            <?= csrf_field() ?> <!-- Tambahkan CSRF protection -->
            <div class="flex items-center mb-4">
                <input type="text" id="token" name="token"
                    class="bg-white flex-grow p-2 border border-gray-300 rounded-l-md" placeholder="Masukkan Token Anda"
                    value="<?= old('token') ? esc(old('token')) : '' ?>" required>
                <button type="submit" class="bg-orange-500 text-white py-2 px-4 rounded-r-md hover:bg-orange-600">
                    Cari
                </button>
            </div>
        </form>
    </div>

    <?php if (isset($reservation)): ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="mb-4 p-2 bg-red-100 text-red-700 rounded">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <div class="max-w-lg mx-auto status bg-white p-4 rounded-lg text-center border border-orange-300 shadow-md">
            <div class="grid grid-cols-3 gap-4">
                <p class="col-span-1 mb-2 text-left">Nomor Token</p>
                <button id="copyTokenButton"
                    class="col-span-2 bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-full"
                    onclick="copyToClipboard('<?= esc($token) ?>')">
                    <?= esc($token) ?>
                </button>
                <script>
                    function copyToClipboard(value) {
                        // Buat elemen input sementara
                        const tempInput = document.createElement('input');
                        tempInput.value = value; // Isi dengan nilai yang akan disalin
                        document.body.appendChild(tempInput); // Tambahkan ke dokumen

                        // Salin nilai ke clipboard
                        tempInput.select();
                        document.execCommand('copy');

                        // Hapus elemen input sementara
                        document.body.removeChild(tempInput);

                        // Tampilkan notifikasi (opsional)
                        alert('Token berhasil disalin ke clipboard: ' + value);
                    }
                </script>
                <p class="col-span-1 mb-2 text-left">Tanggal Reservasi</p>
                <button class="col-span-2 bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-full">
                    <?= esc($reservation['tanggal_reservasi']) ?>
                </button>
                <p class="col-span-1 mb-2 text-left">Status Reservasi</p>
                <button class="col-span-2 bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-full">
                    <?= esc($reservation['status']) ?>
                </button>
            </div>

            <?php if ($reservation['status'] == 'Disetujui'): ?>
                <div class="grid grid-cols-3 gap-4 mt-4">
                    <p class="col-span-1 mb-2 text-left">Link Pertemuan</p>
                    <a href="<?= esc($reservation['zoom']) ?>" target="_blank"
                        class="col-span-2 bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-full text-center">
                        Link Zoom
                    </a>
                    <p class="col-span-1 mb-2 text-left">Waktu Pertemuan</p>
                    <button class="col-span-2 bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-full">
                        <?= esc($reservation['waktu_pertemuan']) ?>
                    </button>
                </div>
            <?php endif; ?>

            <?php if ($reservation['status'] == 'Ditolak'): ?>
                <div class="grid grid-cols-3 gap-4 mt-4">
                    <p class="col-span-1 mb-2 text-left">Alasan Penolakan</p>
                    <button class="col-span-2 bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-full">
                        <?= esc($reservation['alasan']) ?>
                    </button>
                </div>
            <?php endif; ?>

            <?php if ($reservation['status'] == 'Selesai'): ?>
                <div class="grid grid-cols-3 gap-4 mt-4">
                    <p class="col-span-1 mb-2 text-left">Kehadiran</p>
                    <button class="col-span-2 bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-full">
                        <?= esc($reservation['kehadiran']) ?>
                    </button>
                </div>
                <?php if ($reservation['kehadiran'] == 'Datang'): ?>
                    <div class="grid grid-cols-3 gap-4 mt-4">
                        <p class="col-span-1 mb-2 text-left">Dokumentasi</p>
                        <button class="col-span-2 bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-full">
                            Unduh Dokumentasi <?= esc($reservation['dokumentasi']) ?>
                        </button>
                        <p class="col-span-1 mb-2 text-left">Notula</p>
                        <button class="col-span-2 bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-full">
                            Unduh Notula <?= esc($reservation['notula']) ?>
                        </button>
                    </div>
                    <form action="/consultation/feedback" method="post">
                        <input type="hidden" name="token" value="<?= esc(old('token', $token)) ?>">
                        <div class="grid grid-cols-3 gap-4 mt-4">
                            <button type="submit"
                                class="col-span-3 bg-transparent hover:bg-orange-500 text-orange-700 font-semibold hover:text-white py-2 px-4 border border-orange-500 hover:border-transparent rounded-full">Isi
                                Survei Kepuasan Konsumen</button>
                        </div>
                    </form>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <div class="max-w-lg mx-auto status bg-white p-4 rounded-lg text-center border border-red-300 shadow-md">
            <p class="text-red-500"><?= esc($error) ?></p>
        </div>
    <?php endif; ?>
    <div>
        <br><br><br><br><br><br><br><br><br><br>
    </div>
    <footer class="relative w-full mt-20">
        <!-- Gambar footer2 di atas kontainer bg-oranye-2 -->
        <div class="absolute inset-x-0 top-1 -translate-y-full w-full z-20">
            <img src="/assets/images/footer2.png" alt="footer" class="w-full object-cover">
        </div>
        <!-- Kontainer dengan latar belakang oranye -->
        <div class="relative bg-oranye-2 text-white overflow-hidden pt-20 z-10">
            <!-- Footer Content -->
            <div class="container mx-auto px-6 py-12 flex flex-col md:flex-row justify-between space-y-8 md:space-y-0">
                <!-- Informasi Utama -->
                <div class="md:w-1/3 flex flex-col space-y-4">
                    <div class="flex items-center space-x-4">
                        <div>
                            <img src="/assets/images/logo-pst.png" alt="Logo" class="h-12 w-12">
                        </div>
                        <h3 class="text-lg md:text-xl font-semibold leading-tight"> Badan Pusat Statistik Provinsi DKI
                            Jakarta </h3>
                    </div>
                    <p class="text-sm md:text-base leading-relaxed"> Jl. Salemba Tengah No. 36-38 Paseban Senen Jakarta
                        Pusat <br>
                        <span>Phone: (021) 31928493</span>
                        <br>
                        <span>Fax: (021) 3152004</span>
                        <br>
                        <span>E-mail: bps3100@bps.go.id</span>
                    </p>
                </div>
                <!-- Website Lainnya -->
                <div class="md:w-1/3">
                    <h4 class="text-lg md:text-xl font-semibold mb-4">Website Lainnya:</h4>
                    <ul class="space-y-2 text-sm md:text-base">
                        <li>
                            <a href="https://www.bps.go.id" class="underline hover:text-gray-300">Website BPS
                                Indonesia</a>
                        </li>
                        <li>
                            <a href="https://jakarta.bps.go.id" class="underline hover:text-gray-300">Website BPS
                                Provinsi DKI Jakarta</a>
                        </li>
                        <li>
                            <a href="https://pst.bps.go.id" class="underline hover:text-gray-300">Website Pelayanan
                                Statistik Terpadu</a>
                        </li>
                        <li>
                            <a href="https://silastik.bps.go.id" class="underline hover:text-gray-300">Website
                                SILASTIK</a>
                        </li>
                    </ul>
                </div>
                <!-- Sosial Media -->
                <div class="md:w-1/3">
                    <h4 class="text-lg md:text-xl font-semibold mb-4">Sosial Media:</h4>
                    <ul class="space-y-2 text-sm md:text-base">
                        <li>
                            <a href="https://www.facebook.com/bpsdkijakarta/"
                                class="underline hover:text-gray-300">Facebook</a>
                        </li>
                        <li>
                            <a href="https://x.com/bpsdkijakarta/" class="underline hover:text-gray-300">Twitter</a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/bpsdkijakarta/"
                                class="underline hover:text-gray-300">Instagram</a>
                        </li>
                        <li>
                            <a href="https://www.youtube.com/c/BPSDKI" class="underline hover:text-gray-300">YouTube</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Copyright -->
            <div class="relative text-center text-xs md:text-sm mt-4 pb-4"> &copy; 2024 Badan Pusat Statistik Provinsi
                DKI Jakarta. All rights reserved. </div>
        </div>
    </footer>
</body>

</html>
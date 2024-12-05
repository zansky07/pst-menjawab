<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PST Menjawab | Status Reservasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/form.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>
<body class="bg-orange-100">
    <div class="max-w-lg mx-auto rounded-lg shadow-lg mt-10">
        <form action="/consultation/status" method="post">
            <?= csrf_field() ?> <!-- Tambahkan CSRF protection -->
            <div class="flex items-center mb-4">
                <input 
                    type="text" 
                    id="token" 
                    name="token" 
                    class="bg-white flex-grow p-2 border border-gray-300 rounded-l-md" 
                    placeholder="Masukkan Token Anda" 
                    value="<?= old('token') ? esc(old('token')) : '' ?>" 
                    required>
                <button 
                    type="submit" 
                    class="bg-orange-500 text-white py-2 px-4 rounded-r-md hover:bg-orange-600">
                    Cari
                </button>
            </div>
        </form>
    </div>
        
    <?php if(isset($reservation)): ?>

        <?php if (session()->getFlashdata('error')): ?> 
            <div class="mb-4 p-2 bg-red-100 text-red-700 rounded"> 
                <?= session()->getFlashdata('error') ?> 
            </div> 
        <?php endif; ?>
        
        <div class="max-w-lg mx-auto status bg-white p-4 rounded-lg text-center border border-orange-300 shadow-md">
            <div class="grid grid-cols-3 gap-4">
                <p class="col-span-1 mb-2 text-left">Nomor Token</p>
                <button class="col-span-2 bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-full">
                    <?= esc($token) ?>
                </button>
                <p class="col-span-1 mb-2 text-left">Tanggal Reservasi</p>
                <button class="col-span-2 bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-full">
                    <?= esc($reservation['tanggal_reservasi']) ?>
                </button>
                <p class="col-span-1 mb-2 text-left">Status Reservasi</p>
                <button class="col-span-2 bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-full">
                    <?= esc($reservation['status']) ?>
                </button>
            </div>

            <?php if($reservation['status'] == 'Disetujui'): ?>
                <div class="grid grid-cols-3 gap-4 mt-4">
                    <p class="col-span-1 mb-2 text-left">Link Pertemuan</p>
                    <button class="col-span-2 bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-full">
                        <?= esc($reservation['zoom']) ?>
                    </button>
                    <p class="col-span-1 mb-2 text-left">Waktu Pertemuan</p>
                    <button class="col-span-2 bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-full">
                        <?= esc($reservation['waktu_pertemuan']) ?>
                    </button>
                </div>
            <?php endif; ?>

            <?php if($reservation['status'] == 'Ditolak'): ?>
                <div class="grid grid-cols-3 gap-4 mt-4">
                    <p class="col-span-1 mb-2 text-left">Alasan Penolakan</p>
                    <button class="col-span-2 bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-full">
                        <?= esc($reservation['alasan']) ?>
                    </button>
                </div>
            <?php endif; ?>

            <?php if($reservation['status'] == 'Selesai'): ?>
                <div class="grid grid-cols-3 gap-4 mt-4">
                    <p class="col-span-1 mb-2 text-left">Kehadiran</p>
                    <button class="col-span-2 bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-full">
                        <?= esc($reservation['kehadiran']) ?>
                    </button>
                </div>
                <?php if($reservation['kehadiran'] == 'Datang'): ?>
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
                <?php endif; ?>
                        <form action="/consultation/feedback" method="post">
                            <input type="hidden" name="token" value="<?= esc(old('token', $token)) ?>">
                                <div class="grid grid-cols-3 gap-4 mt-4">
                                    <button type="submit" class="col-span-3 bg-transparent hover:bg-orange-500 text-orange-700 font-semibold hover:text-white py-2 px-4 border border-orange-500 hover:border-transparent rounded-full">Isi Survei Kepuasan Konsumen</button>
                                </div>
                        </form>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <div class="max-w-lg mx-auto status bg-white p-4 rounded-lg text-center border border-red-300 shadow-md">     
            <p class="text-red-500"><?= esc($error) ?></p>
        </div>
    <?php endif; ?>
</body>
</html>

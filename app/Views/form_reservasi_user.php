<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PST Menjawab | Form Reservasi Konsultasi Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/form.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>
<body class="bg-orange-100">
    <div class="w-full max-w-4xl mx-auto bg-white p-6 sm:p-8 rounded-lg shadow-lg mt-10">
        
        <?php if (session()->getFlashdata('error')): ?> 
            <div class="mb-4 p-2 bg-red-100 text-red-700 rounded"> 
                <?= session()->getFlashdata('error') ?> 
            </div> 
        <?php endif; ?>
        
        <form action="/consultation/reserve/submit" method="post">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Nama Konsumen -->
                <div class="mb-4">
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Konsumen</label>
                    <input type="text" id="nama" name="nama" value="<?= old('nama') ?>" placeholder="Masukkan nama lengkap Anda" class="block w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                    <?php if (isset(session()->getFlashdata('validationErrors')['nama'])): ?>
                        <span class="text-red-500 text-sm"><?= session()->getFlashdata('validationErrors')['nama'] ?></span>
                    <?php endif; ?>
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                    <input type="email" id="email" name="email" value="<?= old('email') ?>" placeholder="contoh: nama@email.com" class="block w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                    <?php if (isset(session()->getFlashdata('validationErrors')['email'])): ?>
                        <span class="text-red-500 text-sm"><?= session()->getFlashdata('validationErrors')['email'] ?></span>
                    <?php endif; ?>
                </div>

                <!-- Nomor Whatsapp -->
                <div class="mb-4">
                    <label for="whatsapp" class="block text-sm font-medium text-gray-700 mb-1">Nomor Whatsapp</label>
                    <input type="tel" id="whatsapp" name="whatsapp" value="<?= old('whatsapp') ?>" placeholder="Masukkan nomor Whatsapp Anda" pattern="^08[1-9][0-9]{6,10}$" class="block w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                    <?php if (isset(session()->getFlashdata('validationErrors')['whatsapp'])): ?>
                        <span class="text-red-500 text-sm"><?= session()->getFlashdata('validationErrors')['whatsapp'] ?></span>
                    <?php endif; ?>
                </div>

                <!-- Topik -->
                <div class="mb-4">
                    <label for="topik" class="block text-sm font-medium text-gray-700 mb-1">Topik</label>
                    <input type="text" id="topik" name="topik" value="<?= old('topik') ?>" placeholder="Masukkan topik konsultasi" class="block w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                    <?php if (isset(session()->getFlashdata('validationErrors')['topik'])): ?>
                        <span class="text-red-500 text-sm"><?= session()->getFlashdata('validationErrors')['topik'] ?></span>
                    <?php endif; ?>
                </div>

                <!-- Kategori -->
                <div class="mb-4">
                    <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <select id="kategori" name="kategori" class="block w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                        <option value="" disabled <?= old('kategori') ? '' : 'selected' ?>>Pilih kategori</option>
                        <option value="Statistik Deskriptif" <?= old('kategori') == 'Statistik Deskriptif' ? 'selected' : '' ?>>Statistik Deskriptif</option>
                        <option value="Analisis Data" <?= old('kategori') == 'Analisis Data' ? 'selected' : '' ?>>Analisis Data</option>
                        <option value="Metode Survei" <?= old('kategori') == 'Metode Survei' ? 'selected' : '' ?>>Metode Survei</option>
                    </select>
                    <?php if (isset(session()->getFlashdata('validationErrors')['kategori'])): ?>
                        <span class="text-red-500 text-sm"><?= session()->getFlashdata('validationErrors')['kategori'] ?></span>
                    <?php endif; ?>
                </div>

                <!-- Lingkup -->
                <div class="mb-4">
                    <label for="lingkup" class="block text-sm font-medium text-gray-700 mb-1">Lingkup</label>
                    <input type="text" id="lingkup" name="lingkup" value="<?= old('lingkup') ?>" placeholder="Contoh: Nasional, Regional, dll." class="block w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                    <?php if (isset(session()->getFlashdata('validationErrors')['lingkup'])): ?>
                        <span class="text-red-500 text-sm"><?= session()->getFlashdata('validationErrors')['lingkup'] ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" placeholder="Jelaskan detail konsultasi Anda..." class="block w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none h-28 resize-none" required><?= old('deskripsi') ?></textarea>
                <?php if (isset(session()->getFlashdata('validationErrors')['deskripsi'])): ?>
                    <span class="text-red-500 text-sm"><?= session()->getFlashdata('validationErrors')['deskripsi'] ?></span>
                <?php endif; ?>
            </div>

            <!-- Tombol Submit -->
            <div class="mb-4">
                <button type="submit" class="w-full bg-orange-500 text-white py-2 px-4 rounded-md transition duration-300 hover:bg-orange-600">Kirim</button>
            </div>
        </form>
    </div>
</body>
</html>
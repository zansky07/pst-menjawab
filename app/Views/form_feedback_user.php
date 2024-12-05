<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PST Menjawab | Survei Kepuasan Konsumen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="<?= base_url('assets/css/styles.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/form.css') ?>" rel="stylesheet">
</head>
<body class="bg-orange-100">
    <!-- Judul di luar kotak -->
    <div class="text-center mt-7 mb-7">
        <h2 class="text-3xl font-bold mb-4 text-gray-800">Survei Kepuasan Konsumen PST Menjawab</h2>
    </div>

    <!-- Kotak Formulir -->
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <form action="/consultation/feedback/submit" method="post">
            <?php if (session()->getFlashdata('error')): ?> 
                <div class="mb-4 p-2 bg-red-100 text-red-700 rounded"> 
                    <?= session()->getFlashdata('error') ?> 
                </div> 
            <?php endif; ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Token -->
                <div>
                    <label for="token" class="block text-sm font-medium text-gray-700 mb-1">Token</label>
                    <input type="text" id="token" name="token" value="<?= esc($token) ?>" readonly class="block w-full p-2 border border-gray-300 rounded-md bg-gray-100">
                </div>

                <!-- Kendala -->
                <div class="md:col-span-2">
                    <label for="kendala" class="block text-sm font-medium text-gray-700 mb-1">Apakah Anda mengalami kendala saat memakai layanan kami? Jika ya, apa?</label>
                    <textarea id="kendala" name="kendala" class="block w-full p-2 border border-gray-300 rounded-md h-24"></textarea>
                </div>

                <!-- Konsultasi -->
                <div>
                    <label for="konsultasi" class="block text-sm font-medium text-gray-700 mb-1">Kemungkinan konsultasi lagi (1-10)?</label>
                    <input type="number" id="konsultasi" name="konsultasi" min="1" max="10" required class="block w-full p-2 border border-gray-300 rounded-md">
                </div>

                <!-- Kesulitan -->
                <div>
                    <label for="kesulitan" class="block text-sm font-medium text-gray-700 mb-1">Kesulitan penggunaan website (1-10)?</label>
                    <input type="number" id="kesulitan" name="kesulitan" min="1" max="10" required class="block w-full p-2 border border-gray-300 rounded-md">
                </div>

                <!-- Terjawab -->
                <div>
                    <label for="terjawab" class="block text-sm font-medium text-gray-700 mb-1">Apakah kebutuhan Anda terjawab?</label>
                    <select id="terjawab" name="terjawab" required class="block w-full p-2 border border-gray-300 rounded-md">
                        <option value="Ya">Ya</option>
                        <option value="Tidak">Tidak</option>
                    </select>
                </div>

                <!-- Kepuasan -->
                <div>
                    <label for="kepuasan" class="block text-sm font-medium text-gray-700 mb-1">Kepuasan terhadap layanan (1-10)?</label>
                    <input type="number" id="kepuasan" name="kepuasan" min="1" max="10" required class="block w-full p-2 border border-gray-300 rounded-md">
                </div>

                <!-- Kritik dan Saran -->
                <div class="md:col-span-2">
                    <label for="kritik_saran" class="block text-sm font-medium text-gray-700 mb-1">Kritik dan Saran</label>
                    <textarea id="kritik_saran" name="kritik_saran" class="block w-full p-2 border border-gray-300 rounded-md h-24"></textarea>
                </div>
            </div>

            <!-- Tombol Submit -->
            <div class="mt-6">
                <button type="submit" class="w-full bg-orange-500 text-white py-2 px-4 rounded-md hover:bg-orange-600">Kirim</button>
            </div>
        </form>
    </div>
</body>
</html>

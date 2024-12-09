<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Konsultasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const statusSelect = document.querySelector('select[name="status_konsultasi"]');
            const jadwalkanField = document.getElementById('jadwalkan-field');
            const jadwalField = document.getElementById('jadwal-field');
            const reasonField = document.getElementById('reason-field');
            const notifField = document.getElementById('notif-field');
            const kehadiranField = document.getElementById('kehadiran-field');
            const kehadiranSelect = document.querySelector('select[name="kehadiran_konsumen"]');
            const detailField = document.getElementById('detail-field');

            function toggleFields() {
                if (statusSelect.value === 'Disetujui') {
                    jadwalkanField.classList.remove('hidden');
                    jadwalField.classList.remove('hidden');
                    kehadiranField.classList.add('hidden');
                    kehadiranSelect.value = ''; 
                    reasonField.classList.add('hidden');
                    notifField.classList.add('hidden');
                    detailField.classList.add('hidden');
                } else if (statusSelect.value === 'Ditolak') {
                    reasonField.classList.remove('hidden');
                    notifField.classList.remove('hidden');
                    jadwalkanField.classList.add('hidden');
                    jadwalField.classList.add('hidden');
                    kehadiranField.classList.add('hidden');
                    kehadiranSelect.value = ''; 
                    detailField.classList.add('hidden');
                } else if (statusSelect.value === 'Selesai') {
                    reasonField.classList.add('hidden');
                    notifField.classList.add('hidden');
                    jadwalkanField.classList.add('hidden');
                    jadwalField.classList.add('hidden');
                    kehadiranField.classList.remove('hidden'); 
                    toggleDetailField();
                } else {
                    jadwalkanField.classList.add('hidden');
                    jadwalField.classList.add('hidden');
                    reasonField.classList.add('hidden');
                    notifField.classList.add('hidden');
                    kehadiranField.classList.add('hidden');
                    kehadiranSelect.value = ''; 
                    detailField.classList.add('hidden');
                }
            }

            function toggleDetailField() {
                if (kehadiranSelect.value === 'Datang') {
                    detailField.classList.remove('hidden');
                } else {
                    detailField.classList.add('hidden');
                }
            }

            toggleFields();
            statusSelect.addEventListener('change', toggleFields);
            kehadiranSelect.addEventListener('change', toggleDetailField);
        });
    </script>
</head>

<body class="bg-orange-100">
    <div class="max-w-xl lg:max-w-3xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6">Detail</h1>
        <form action="/admin/consultation/detail/update/<?= $konsultasi['id'] ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <label class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Nama
                    Konsumen</label>
                <input type="text" class="w-full px-3 py-2 bg-orange-100 border border-orange-300 rounded-md"
                    value="<?= esc($konsultasi['nama_konsumen']) ?>" readonly>
            </div>
            <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <label class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Alamat
                    Email</label>
                <input type="email" class="w-full px-3 py-2 border bg-orange-100 border-orange-300 rounded-md"
                    value="<?= esc($konsultasi['email_konsumen']) ?>" readonly>
            </div>
            <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <label
                    class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Topik</label>
                <input type="text" class="w-full px-3 py-2 bg-orange-100 border border-orange-300 rounded-md"
                    value="<?= esc($konsultasi['topik']) ?>" readonly>
            </div>
            <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <label
                    class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Kategori</label>
                <input type="text" class="w-full px-3 py-2 bg-orange-100 border border-orange-300 rounded-md"
                    value="<?= esc($konsultasi['kategori']) ?>" readonly>
            </div>
            <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <label
                    class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Lingkup</label>
                <input type="text" class="w-full px-3 py-2 bg-orange-100 border border-orange-300 rounded-md"
                    value="<?= esc($konsultasi['lingkup']) ?>" readonly>
            </div>
            <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <label
                    class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Deskripsi</label>
                <textarea class="w-full px-3 py-2 bg-orange-100 border border-orange-300 rounded-md"
                    readonly><?= esc($konsultasi['deskripsi']) ?></textarea>
            </div>
            <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
<<<<<<< HEAD
                <label class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Status</label>
                <select name="status_konsultasi" class="w-full px-3 py-2 bg-orange-500 text-white border border-orange-300 rounded-md">
                    <?php $status_konsultasies = ['Sedang diproses','Disetujui', 'Ditolak', 'Selesai']; 
                    foreach ($status_konsultasies as $status_konsultasi) { 
                        $selected = ($status_konsultasi == $konsultasi['status_konsultasi']) ? 'selected' : ''; echo "<option value=\"$status_konsultasi\" $selected>$status_konsultasi</option>"; } ?>
                </select>
            </div>
            <!-- IF DISETUJUI SELECTED-->
            <div id="jadwalkan-field" class="mb-4 hidden grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center"></label>
                        <div class="flex space-x-4 md:space-x-2 w-full md:col-span-1">
                            <a href="/admin/consultation/schedule/<?= $konsultasi['id'] ?>" name="jadwal_btn" class="bg-orange-500 text-white py-3 px-2 rounded-md w-full text-center mx-1 text-sm transition duration-300 hover:bg-orange-600">Jadwalkan Konsultasi</a>
                        </div>
            </div>
                <?php
                $jadwal_konsultasi = isset($konsultasi['jadwal_konsultasi']) ? $konsultasi['jadwal_konsultasi'] : null;
                if ($jadwal_konsultasi) {
                    $datetime = new DateTime($jadwal_konsultasi);
                    $formatted_jadwal = $datetime->format('Y-m-d H:i');
                } else {
                    $formatted_jadwal = '';
                }
                ?>
            <div id="jadwal-field" class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <label class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Jadwal Konsultasi</label>
                <div class="flex items-center w-full">
                    <input type="text" class="flex-grow px-3 py-2 bg-orange-100 border border-orange-300 rounded-md" value="<?= esc($formatted_jadwal) ?>" readonly>
                    <a href="/admin/consultation/schedule/delete/<?= $konsultasi['id'] ?>" class="ml-2 bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600">Hapus</a>
                </div>
            </div>
            <!-- IF DITOLAK SELECTED -->
            <div id="reason-field" class="mb-4 hidden grid grid-cols-1 md:grid-cols-2 gap-4">
                <label class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Alasan Penolakan</label>
                <textarea name="alasan_penolakan" class="w-full px-3 py-2 bg-orange-100 border border-orange-300 rounded-md"></textarea>
            </div>
            <div id="notif-field" class="mb-4 hidden grid grid-cols-1 md:grid-cols-2 gap-4">
                <label class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Kirim Notifikasi</label>
                <div class="flex space-x-4 md:space-x-2 w-full md:col-span-1">
                    <button name="notif_wa" class="w-full md:w-auto bg-orange-500 text-white py-2 px-5 rounded-md hover:bg-orange-600">VIA WHATSAPP</button>
                    <button name="notif_email" class="w-full md:w-auto bg-orange-500 text-white py-2 px-5 rounded-md hover:bg-orange-600">VIA EMAIL</button>
                </div>
            </div>
            <!-- IF SELESAI SELECTED -->
            <div id="kehadiran-field" class="mb-4 hidden grid grid-cols-1 md:grid-cols-2 gap-4">
                <label class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Kehadiran Konsumen</label>
                <select name="kehadiran_konsumen" class="w-full px-3 py-2 bg-orange-500 text-white border border-orange-300 rounded-md">
                    <option value="" <?= !isset($konsultasi['kehadiran']) ? 'selected' : '' ?>>Pilih Kehadiran</option>
                    <?php $kehadiran_konsumens = ['Datang', 'Tidak datang']; 
                    foreach ($kehadiran_konsumens as $kehadiran_konsumen) { 
                        $selected = (isset($konsultasi['kehadiran']) && $kehadiran_konsumen == $konsultasi['kehadiran']) ? 'selected' : ''; 
                        echo "<option value=\"$kehadiran_konsumen\" $selected>$kehadiran_konsumen</option>"; 
                    } ?>
                </select>
            </div>
                    <!-- IF KEHADIRAN = DATANG -->
                    <div id="detail-field" class="mb-4 hidden grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center"></label>
                        <div class="flex space-x-4 md:space-x-2 w-full md:col-span-1">
                            <a href="" name="detail_btn" class="bg-orange-500 text-white py-3 px-2 rounded-md w-full text-center mx-1 text-sm transition duration-300 hover:bg-orange-600">Isi Detail Konsultasi</a>
                        </div>
                    </div>
            <br>
            <div class="flex justify-end space-x-4">
                <a href="/admin/dashboard" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600">Kembali</a>
                <button type="submit" class="bg-orange-500 text-white py-2 px-4 rounded-md hover:bg-orange-600">Simpan Status</button>
            </div>
        </form>
    </div>
</body>
</html>
=======
                <label
                    class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Status</label>
                <select name="status_konsultasi"
                    class="w-full px-3 py-2 bg-orange-500 text-white border border-orange-300 rounded-md">
                    <?php $status_konsultasies = ['Pending', 'Disetujui', 'Ditolak', 'Selesai'];
                    foreach ($status_konsultasies as $status_konsultasi) {
                        $selected = ($status_konsultasi == $konsultasi['status_konsultasi']) ? 'selected' : '';
                        echo "<option value=\"$status_konsultasi\" $selected>$status_konsultasi</option>";
                    } ?>
                </select>
            </div>
            <button type="submit"
                class="w-full bg-orange-500 text-white py-2 rounded-md hover:bg-orange-600">Simpan</button>
            <?php if ($konsultasi['status_konsultasi'] === 'Disetujui'): ?>
                <a href="/admin/consultation/schedule/<?= $konsultasi['id'] ?>" class="schedule-button">Jadwalkan
                    Konsultasi</a>
            <?php endif; ?>
            <a href="/admin/dashboard" class="block text-center mt-4 text-red-500">Kembali</a>
        </form>
    </div>
</body>

</html>
>>>>>>> 8ce1aa059af6b6ab7e890f191ef18fb8ac98d18b

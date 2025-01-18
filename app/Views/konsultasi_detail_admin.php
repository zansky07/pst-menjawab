<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Konsultasi</title>
    <link rel="icon" href="/assets/images/logo-pst.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusSelect = document.querySelector('select[name="status_konsultasi"]');
            const jadwalkanField = document.getElementById('jadwalkan-field');
            const jadwalField = document.getElementById('jadwal-field');
            const jadwalFieldInput = document.getElementById('jadwal-field-input');
            const reasonField = document.getElementById('reason-field');
            const notifKonsul = document.getElementById('notif-konsul'); // Assuming 'notif-konsul' is the correct ID
            const kehadiranField = document.getElementById('kehadiran-field');
            const kehadiranSelect = document.querySelector('select[name="kehadiran_konsumen"]');
            const detailField = document.getElementById('detail-field');
            const kembali = document.getElementById('kembali');

            function toggleFields() {
                if (statusSelect.value === 'Disetujui') {
                    jadwalkanField.classList.remove('hidden');
                    jadwalField.classList.remove('hidden');
                    kehadiranField.classList.add('hidden');
                    kehadiranSelect.value = '';
                    reasonField.classList.add('hidden');
                    detailField.classList.add('hidden');
                    toggleNotifKonsul();
                } else if (statusSelect.value === 'Ditolak') {
                    reasonField.classList.remove('hidden');
                    jadwalkanField.classList.add('hidden');
                    jadwalField.classList.add('hidden');
                    kehadiranField.classList.add('hidden');
                    kehadiranSelect.value = '';
                    detailField.classList.add('hidden');
                    toggleNotifKonsul();
                } else if (statusSelect.value === 'Selesai') {
                    reasonField.classList.add('hidden');
                    jadwalkanField.classList.add('hidden');
                    jadwalField.classList.add('hidden');
                    kehadiranField.classList.remove('hidden');
                    toggleNotifKonsul();
                    toggleDetailField();
                } else {
                    jadwalkanField.classList.add('hidden');
                    jadwalField.classList.add('hidden');
                    reasonField.classList.add('hidden');
                    kehadiranField.classList.add('hidden');
                    kehadiranSelect.value = '';
                    detailField.classList.add('hidden');
                    toggleNotifKonsul();
                }
            }

            function toggleNotifKonsul() {
                if (statusSelect.value === 'Disetujui' && jadwalFieldInput.value.trim() !== '') {
                    notifKonsul.classList.remove('hidden');
                    kembali.classList.add('hidden');
                } else {
                    notifKonsul.classList.add('hidden');
                    kembali.classList.remove('hidden');
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
            statusSelect.addEventListener('change', function() {
                toggleFields();
                toggleNotifKonsul(); // Check notif-konsul when status changes
            });
            jadwalFieldInput.addEventListener('input', toggleNotifKonsul); // Check notif-konsul when jadwal-field input changes
            kehadiranSelect.addEventListener('change', toggleDetailField);
        });
    </script>
</head>

<body class="bg-oranye-1 mt-28 md:mt-16">
    <?php include 'header_admin.php'; ?>

    <main>
        <!-- Form -->
        <div class="max-w-xl lg:max-w-3xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md" style="margin-top: 100px;">
            <h1 class="text-2xl font-bold mb-6">Detail</h1>
            <form action="<?= base_url('/admin/consultation/detail/update/' . $konsultasi['id']) ?>" method="POST">
                <?= csrf_field() ?>
                <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <label class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Nama
                        Konsumen</label>
                    <input type="text" class="w-full px-3 py-2 bg-oranye-1 border border-orange-300 rounded-md"
                        value="<?= esc($konsultasi['nama_konsumen']) ?>" readonly>
                </div>
                <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <label class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Alamat
                        Email</label>
                    <input type="email" class="w-full px-3 py-2 border bg-oranye-1 border-orange-300 rounded-md"
                        value="<?= esc($konsultasi['email_konsumen']) ?>" readonly>
                </div>
                <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <label
                        class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Topik</label>
                    <input type="text" class="w-full px-3 py-2 bg-oranye-1 border border-orange-300 rounded-md"
                        value="<?= esc($konsultasi['topik']) ?>" readonly>
                </div>
                <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <label
                        class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Kategori</label>
                    <input type="text" class="w-full px-3 py-2 bg-oranye-1 border border-orange-300 rounded-md"
                        value="<?= esc($konsultasi['kategori']) ?>" readonly>
                </div>
                <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <label
                        class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Lingkup</label>
                    <input type="text" class="w-full px-3 py-2 bg-oranye-1 border border-orange-300 rounded-md"
                        value="<?= esc($konsultasi['lingkup']) ?>" readonly>
                </div>
                <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <label
                        class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Deskripsi</label>
                    <textarea class="w-full px-3 py-2 bg-oranye-1 border border-orange-300 rounded-md"
                        readonly><?= esc($konsultasi['deskripsi']) ?></textarea>
                </div>
                <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <label class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Status</label>
                    <select name="status_konsultasi" class="outline-none dropdown-white-text w-full px-3 py-2 bg-orange-500 text-white border border-orange-300 rounded-md "
                        <?= in_array($konsultasi['status_konsultasi'], ['Ditolak', 'Selesai']) ? 'readonly' : '' ?> required>
                        <?php
                        $status_konsultasies = ['Sedang diproses', 'Disetujui', 'Ditolak', 'Selesai'];
                        foreach ($status_konsultasies as $status_konsultasi) {
                            // Set value="" jika status dari database sama dengan opsi saat ini
                            $value = ($konsultasi['status_konsultasi'] == 'Sedang diproses' && $status_konsultasi == 'Sedang diproses') ? '' : $status_konsultasi;
                            $selected = ($status_konsultasi == $konsultasi['status_konsultasi']) ? 'selected' : '';
                            $disabled = '';
                            // Logic for disabling options
                            if ($konsultasi['status_konsultasi'] == 'Sedang diproses' && $status_konsultasi == 'Sedang diproses') {
                                $disabled = 'disabled';
                            } elseif ($konsultasi['status_konsultasi'] == 'Disetujui' && in_array($status_konsultasi, ['Sedang diproses', 'Ditolak'])) {
                                $disabled = 'disabled';
                            } elseif (in_array($konsultasi['status_konsultasi'], ['Ditolak', 'Selesai'])) {
                                $disabled = 'disabled';
                            }
                            echo "<option value=\"$value\" $selected $disabled>$status_konsultasi</option>";
                        }
                        ?>
                    </select>
                </div>
                <!-- IF DISETUJUI SELECTED-->
                <div class="container grid grid-cols-1 md:grid-cols-4 gap-4 justify-start">
                    <div class="col-span-1"></div>
                    <div class="col-span-1"></div>
                    <div id="jadwalkan-field" class="mb-4 col-span-1">
                        <div class="flex space-x-4 md:space-x-2 w-full">
                            <a href="/admin/consultation/schedule/<?= $konsultasi['id'] ?>" name="jadwal_btn" class="w-full bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded ">Jadwalkan</a>
                        </div>
                    </div>
                    <div id="notif-konsul" class="mb-4 col-span-1">
                        <div class="flex space-x-4 md:space-x-2 w-full">
                            <a href="/admin/consultation/notification/<?= $konsultasi['id'] ?>" name="notif" class="w-full bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded ">Kirim Notifikasi</a>
                        </div>
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
                        <input type="text" id="jadwal-field-input" class="flex-grow px-3 py-2 bg-oranye-500 border border-orange-300 rounded-md" value="<?= esc($formatted_jadwal) ?>" readonly>
                        <a href="/admin/consultation/schedule/delete/<?= $konsultasi['id'] ?>" class="ml-2 bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600" onclick="return confirmDelete()">Hapus</a>
                        <script>
                            function confirmDelete() {
                                return confirm('Apakah Anda yakin ingin menghapus jadwal konsultasi ini?');
                            }
                        </script>
                    </div>
                </div>

                <!-- IF DITOLAK SELECTED -->
                <div id="reason-field" class="mb-4 hidden grid grid-cols-1 md:grid-cols-2 gap-4">
                    <label class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Alasan Penolakan</label>
                    <textarea name="alasan_penolakan" class="w-full px-3 py-2 bg-orange-100 border border-orange-300 rounded-md"><?= esc($konsultasi['alasan_penolakan']) ?></textarea>
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
                        <a href="/admin/consultation/postConsultation/<?= $konsultasi['id'] ?>" name="detail_btn" class="bg-orange-500 text-white py-3 px-2 rounded-md w-full text-center mx-1 text-sm transition duration-300 hover:bg-orange-600">Isi Detail Konsultasi</a>
                    </div>
                </div>
                <br>
                <div class="flex justify-end space-x-4">
                    <a href="/admin/dashboard" id="kembali" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600">Kembali</a>
                    <button id="submitButton" type="submit" class="bg-orange-500 text-white py-2 px-4 rounded-md hover:bg-orange-600">Simpan Status</button>
                    <script>
                        document.getElementById('submitButton').addEventListener('click', function(event) {
                            const confirmation = confirm('Apakah Anda yakin ingin menyimpan perubahan?');
                            if (!confirmation) {
                                event.preventDefault(); // Prevent form submission if not confirmed
                            }
                        });
                    </script>
                    <a href="<?= base_url('export-pdf/' . $konsultasi['id']) ?>" class="bg-orange-500 text-white py-2 px-4 rounded-md hover:bg-orange-600">EKSPOR PDF</a>

                </div>
            </form>
        </div>
    </main>

    <?php include 'footer.php'; ?>

    <script>
        document.getElementById('filterBtn').addEventListener('click', function() {
            document.getElementById('filterModal').classList.remove('hidden');
        });
        document.getElementById('closeModalBtn').addEventListener('click', function() {
            document.getElementById('filterModal').classList.add('hidden');
        });
    </script>
</body>

</html>
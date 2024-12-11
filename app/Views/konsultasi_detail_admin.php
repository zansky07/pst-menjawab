<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Konsultasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
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

<body class="bg-oranye-1 mt-28 md:mt-16">
<nav class="bg-white shadow shadow-gray-300 fixed top-0 left-0 w-full px-8 z-50">
			<div class="md:h-16 h-28 mx-auto md:px-4 container flex items-center justify-between flex-wrap md:flex-nowrap">
				<div class="flex items-center space-x-4">
					<img src="/assets/images/logo-pst.png" alt="Logo" class="h-10 w-10">
					<span class="text-gray-800 font-semibold text-sm md:text-base"> PST Menjawab BPS Provinsi DKI Jakarta </span>
				</div>
				<div class="text-oranye-4 order-3 w-full md:w-auto md:order-2">
					<ul class="flex font-semibold items-center justify-between space-x-4">
						<li class="hover:text-oranye-2">
							<a href="/admin/dashboard">Dashboard</a>
						</li>
						<li class="hover:text-oranye-2">
							<a href="/admin/statistics">Statistik</a>
						</li>
						<li class="relative">
							<button id="dropdownNavbarLink" class="text-hover:bg-oranye-4 md:hover:bg-transparent py-2 md:hover:text-oranye-2 flex items-center"> Pengaturan <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
									<path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
								</svg>
							</button>
							<div id="dropdownNavbar" class="hidden absolute bg-white text-base z-10 list-none divide-y divide-gray-100 rounded shadow mt-2 w-44">
								<ul class="py-1">
									<li>
										<a href="/admin/settings/admin" class="text-sm hover:bg-gray-100 text-gray-700 block px-4 py-2">Admin</a>
									</li>
									<li>
										<a href="a/dmin/settings/consultant" class="text-sm hover:bg-gray-100 text-gray-700 block px-4 py-2">Konsultan</a>
									</li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
				<div class="order-2 md:order-3">
					<button class="px-4 py-2 bg-oranye-3 hover:bg-oranye-4 text-white rounded-xl flex items-center gap-2">
						<span>
							<a href="/admin/logout">Keluar</a>
						</span>
					</button>
				</div>
			</div>
		</nav>
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
    <div class="relative" id="footer">
			<img src="/assets/images/footer.png" alt="footer" class="w-full">
			<div class="absolute inset-0 flex flex-col items-center justify-end text-white text-center px-5 text-lg pb-12">
				<div class="flex justify-between items-center w-full max-w-6xl mb-8 space-x-8">> <div class="w-1/3 text-left">
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
</body>
</html>

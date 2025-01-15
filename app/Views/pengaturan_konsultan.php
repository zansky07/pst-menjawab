<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Daftar Admin dan Konsultan</title>
	<link rel="icon" href="/assets/images/logo-pst.png">
	<script src="https://cdn.tailwindcss.com"></script>
	<link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">`
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
	<style>
		body {
			font-family: 'Poppins', sans-serif;
		}
	</style>
</head>

<body class="bg-oranye-1 min-h-screen flex flex-col mt-28 md:mt-16">
<<<<<<< HEAD

	<?php include 'header_admin.php';?>

    <!-- Main Content -->
    <main class="flex-1 container mx-auto px-4 py-6">
        <div class="flex flex-wrap justify-between items-center mb-4">
            <h1 class="text-xl md:text-2xl font-bold text-gray-700">Daftar Konsultan</h1>
            <a href="/admin/consultant/add" 
                class="bg-orange-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-orange-600 transition duration-200 text-sm md:text-base">
                Tambah Konsultan
            </a>
        </div>

        <!-- Table -->
        <div class="bg-white shadow-md rounded-lg overflow-x-auto p-4">
            <table class="min-w-full" id="myTable" style="margin-top: 4px;">
                <thead class="bg-orange-600 text-center">
                    <tr class="text-white text-sm md:text-base">
                        <th class="py-3 px-4">Nama</th>
                        <th class="py-3 px-4" style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-left">
                    <?php if (!empty($konsultans) && is_array($konsultans)): ?>
                        <?php foreach ($konsultans as $konsultan): ?>
                            <tr class="odd:bg-white even:bg-biru-3 hover:bg-oranye-1 p-10">
                                <td class="py-3 px-4 text-sm md:text-base"><?= esc($konsultan['nama']) ?></td>
                                <td class="py-3 px-4 text-center" style="padding: 10px;">
                                    <a href="/admin/consultant/detail/<?= $konsultan['id'] ?>" 
                                        class="bg-green-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-green-600 transition duration-200 text-sm md:text-base">
                                        Detail
                                    </a>
                                    <a onclick="confirmDelete('/admin/consultant/delete/<?= $konsultan['id'] ?>')" 
                                        class="bg-red-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-red-600 transition duration-200 ml-2 text-sm md:text-base">
                                        Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2" class="py-3 px-4 text-center text-sm md:text-base">Tidak ada data.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

	<?php include 'footer.php';?>

    <script>
=======
	<!-- Header -->
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
									<a href="/admin/settings/consultant" class="text-sm hover:bg-gray-100 text-gray-700 block px-4 py-2">Konsultan</a>
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

	<!-- Main Content -->
	<main class="flex-1 container mx-auto px-4 py-6">
		<div class="flex flex-wrap justify-between items-center mb-4">
			<h1 class="text-xl md:text-2xl font-bold text-gray-700">Daftar Konsultan</h1>
			<a href="/admin/consultant/add"
				class="bg-orange-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-orange-600 transition duration-200 text-sm md:text-base">
				Tambah Konsultan
			</a>
		</div>

		<!-- Table -->
		<div class="bg-white shadow-md rounded-lg overflow-x-auto p-4">
			<table class="min-w-full" id="myTable" style="margin-top: 4px;">
				<thead class="bg-orange-600 text-center">
					<tr class="text-white text-sm md:text-base">
						<th class="py-3 px-4">Nama</th>
						<th class="py-3 px-4" style="text-align: center;">Aksi</th>
					</tr>
				</thead>
				<tbody class="text-left">
					<?php if (!empty($konsultans) && is_array($konsultans)): ?>
						<?php foreach ($konsultans as $konsultan): ?>
							<tr class="odd:bg-white even:bg-biru-3 hover:bg-oranye-1 p-10">
								<td class="py-3 px-4 text-sm md:text-base"><?= esc($konsultan['nama']) ?></td>
								<td class="py-3 px-4 text-center" style="padding: 10px;">
									<a href="/admin/consultant/detail/<?= $konsultan['id'] ?>"
										class="bg-green-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-green-600 transition duration-200 text-sm md:text-base">
										Detail
									</a>
									<a onclick="confirmDelete('/admin/consultant/delete/<?= $konsultan['id'] ?>')"
										class="bg-red-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-red-600 transition duration-200 ml-2 text-sm md:text-base">
										Hapus
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan="2" class="py-3 px-4 text-center text-sm md:text-base">Tidak ada data.</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</main>

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
						<h3 class="text-lg md:text-xl font-semibold leading-tight"> Badan Pusat Statistik Provinsi DKI Jakarta </h3>
					</div>
					<p class="text-sm md:text-base leading-relaxed"> Jl. Salemba Tengah No. 36-38 Paseban Senen Jakarta Pusat <br>
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
							<a href="https://www.bps.go.id" class="underline hover:text-gray-300">Website BPS Indonesia</a>
						</li>
						<li>
							<a href="https://jakarta.bps.go.id" class="underline hover:text-gray-300">Website BPS Provinsi DKI Jakarta</a>
						</li>
						<li>
							<a href="https://pst.bps.go.id" class="underline hover:text-gray-300">Website Pelayanan Statistik Terpadu</a>
						</li>
						<li>
							<a href="https://silastik.bps.go.id" class="underline hover:text-gray-300">Website SILASTIK</a>
						</li>
					</ul>
				</div>
				<!-- Sosial Media -->
				<div class="md:w-1/3">
					<h4 class="text-lg md:text-xl font-semibold mb-4">Sosial Media:</h4>
					<ul class="space-y-2 text-sm md:text-base">
						<li>
							<a href="https://www.facebook.com/bpsdkijakarta/" class="underline hover:text-gray-300">Facebook</a>
						</li>
						<li>
							<a href="https://x.com/bpsdkijakarta/" class="underline hover:text-gray-300">Twitter</a>
						</li>
						<li>
							<a href="https://www.instagram.com/bpsdkijakarta/" class="underline hover:text-gray-300">Instagram</a>
						</li>
						<li>
							<a href="https://www.youtube.com/c/BPSDKI" class="underline hover:text-gray-300">YouTube</a>
						</li>
					</ul>
				</div>
			</div>
			<!-- Copyright -->
			<div class="relative text-center text-xs md:text-sm mt-4 pb-4"> &copy; 2024 Badan Pusat Statistik Provinsi DKI Jakarta. All rights reserved. </div>
		</div>
	</footer>
	<script>
>>>>>>> f299df78e428aa8e57dfd4b9c9aeb65099211ed2
		$(document).ready(function() {
			$('#myTable').DataTable({
				responsive: true,
				scrollX: true,
				language: {
					url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Indonesian.json"
				}
			});
		});
		document.getElementById('dropdownNavbarLink').addEventListener('click', function() {
			const dropdown = document.getElementById('dropdownNavbar');
			dropdown.classList.toggle('hidden');
		});

		// Fungsi untuk konfirmasi penghapusan
		function confirmDelete(url) {
			Swal.fire({
				title: 'Apakah Anda yakin?',
				text: "Data yang dihapus tidak dapat dikembalikan!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#d33',
				cancelButtonColor: '#3085d6',
				confirmButtonText: 'Ya, hapus!',
				cancelButtonText: 'Batal'
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = url;
				}
			});
		}

		<?php if (session()->getFlashdata('delete_status')): ?>
			const status = "<?= session()->getFlashdata('delete_status') ?>"; // 'success' atau 'error'
			const message = "<?= session()->getFlashdata('message') ?>"; // Pesan flashdata

			// Tampilkan notifikasi dengan SweetAlert
			Swal.fire({
				icon: status, // success atau error
				title: status === 'success' ? 'Berhasil' : 'Gagal',
				text: message,
				showConfirmButton: true,
				confirmButtonColor: '#3085d6',
				confirmButtonText: 'OK'
			});
		<?php endif; ?>
	</script>
</body>

</html>
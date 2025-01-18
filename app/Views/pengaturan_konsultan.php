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

	<?php include 'header_admin.php'; ?>

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
						<th class="py-3 px-4" style="text-align: center;">Nama</th>
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
										class="bg-green-500 text-white py-1 px-10 rounded-full w-full text-center mx-1 text-sm transition duration-300 hover:bg-green-600">
										Detail
									</a>
									<a onclick="confirmDelete('/admin/consultant/delete/<?= $konsultan['id'] ?>')"
										class="bg-red-500 text-white py-1 px-10 rounded-full w-full text-center mx-1 text-sm transition duration-300 hover:bg-red-600">
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

	<?php include 'footer.php'; ?>

	<script>
		$(document).ready(function() {
			$('#myTable').DataTable({
				responsive: true,
				scrollX: true,
				language: {
					url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Indonesian.json"
				}
			});
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
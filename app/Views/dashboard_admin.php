<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>PST Menjawab | Dashboard</title>
		<script src="https://cdn.tailwindcss.com"></script>
		<link rel="icon" href="/assets/images/logo-pst.png">
		<link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<style>
			body {
				font-family: Arial, sans-serif;
				background-color: #f9f2f1;
			}
		</style>
	</head>
	
	<body class="bg-oranye-1 mt-28 md:mt-16">
		
		<?php include 'header_admin.php';?>

		<main class="flex-grow mb-24">
			<div class="container mx-auto p-6"> <?php if (session()->getFlashdata('message')): ?> <p class="text-green-500"> <?= session()->getFlashdata('message') ?> </p> <?php endif; ?>
				<!-- Filter Button -->
				<div class="flex justify-end mb-4">
					<button id="filterBtn" class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded-full">Filter</button>
				</div>
				<!-- Filter Modal -->
				<div id="filterModal" class="fixed inset-0 hidden bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
					<div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
						<h2 class="text-2xl font-bold mb-4">Filter</h2>
						<form action="/admin/dashboard/filter" method="post" id="filterForm">
							<div class="mb-4">
								<label for="status" class="block text-sm font-medium text-gray-700">Status</label>
								<select id="status" name="status" class="block w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none">
									<option value="">All</option>
									<option value="Sedang diproses">Sedang diproses</option>
									<option value="Disetujui">Disetujui</option>
									<option value="Ditolak">Ditolak</option>
									<option value="Selesai">Selesai</option>
								</select>
							</div>
							<div class="flex justify-end">
								<button type="button" id="closeModalBtn" class="bg-gray-500 text-white py-2 px-4 rounded-full transition duration-300 hover:bg-gray-600 mr-2">Close</button>
								<button type="submit" class="bg-orange-500 text-white py-2 px-4 rounded-full transition duration-300 hover:bg-orange-600">Apply</button>
							</div>
						</form>
					</div>
				</div>
				<div class="bg-white shadow-md rounded-lg overflow-hidden">
					<div class="table-container">
						<table class="min-w-full bg-white">
							<thead class="bg-orange-600 text-white">
								<tr>
									<th class="py-3 px-5 text-lg">Token</th>
									<th class="py-3 px-5 text-lg">Topik</th>
									<th class="py-3 px-5 text-lg">Status</th>
									<th class="py-3 px-5 text-lg">Aksi</th>
								</tr>
							</thead>
							<tbody> <?php if (!empty($requests) && is_array($requests)): ?> <?php foreach ($requests as $request): ?> <tr class="border-b">
									<td class="py-2 px-4"> <?= esc($request['token_konsultasi']) ?> </td>
									<td class="py-2 px-4"> <?= esc($request['topik']) ?> </td>
									<td class="py-2 px-4"> <?= esc($request['status_konsultasi']) ?> </td>
									<td class="py-2 px-4">
										<div class="flex justify-around">
											<a href="/admin/consultation/detail/
																<?= $request['id'] ?>" class="bg-green-500 text-white py-1 px-2 rounded-full w-full text-center mx-1 text-sm transition duration-300 hover:bg-green-600">Detail </a>
											<a onclick="confirmDelete('/admin/consultation/delete/<?= $request['id'] ?>')"  
																class="bg-red-500 text-white py-1 px-2 rounded-full w-full text-center mx-1 text-sm transition duration-300 hover:bg-red-600" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus </a>
										</div>
									</td>
								</tr> <?php endforeach; ?> <?php else: ?> <tr>
									<td colspan="4" class="py-2 px-4">Tidak ada data.</td>
								</tr> <?php endif; ?> </tbody>
						</table>
					</div>
					<!-- Pagination -->
					<div class="p-4 bg-white border-t flex justify-center items-center">
						<div class="flex justify-center items-center space-x-2"> <?php if ($pager): ?> <?= $pager->links('default', 'tailwind_full') ?> <?php endif; ?> </div>
					</div>
				</div>
			</div>
		</main>

		<?php include 'footer.php';?>

		<script>
			document.getElementById('filterBtn').addEventListener('click', function() {
				document.getElementById('filterModal').classList.remove('hidden');
			});
			document.getElementById('closeModalBtn').addEventListener('click', function() {
				document.getElementById('filterModal').classList.add('hidden');
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
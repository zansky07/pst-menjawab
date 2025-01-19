<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Statistik Admin</title>
	<link rel="icon" href="/assets/images/logo-pst.png">
	<script src="https://cdn.tailwindcss.com"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
	<style>
		body {
			font-family: 'Poppins', sans-serif;
		}
	</style>
	<link rel="stylesheet" href="
					
					<?= base_url('assets/css/styles.css') ?>">`
</head>

<body class="flex flex-col bg-oranye-1 mt-28 md:mt-16">
	<?php include 'header_admin.php'; ?>
	<div class="flex-grow z-10 flex-col px-10 w-full max-md:px-5 max-md:max-w-full">
		<button id="openModalButton" class="self-start px-6 py-2.5 mt-5 ml-14 text-base font-bold text-center text-white bg-orange-500 rounded-xl hover:bg-oranye-4 focus:outline-none focus:ring-2 focus:ring-orange-500 max-md:px-5 max-md:ml-2.5" aria-label="Filter"> Filter </button>
		<form action="<?= base_url('/admin/statistics') ?>" method="get">
			<div id="filterModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 hidden justify-center items-center z-50">
				<div class="bg-white p-6 rounded-lg w-96 transform translate-x-[-50%] translate-y-[-50%] absolute top-1/2 left-1/2">
					<h3 class="text-2xl font-bold mb-4">Filter Berdasarkan</h3>
					<!-- Filter Status -->
					<div class="mb-4">
						<label for="status" class="block text-sm font-semibold mb-2">Status:</label>
						<select id="status" name="status" class="w-full px-4 py-2 border border-gray-300 rounded-md">
							<option value="selesai" <?= $status === 'selesai' ? 'selected' : '' ?>>Selesai </option>
							<option value="disetujui" <?= $status === 'disetujui' ? 'selected' : '' ?>>Disetujui </option>
							<option value="ditolak" <?= $status === 'ditolak' ? 'selected' : '' ?>>Ditolak </option>
							<option value="sedang diproses" <?= $status === 'sedang diproses' ? 'selected' : '' ?>>Sedang Diproses </option>
							<option value="semua" <?= $status === 'semua' ? 'selected' : '' ?>>Semua </option>
						</select>
						<label for="periode" class="block text-sm font-semibold mb-2">Tampilkan Berdasarkan:</label>
						<select id="periode" name="periode" class="w-full px-4 py-2 border border-gray-300 rounded-md">
							<option value="semua" <?= $periode === 'semua' ? 'selected' : '' ?>>Semua </option>
							<option value="1bulan" <?= $periode === '1bulan' ? 'selected' : '' ?>>1 Bulan </option>
							<option value="3bulan" <?= $periode === '3bulan' ? 'selected' : '' ?>>3 Bulan </option>
							<option value="6bulan" <?= $periode === '6bulan' ? 'selected' : '' ?>>6 Bulan </option>
							<option value="12bulan" <?= $periode === '12bulan' ? 'selected' : '' ?>>12 Bulan </option>
						</select>
					</div>
					<div class="flex justify-between mt-4">
						<button type="button" id="closeModalButton" class="px-6 py-2 text-white bg-merah-1 rounded-md hover:bg-merah-2">Tutup</button>
						<button type="submit" id="applyFilterButton" class="px-6 py-2 text-white bg-hijau-1 rounded-md hover:bg-hijau-2">Terapkan</button>
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

			<div class="self-end mt-5 w-full max-w-[1315px] max-md:max-w-full">
				<div class="flex gap-5 max-md:flex-col">
					<section class="flex flex-col w-6/12 bg-white rounded-xl shadow-lg max-md:ml-0 max-md:w-full" aria-labelledby="statistics-title">
						<h2 class="px-4 py-2 text-orange-500 font-bold">Grafik Jumlah Konsultasi</h2>
						<hr>
						<canvas id="statistikChart" width="400" height="330" class="rounded-xl"></canvas>
					</section>
					<section class="flex flex-col ml-5 w-6/12 max-md:ml-0 max-md:w-full" aria-label="Statistik Summary">
						<div class="flex flex-col w-full max-md:mt-7 max-md:max-w-full">
							<div class="max-md:max-w-full">
								<div class="flex gap-5 max-md:flex-col">
									<div class="flex flex-col w-6/12 max-md:ml-0 max-md:w-full">
										<div class="flex flex-col px-9 pt-6 pb-11 w-full font-bold text-center text-white bg-oranye-2 rounded-[40px] max-md:px-5 max-md:mt-3">
											<h3 class="text-2xl">Jumlah Pengunjung <br>Hari Ini</h3>
											<div class="self-center mt-11 text-6xl max-md:mt-10 max-md:text-4xl" aria-label="<?= $jumlahPengunjungHarian ?> pengunjung"><?= $jumlahPengunjungHarian ?></div>
										</div>
									</div>
									<div class="flex flex-col ml-5 w-6/12 max-md:ml-0 max-md:w-full">
										<div class="flex flex-col grow px-10 pt-6 pb-12 mt-1 w-full font-bold text-center text-white bg-oranye-2 rounded-[40px] max-md:px-5 max-md:mt-4">
											<h3 class="text-2xl">Jumlah Permintaan Konsultasi Online</h3>
											<div class="self-center mt-5 text-6xl max-md:text-4xl" aria-label="<?= $jumlahPermintaan ?> permintaan"><?= $jumlahPermintaan ?></div>
										</div>
									</div>
								</div>
							</div>
							<div class="mt-2 max-md:max-w-full">
								<div class="flex gap-5 max-md:flex-col">
									<div class="flex flex-col w-6/12 max-md:ml-0 max-md:w-full">
										<div class="flex flex-col grow px-10 pt-6 pb-12 w-full font-bold text-center text-white bg-oranye-2 rounded-[40px] max-md:px-5 max-md:mt-3.5">
											<h3 class="text-2xl">Jumlah Permintaan yang disetujui</h3>
											<div class="self-center mt-2.5 text-6xl max-md:text-4xl" aria-label="<?= $jumlahDisetujui ?> permintaan disetujui"><?= $jumlahDisetujui ?></div>
										</div>
									</div>
									<div class="flex flex-col ml-5 w-6/12 max-md:ml-0 max-md:w-full">
										<div class="flex flex-col grow px-12 pt-5 pb-14 w-full font-bold text-center text-white bg-oranye-2 rounded-[40px] max-md:px-5 max-md:mt-3.5">
											<h3 class="text-2xl">Jumlah Permintaan yang ditolak</h3>
											<div class="self-center mt-2.5 text-6xl max-md:text-4xl" aria-label="<?= $jumlahDitolak ?> permintaan ditolak"><?= $jumlahDitolak ?></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>
			</div>
			<!-- Tombol Ekspor -->
			<button type="button" class="self-start px-5 py-2.5 mt-8 ml-11 text-base font-bold text-center text-white bg-green-500 rounded-2xl hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-700" data-toggle="modal" data-target="#exportModal"> Ekspor </button>
			<!-- Modal -->
			<div id="exportModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden z-50">
				<div class="bg-white p-6 rounded-lg shadow-lg w-96">
					<h3 class="text-xl font-semibold">Pilih Format Ekspor</h3>
					<div class="mt-4">
						<a href="/admin/statistics/export?status=
											
											<?= isset($status) ? $status : 'semua' ?>&periode=
											
											<?= isset($periode) ? $periode : 'semua' ?>&format=csv" class="block py-2 px-4 bg-blue-500 text-white rounded-md mb-2 hover:bg-blue-600"> CSV </a>
						<a href="/admin/statistics/export?status=
											
											<?= isset($status) ? $status : 'semua' ?>&periode=
											
											<?= isset($periode) ? $periode : 'semua' ?>&format=xlsx" class="block py-2 px-4 bg-blue-500 text-white rounded-md mb-2 hover:bg-blue-600"> Excel (XLSX) </a>
						<a href="/admin/statistics/export?status=
											
											<?= isset($status) ? $status : 'semua' ?>&periode=
											
											<?= isset($periode) ? $periode : 'semua' ?>&format=word" class="block py-2 px-4 bg-blue-500 text-white rounded-md mb-2 hover:bg-blue-600"> Word (DOCX) </a>
						<button type="button" onclick="closeExportModal()" class="block py-2 px-4 bg-oranye-2 text-white rounded-md hover:bg-oranye-3 mt-4 w-full">Tutup</button>
					</div>
				</div>
			</div>
			<div class="flex flex-col self-end mt-4 w-full text-sm leading-none rounded border-2 border-solid border-zinc-100 max-w-[1310px] min-h-[368px] text-zinc-900 max-md:mr-1.5 max-md:max-w-full container mx-auto p-6 mb-12" role="table" aria-label="Daftar Permintaan"> <?php if (session()->getFlashdata('message')): ?> <p style="color: green;"> <?= session()->getFlashdata('message') ?> </p> <?php endif; ?> <div class="flex flex-col mt-10 overflow-hidden rounded-lg shadow-md">
					<table class="min-w-full border border-gray-200 bg-white">
						<thead>
							<tr class="bg-oranye-2 text-white text-sm font-bold uppercase">
								<th class="px-6 py-3 text-left">Token</th>
								<th class="px-6 py-3 text-left">Topik</th>
								<th class="px-6 py-3 text-center">Status</th>
								<th class="px-6 py-3 text-center">Aksi</th>
							</tr>
						</thead>
						<tbody> <?php if (!empty($requests) && is_array($requests)): ?> <?php foreach ($requests as $request): ?> <tr class="odd:bg-white even:bg-biru-3 hover:bg-oranye-1">
										<td class="px-6 py-4 text-gray-800"> <?= esc($request['token_konsultasi']) ?> </td>
										<td class="px-6 py-4 text-gray-800"> <?= esc($request['topik']) ?> </td>
										<td class="px-6 py-4 text-center">
											<span class="inline-block px-3 py-1 text-sm font-semibold rounded-full 
                                        
														
														<?php
																							if ($request['status_konsultasi'] === 'Selesai') echo 'bg-hijau-1 text-white';
																							elseif ($request['status_konsultasi'] === 'Ditolak') echo 'bg-merah-1 text-white';
																							elseif ($request['status_konsultasi'] === 'Sedang Diproses') echo 'bg-oranye-2 text-white';
																							else echo 'bg-gray-300 text-gray-700';
														?>"> <?= esc($request['status_konsultasi']) ?> </span>
										</td>
										<td class="px-6 py-4 text-center space-x-3">
											<a href="/admin/consultation/detail/
														
														<?= $request['id'] ?>" class="px-3 py-2 text-white bg-hijau-1 rounded-md hover:bg-hijau-2"> Detail </a>
											<a href="#" onclick="confirmDelete('/admin/consultation/delete/<?= $request['id'] ?>')" class="px-3 py-2 text-white bg-merah-1 rounded-md hover:bg-merah-2"> Hapus </a>
										</td>
									</tr> <?php endforeach; ?> <?php else: ?> <tr>
									<td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada data.</td>
								</tr> <?php endif; ?> </tbody>
					</table>
				</div>
				<div class="p-4 bg-white border-t flex justify-center items-center">
					<div class="flex justify-center items-center space-x-2"> <?php if ($pager): ?>
						<?= $pager->links('default', 'tailwind_full') ?>
						<?php endif; ?> 
					</div>
				</div>
			</div>
			<?php include 'footer.php'; ?>
			<script>
				// Open the modal
				document.getElementById('openModalButton').addEventListener('click', () => {
					document.getElementById('filterModal').classList.remove('hidden');
				});
				// Close the modal
				document.getElementById('closeModalButton').addEventListener('click', () => {
					document.getElementById('filterModal').classList.add('hidden');
				});
				// Add event listener to open modal
				document.querySelector('[data-toggle="modal"]').addEventListener('click', openModal);
				// Function to show the modal
				function openModal() {
					document.getElementById("exportModal").classList.remove("hidden");
				}
				// Function to hide the modal
				function closeExportModal() {
					document.getElementById("exportModal").classList.add("hidden");
				}

				// Data grafik dari PHP
				const chartLabels = <?= json_encode(array_keys($chartData)) ?>;
				const chartValues = <?= json_encode(array_values($chartData)) ?>;

				// Inisialisasi Chart.js
				const ctx = document.getElementById('statistikChart').getContext('2d');
				new Chart(ctx, {
					type: 'line', // Jenis grafik: line, bar, pie, dll.
					data: {
						labels: chartLabels,
						datasets: [{
							label: 'Jumlah Konsultasi',
							data: chartValues,
							borderColor: 'rgb(245, 134, 48)',
							backgroundColor: 'rgb(255, 255, 255)',
							borderWidth: 1
						}]
					},
					options: {
						responsive: true,
						plugins: {
							legend: {
								display: true
							}
						},
						scales: {
							x: {
								title: {
									display: true,
									text: 'Tanggal'
								}
							},
							y: {
								title: {
									display: true,
									text: 'Jumlah'
								},
								beginAtZero: true,
								ticks: {
									stepSize: 1 // Menentukan interval sumbu vertikal menjadi 1
								}
							}
						},
						title: {
							display: true, // Aktifkan judul
							text: 'Grafik Jumlah Permintaan Konsultasi', // Isi judul
							font: {
								size: 16, // Ukuran font
								weight: 'bold' // Tebal font
							},
							color: '#333' // Warna teks
						}
					},
					plugins: [{
						id: 'whiteBackground',
						beforeDraw: (chart) => {
							const ctx = chart.canvas.getContext('2d');
							ctx.save();
							ctx.fillStyle = 'white'; // Warna background putih
							ctx.fillRect(0, 0, chart.width, chart.height);
							ctx.restore();
						}
					}]
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
			</script>
</body>

</html>
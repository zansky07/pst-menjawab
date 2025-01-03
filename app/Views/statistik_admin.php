<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Statistik Admin</title>
		<link rel="icon" href="/assets/images/logo-pst.png">
		<script src="https://cdn.tailwindcss.com"></script>
		<link rel="stylesheet" href="
					
					<?= base_url('assets/css/styles.css') ?>">`
	</head>
	<body class="flex flex-col bg-oranye-1 mt-28 md:mt-16">
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
		<div class="flex-grow z-10 flex-col px-10 w-full max-md:px-5 max-md:max-w-full">
			<button id="openModalButton" class="self-start px-6 py-2.5 mt-5 ml-14 text-base font-bold text-center text-white bg-oranye-3 rounded-3xl hover:bg-oranye-4 focus:outline-none focus:ring-2 focus:ring-orange-500 max-md:px-5 max-md:ml-2.5" aria-label="Filter"> Filter </button>
			<form action="
								
								<?= base_url('/admin/statistics') ?>" method="get">
				<div id="filterModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 hidden justify-center items-center z-50">
					<div class="bg-white p-6 rounded-lg w-96 transform translate-x-[-50%] translate-y-[-50%] absolute top-1/2 left-1/2">
						<h3 class="text-2xl font-bold mb-4">Filter Berdasarkan</h3>
						<!-- Filter Status -->
						<div class="mb-4">
							<label for="status" class="block text-sm font-semibold mb-2">Status:</label>
							<select id="status" name="status" class="w-full px-4 py-2 border border-gray-300 rounded-md">
								<option value="selesai
													
													<?= $status === 'selesai' ? 'selected' : '' ?>">Selesai </option>
								<option value="disetujui" <?= $status === 'disetujui' ? 'selected' : '' ?>>Disetujui </option>
								<option value="ditolak" <?= $status === 'ditolak' ? 'selected' : '' ?>>Ditolak </option>
								<option value="sedang_diproses" <?= $status === 'sedang diproses' ? 'selected' : '' ?>>Sedang Diproses </option>
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
							<button id="closeModalButton" class="px-6 py-2 text-white bg-merah-1 rounded-md hover:bg-merah-2">Tutup</button>
							<button type="submit" id="applyFilterButton" class="px-6 py-2 text-white bg-hijau-1 rounded-md hover:bg-hijau-2">Terapkan</button>
						</div>
					</div>
				</div>
			</form>
			<div class="self-end mt-5 w-full max-w-[1315px] max-md:max-w-full">
				<div class="flex gap-5 max-md:flex-col">
					<section class="flex flex-col w-6/12 max-md:ml-0 max-md:w-full" aria-labelledby="statistics-title">
						<div class="flex flex-wrap grow gap-px px-7 py-1.5 w-full text-center text-black bg-white max-md:px-5 max-md:mt-7">
							<div class="flex flex-col self-end mt-20 text-xl whitespace-nowrap max-md:hidden max-md:mt-10" aria-hidden="true">
								<div>50</div>
								<div class="mt-4">40</div>
								<div class="mt-5">30</div>
								<div class="mt-8">20</div>
								<div class="flex flex-col px-0.5 mt-7">
									<div>10</div>
									<div class="self-start mt-6">0</div>
								</div>
							</div>
						</div>
					</section>
					<section class="flex flex-col ml-5 w-6/12 max-md:ml-0 max-md:w-full" aria-label="Statistik Summary">
						<div class="flex flex-col w-full max-md:mt-7 max-md:max-w-full">
							<div class="max-md:max-w-full">
								<div class="flex gap-5 max-md:flex-col">
									<div class="flex flex-col w-6/12 max-md:ml-0 max-md:w-full">
										<div class="flex flex-col px-9 pt-6 pb-11 w-full font-bold text-center text-white bg-oranye-2 rounded-[40px] max-md:px-5 max-md:mt-3">
											<h3 class="text-2xl">Jumlah Pengunjung</h3>
											<div class="self-center mt-11 text-6xl max-md:mt-10 max-md:text-4xl" aria-label="120 pengunjung">120</div>
										</div>
									</div>
									<div class="flex flex-col ml-5 w-6/12 max-md:ml-0 max-md:w-full">
										<div class="flex flex-col grow px-10 pt-6 pb-12 mt-1 w-full font-bold text-center text-white bg-oranye-2 rounded-[40px] max-md:px-5 max-md:mt-4">
											<h3 class="text-2xl">Jumlah Permintaan Konsultasi Online</h3>
											<div class="self-center mt-5 text-6xl max-md:text-4xl" aria-label="100 permintaan">100</div>
										</div>
									</div>
								</div>
							</div>
							<div class="mt-2 max-md:max-w-full">
								<div class="flex gap-5 max-md:flex-col">
									<div class="flex flex-col w-6/12 max-md:ml-0 max-md:w-full">
										<div class="flex flex-col grow px-10 pt-6 pb-12 w-full font-bold text-center text-white bg-oranye-2 rounded-[40px] max-md:px-5 max-md:mt-3.5">
											<h3 class="text-2xl">Jumlah Permintaan yang disetujui</h3>
											<div class="self-center mt-2.5 text-6xl max-md:text-4xl" aria-label="55 permintaan disetujui">55</div>
										</div>
									</div>
									<div class="flex flex-col ml-5 w-6/12 max-md:ml-0 max-md:w-full">
										<div class="flex flex-col grow px-12 pt-5 pb-14 w-full font-bold text-center text-white bg-oranye-2 rounded-[40px] max-md:px-5 max-md:mt-3.5">
											<h3 class="text-2xl">Jumlah Permintaan yang ditolak</h3>
											<div class="self-center mt-2.5 text-6xl max-md:text-4xl" aria-label="10 permintaan ditolak">10</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>
			</div>
			<!-- Tombol Ekspor -->
			<button class="self-start px-5 py-2.5 mt-8 ml-11 text-base font-bold text-center text-white bg-green-500 rounded-2xl hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-700" data-toggle="modal" data-target="#exportModal"> Ekspor </button>
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
						<button onclick="closeExportModal()" class="block py-2 px-4 bg-oranye-2 text-white rounded-md hover:bg-oranye-3 mt-4 w-full">Tutup</button>
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
									<a href="/admin/consultation/delete/
														
														<?= $request['id'] ?>" class="px-3 py-2 text-white bg-merah-1 rounded-md hover:bg-merah-2"> Hapus </a>
								</td>
							</tr> <?php endforeach; ?> <?php else: ?> <tr>
								<td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada data.</td>
							</tr> <?php endif; ?> </tbody>
					</table>
				</div>
				<div class="p-4 bg-white border-t flex justify-center items-center">
					<div class="flex justify-center items-center space-x-2"> <?php if (isset($pager)): ?> <div class="pagination"> <?= $pager->links() ?> </div> <?php endif; ?> </div>
				</div>
			</div>
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
			document.getElementById('dropdownNavbarLink').addEventListener('click', function() {
				const dropdown = document.getElementById('dropdownNavbar');
				dropdown.classList.toggle('hidden');
			});
		</script>
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
		</script>
	</body>
</html>
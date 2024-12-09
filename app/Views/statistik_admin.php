<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Statistik Admin</title> ` <script src="https://cdn.tailwindcss.com"></script>
		<link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">`
	</head>
	<body class="bg-oranye-1 mt-28 md:mt-16">
			<nav class="bg-white shadow shadow-gray-300 fixed top-0 left-0 w-full px-8 z-50">
				<div class="md:h-16 h-28 mx-auto md:px-4 container flex items-center justify-between flex-wrap md:flex-nowrap">
					<div class="flex items-center space-x-4">
						<!-- Logo -->
						<img src="/assets/images/logo-pst.png" alt="Logo" class="h-10 w-10">
						<!-- Teks -->
						<span class="text-gray-800 font-semibold text-sm md:text-base"> PST Menjawab BPS Provinsi DKI Jakarta </span>
					</div>
					<div class="text-gray-500 order-3 w-full md:w-auto md:order-2">
						<ul class="flex font-semibold items-center justify-between space-x-4">
							<li class="hover:text-indigo-400">
								<a href="admin/dashboard">Dashboard</a>
							</li>
							<li class="hover:text-indigo-400">
								<a href="admin/statistics">Statistik</a>
							</li>
							<li class="relative">
								<button id="dropdownNavbarLink" class="text-gray-700 hover:bg-gray-50 md:hover:bg-transparent py-2 md:hover:text-blue-700 flex items-center"> Pengaturan <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
									</svg>
								</button>
								<div id="dropdownNavbar" class="hidden absolute bg-white text-base z-10 list-none divide-y divide-gray-100 rounded shadow mt-2 w-44">
									<ul class="py-1">
										<li>
											<a href="admin/settings" class="text-sm hover:bg-gray-100 text-gray-700 block px-4 py-2">Admin</a>
										</li>
										<li>
											<a href="admin/settings" class="text-sm hover:bg-gray-100 text-gray-700 block px-4 py-2">Konsultan</a>
										</li>
									</ul>
								</div>
							</li>
						</ul>
					</div>
					<div class="order-2 md:order-3">
						<button class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white rounded-xl flex items-center gap-2">
							<span>Keluar</span>
						</button>
					</div>
				</div>
			</nav>
			<script>
				// Dropdown toggle
				document.getElementById('dropdownNavbarLink').addEventListener('click', function() {
					const dropdown = document.getElementById('dropdownNavbar');
					dropdown.classList.toggle('hidden');
				});
			</script>
			<div class="flex z-10 flex-col px-10 w-full max-md:px-5 max-md:max-w-full">
				<button id="openModalButton" class="self-start px-6 py-2.5 mt-5 ml-14 text-base font-bold text-center text-white bg-oranye-3 rounded-3xl hover:bg-oranye-4 focus:outline-none focus:ring-2 focus:ring-orange-500 max-md:px-5 max-md:ml-2.5" aria-label="Filter"> Filter </button>
				<div id="filterModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 hidden justify-center items-center z-50">
					<div class="bg-white p-6 rounded-lg w-96 transform translate-x-[-50%] translate-y-[-50%] absolute top-1/2 left-1/2">
						<h3 class="text-2xl font-bold mb-4">Filter Berdasarkan</h3>
						<!-- Filter Status -->
						<div class="mb-4">
							<label for="status" class="block text-sm font-semibold mb-2">Status:</label>
							<select id="status" class="w-full px-4 py-2 border border-gray-300 rounded-md">
								<option value="selesai">Selesai</option>
								<option value="diterima">Diterima</option>
								<option value="ditolak">Ditolak</option>
								<option value="sedang_diproses">Sedang Diproses</option>
								<option value="semua">Semua</option>
							</select>
							<label for="sort" class="block text-sm font-semibold mb-2">Tampilkan Berdasarkan:</label>
							<select id="sort" class="w-full px-4 py-2 border border-gray-300 rounded-md">
								<option value="1bulan">1 Bulan</option>
								<option value="3bulan">3 Bulan</option>
								<option value="6bulan">6 Bulan</option>
								<option value="12bulan">12 Bulan</option>
							</select>
						</div>
						<div class="flex justify-between mt-4">
							<button id="closeModalButton" class="px-6 py-2 text-white bg-merah-1 rounded-md hover:bg-merah-2">Tutup</button>
							<button id="applyFilterButton" class="px-6 py-2 text-white bg-hijau-1 rounded-md hover:bg-hijau-2">Terapkan</button>
						</div>
					</div>
				</div>
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
				<button class="self-start px-5 py-2.5 mt-8 ml-11 text-base font-bold text-center text-white bg-green-500 rounded-2xl hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-700 max-md:ml-2.5" aria-label="Export data"> Export </button>
				<div class="flex flex-col self-end mt-4 w-full text-sm leading-none rounded border-2 border-solid border-zinc-100 max-w-[1310px] min-h-[368px] text-zinc-900 max-md:mr-1.5 max-md:max-w-full" role="table" aria-label="Daftar Permintaan"> <?php if (session()->getFlashdata('message')): ?> <p style="color: green;"> <?= session()->getFlashdata('message') ?> </p> <?php endif; ?> <table>
						<thead>
							<tr>
								<th>Token</th>
								<th>Topik</th>
								<th>Status</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody> <?php if (!empty($requests) && is_array($requests)): ?> <?php foreach ($requests as $request): ?> <tr>
								<td> <?= esc($request['token_konsultasi']) ?> </td>
								<td> <?= esc($request['topik']) ?> </td>
								<td> <?= esc($request['status_konsultasi']) ?> </td>
								<td>
									<a href="/admin/consultation/detail/
													
														<?= $request['id'] ?>" class="btn btn-detail">Detail </a>
									<a href="/admin/consultation/delete/
													
														<?= $request['id'] ?>" class="btn btn-delete">Hapus </a>
								</td>
							</tr> <?php endforeach; ?> <?php else: ?> <tr>
								<td colspan="4">Tidak ada data.</td>
							</tr> <?php endif; ?> </tbody>
					</table>
					<div class="overflow-x-auto max-w-full">
						<div class="flex flex-col text-center gap-5 py-5 text-sm leading-6 max-md:mr-1.5" role="rowgroup">
							<!-- Dynamic content rows -->
						</div>
					</div>
				</div>
			</div>
		<script>
			const hamburgerButton = document.getElementById('hamburgerButton');
			const navbarMenu = document.getElementById('navbarMenu');
			hamburgerButton.addEventListener('click', () => {
				navbarMenu.classList.toggle('hidden');
			});
			// Open the modal
			document.getElementById('openModalButton').addEventListener('click', () => {
				document.getElementById('filterModal').classList.remove('hidden');
			});
			// Close the modal
			document.getElementById('closeModalButton').addEventListener('click', () => {
				document.getElementById('filterModal').classList.add('hidden');
			});
			// Apply filter (you can handle the filter logic here)
			document.getElementById('applyFilterButton').addEventListener('click', () => {
				const status = document.getElementById('status').value;
				const sort = document.getElementById('sort').value;
				console.log(`Filter applied with Status: ${status} and Sort by: ${sort}`);
				// You can add your filter logic to update the content dynamically here
				document.getElementById('filterModal').classList.add('hidden');
			});
		</script>
	</body>
</html>
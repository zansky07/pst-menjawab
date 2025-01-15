<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Statistik Admin</title>
	<link rel="icon" href="/assets/images/logo-pst.png">
	<script src="https://cdn.tailwindcss.com"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<link rel="stylesheet" href="
					
					<?= base_url('assets/css/styles.css') ?>">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
	<style>
		body {
			font-family: 'Poppins', sans-serif;
			background-color: #f9f2f1;
		}
	</style>
</head>

<<<<<<< HEAD
	</head>
	
	<body class="flex flex-col bg-oranye-1 mt-28 md:mt-16">
		
		<?php include 'header_admin.php';?>
		
		<div class="flex-grow z-10 flex-col px-10 w-full max-md:px-5 max-md:max-w-full">
			
			<div class="self-end mt-5 w-full max-w-[1315px] max-md:max-w-full">
				<div class="flex gap-5 max-md:flex-col">
					<section class="flex flex-col w-6/12 bg-white rounded-xl shadow-lg max-md:ml-0 max-md:w-full" aria-labelledby="statistics-title">
						<h2 class="px-4 py-2 text-orange-500 font-bold">Kebutuhan Data Terpenuhi</h2>
						<hr>
						<canvas id="pieChart" width="400" height="400" class="rounded-xl mx-auto my-4"></canvas>
					</section>

					<section class="flex flex-col ml-5 w-6/12 bg-white rounded-xl shadow-lg max-md:ml-0 max-md:w-full" aria-label="Statistik Summary">
						
						<h2 class="px-4 py-2 text-orange-500 font-bold">Kepuasan Pengguna</h2>
						<hr>
    					<canvas id="barChart" width="400" height="200" class="p-4 my-8"></canvas>
						
					</section>
				</div>
			</div>
			
            
			<div class="flex flex-col self-end mt-4 w-full text-sm leading-none rounded border-2 border-solid border-zinc-100 max-w-[1310px] min-h-[368px] text-zinc-900 max-md:mr-1.5 max-md:max-w-full container mx-auto p-6 mb-12" role="table" aria-label="Daftar Permintaan"> <?php if (session()->getFlashdata('message')): ?> <p style="color: green;"> <?= session()->getFlashdata('message') ?> </p> <?php endif; ?> <div class="flex flex-col mt-10 overflow-hidden rounded-lg shadow-md">
					<table id="myTable" class="min-w-full border border-gray-200 bg-white">
						<thead>
							<tr class="bg-oranye-2 text-white text-sm font-bold uppercase">
								<th class="px-6 py-3 text-left">No</th>
								<th class="px-6 py-3 text-left">Token</th>
								<th class="px-6 py-3 text-left">Topik</th>
								<th class="px-6 py-3 text-left">Konsultan</th>
								<th class="px-6 py-3 text-left">Kendala</th>
								<th class="px-6 py-3 text-left">Kritik & Saran</th>
							</tr>
						</thead>
						<tbody> <?php if (!empty($feedbacks)) : ?>
								<?php foreach ($feedbacks as $index => $feedback) : ?>
									<tr class="border-b">
										<td class="px-6 py-3"><?= $index + 1 ?></td>
										<td class="px-6 py-3"><?= $feedback['token_konsultasi'] ?></td>
										<td class="px-6 py-3"><?= htmlspecialchars($feedback['konsultasi_topik'], ENT_QUOTES, 'UTF-8') ?></td>
										<td class="px-6 py-3"><?= htmlspecialchars($feedback['nama_konsultan'] ?? 'Tidak Ada', ENT_QUOTES, 'UTF-8') ?></td>
										<td class="px-6 py-3"><?= htmlspecialchars($feedback['feedback1'] ?? 'Tidak Ada', ENT_QUOTES, 'UTF-8') ?></td>
										<td class="px-6 py-3 word-wrap"><?= htmlspecialchars($feedback['feedback6'] ?? 'Tidak Ada', ENT_QUOTES, 'UTF-8') ?></td>
									</tr>
								<?php endforeach; ?>
							<?php else : ?>
								<tr>
									<td colspan="6">Belum ada data.</td>
								</tr>
							<?php endif; ?>
						</tbody>
					</table>
=======
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

		<div class="self-end mt-5 w-full max-w-[1315px] max-md:max-w-full">
			<div class="flex gap-5 max-md:flex-col">
				<section class="flex flex-col w-6/12 bg-white rounded-xl shadow-lg max-md:ml-0 max-md:w-full" aria-labelledby="statistics-title">
					<h2 class="px-4 py-2 text-orange-500 font-bold">Kebutuhan Data Terpenuhi</h2>
					<hr>
					<canvas id="pieChart" width="400" height="400" class="rounded-xl mx-auto my-4"></canvas>
				</section>

				<section class="flex flex-col ml-5 w-6/12 bg-white rounded-xl shadow-lg max-md:ml-0 max-md:w-full" aria-label="Statistik Summary">

					<h2 class="px-4 py-2 text-orange-500 font-bold">Kepuasan Pengguna</h2>
					<hr>
					<canvas id="barChart" width="400" height="200" class="p-4 my-8"></canvas>

				</section>
			</div>
		</div>


		<div class="flex flex-col self-end mt-4 w-full text-sm leading-none rounded border-2 border-solid border-zinc-100 max-w-[1310px] min-h-[368px] text-zinc-900 max-md:mr-1.5 max-md:max-w-full container mx-auto p-6 mb-12" role="table" aria-label="Daftar Permintaan"> <?php if (session()->getFlashdata('message')): ?> <p style="color: green;"> <?= session()->getFlashdata('message') ?> </p> <?php endif; ?> <div class="flex flex-col mt-10 overflow-hidden rounded-lg shadow-md">
				<table id="myTable" class="min-w-full border border-gray-200 bg-white">
					<thead>
						<tr class="bg-oranye-2 text-white text-sm font-bold uppercase">
							<th class="px-6 py-3 text-left">No</th>
							<th class="px-6 py-3 text-left">Token</th>
							<th class="px-6 py-3 text-left">Topik</th>
							<th class="px-6 py-3 text-left">Konsultan</th>
							<th class="px-6 py-3 text-left">Kendala</th>
							<th class="px-6 py-3 text-left">Kritik & Saran</th>
						</tr>
					</thead>
					<tbody> <?php if (!empty($feedbacks)) : ?>
							<?php foreach ($feedbacks as $index => $feedback) : ?>
								<tr class="border-b">
									<td class="px-6 py-3"><?= $index + 1 ?></td>
									<td class="px-6 py-3"><?= $feedback['token_konsultasi'] ?></td>
									<td class="px-6 py-3"><?= htmlspecialchars($feedback['konsultasi_topik'], ENT_QUOTES, 'UTF-8') ?></td>
									<td class="px-6 py-3"><?= htmlspecialchars($feedback['nama_konsultan'] ?? 'Tidak Ada', ENT_QUOTES, 'UTF-8') ?></td>
									<td class="px-6 py-3"><?= htmlspecialchars($feedback['feedback1'] ?? 'Tidak Ada', ENT_QUOTES, 'UTF-8') ?></td>
									<td class="px-6 py-3 word-wrap"><?= htmlspecialchars($feedback['feedback6'] ?? 'Tidak Ada', ENT_QUOTES, 'UTF-8') ?></td>
								</tr>
							<?php endforeach; ?>
						<?php else : ?>
							<tr>
								<td colspan="6">Belum ada data.</td>
							</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<footer class="relative w-full mt-20">
		<!-- Gambar footer2 di atas kontainer bg-oranye-2 -->
		<div class="absolute inset-x-0 top-0 -translate-y-full w-full z-20">
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
>>>>>>> f299df78e428aa8e57dfd4b9c9aeb65099211ed2
				</div>
			</div>
			<!-- Copyright -->
			<div class="relative text-center text-xs md:text-sm mt-4 pb-4"> &copy; 2024 Badan Pusat Statistik Provinsi DKI Jakarta. All rights reserved. </div>
		</div>
<<<<<<< HEAD
		
		<?php include 'footer.php';?>

		<script>
			document.getElementById('dropdownNavbarLink').addEventListener('click', function() {
				const dropdown = document.getElementById('dropdownNavbar');
				dropdown.classList.toggle('hidden');
=======
	</footer>
	<script>
		document.getElementById('dropdownNavbarLink').addEventListener('click', function() {
			const dropdown = document.getElementById('dropdownNavbar');
			dropdown.classList.toggle('hidden');
		});
	</script>

	<!-- table -->
	<script>
		$(document).ready(function() {
			$('#myTable').DataTable({
				responsive: true, // Responsif
				scrollX: true, // Scroll horizontal
>>>>>>> f299df78e428aa8e57dfd4b9c9aeb65099211ed2
			});
		});
	</script>

<<<<<<< HEAD
		<!-- table -->
		<script>
			$(document).ready(function() {
				$('#myTable').DataTable({
					responsive: true, // Responsif
					scrollX: true,    // Scroll horizontal
				});
			});

		</script>

		<script>
			// Data untuk Pie Chart
			const pieData = {
				labels: ['Ya', 'Tidak'],
				datasets: [{
					data: [<?= $proporsiTerjawab['Ya'] ?>, <?= $proporsiTerjawab['Tidak'] ?>],
					backgroundColor: ['#4caf50', '#f44336']
				}]
			};

			// Data untuk Bar Chart
			const barData = {
				labels: ['Layanan', 'Web', 'Kemungkinan Menggunakan Lagi'],
				datasets: [{
					label: 'Rata-rata Kepuasan (1-5)',
					data: [
						<?= $averageKepuasan['layanan'] ?>,
						<?= $averageKepuasan['web'] ?>,
						<?= $averageKepuasan['kemungkinan'] ?>
					],
					backgroundColor: ['#2196f3', '#3f51b5', '#ff9800']
				}]
			};

			// Pie Chart
			const pieCtx = document.getElementById('pieChart').getContext('2d');
			new Chart(pieCtx, {
				type: 'doughnut',
				data: pieData,
				options: {
					responsive: false,
					plugins: {
						tooltip: {
							callbacks: {
								label: function (tooltipItem) {
									const label = tooltipItem.label || '';
									const value = tooltipItem.raw || 0;
									const total = tooltipItem.dataset.data.reduce((a, b) => a + b, 0);
									const percentage = ((value / total) * 100).toFixed(2);
									return `${label}: ${value} (${percentage}%)`;
								}
							}
						},
						legend: {
							position: 'bottom', // Legenda di bawah
						}
					},
				
				}
			});

			// Bar Chart
			const barCtx = document.getElementById('barChart').getContext('2d');
			new Chart(barCtx, {
				type: 'bar',
				data: barData,
				options: {
					responsive: true,
					plugins: {
						legend: {
							display: true, // Aktifkan legenda
							position: 'bottom', // Letakkan di bawah grafik
							labels: {
								generateLabels: (chart) => {
									const data = chart.data.datasets[0];
									return data.backgroundColor.map((color, index) => ({
										text: chart.data.labels[index], // Nama kategori
										fillStyle: color,
									}));
								}
							}
						},
						tooltip: {
							callbacks: {
								label: (tooltipItem) => {
									return `${tooltipItem.dataset.label}: ${tooltipItem.raw}`;
								}
=======
	<script>
		// Data untuk Pie Chart
		const pieData = {
			labels: ['Ya', 'Tidak'],
			datasets: [{
				data: [<?= $proporsiTerjawab['Ya'] ?>, <?= $proporsiTerjawab['Tidak'] ?>],
				backgroundColor: ['#4caf50', '#f44336']
			}]
		};

		// Data untuk Bar Chart
		const barData = {
			labels: ['Layanan', 'Web', 'Kemungkinan Menggunakan Lagi'],
			datasets: [{
				label: 'Rata-rata Kepuasan (1-5)',
				data: [
					<?= $averageKepuasan['layanan'] ?>,
					<?= $averageKepuasan['web'] ?>,
					<?= $averageKepuasan['kemungkinan'] ?>
				],
				backgroundColor: ['#2196f3', '#3f51b5', '#ff9800']
			}]
		};

		// Pie Chart
		const pieCtx = document.getElementById('pieChart').getContext('2d');
		new Chart(pieCtx, {
			type: 'doughnut',
			data: pieData,
			options: {
				responsive: false,
				plugins: {
					tooltip: {
						callbacks: {
							label: function(tooltipItem) {
								const label = tooltipItem.label || '';
								const value = tooltipItem.raw || 0;
								const total = tooltipItem.dataset.data.reduce((a, b) => a + b, 0);
								const percentage = ((value / total) * 100).toFixed(2);
								return `${label}: ${value} (${percentage}%)`;
							}
						}
					},
					legend: {
						position: 'bottom', // Legenda di bawah
					}
				},

			}
		});

		// Bar Chart
		const barCtx = document.getElementById('barChart').getContext('2d');
		new Chart(barCtx, {
			type: 'bar',
			data: barData,
			options: {
				responsive: true,
				plugins: {
					legend: {
						display: true, // Aktifkan legenda
						position: 'bottom', // Letakkan di bawah grafik
						labels: {
							generateLabels: (chart) => {
								const data = chart.data.datasets[0];
								return data.backgroundColor.map((color, index) => ({
									text: chart.data.labels[index], // Nama kategori
									fillStyle: color,
								}));
>>>>>>> f299df78e428aa8e57dfd4b9c9aeb65099211ed2
							}
						}
					},
					scales: {
						y: {
							beginAtZero: true,
							max: 5, // Batasi skala hingga 5
							ticks: {
									stepSize: 1 // Menentukan interval sumbu vertikal menjadi 1
								}
						}
					}
<<<<<<< HEAD
				}
			});
    	</script>
	</body>
=======
				},
				scales: {
					y: {
						beginAtZero: true,
						max: 5, // Batasi skala hingga 5
						ticks: {
							stepSize: 1 // Menentukan interval sumbu vertikal menjadi 1
						}
					}
				}
			}
		});
	</script>
</body>

>>>>>>> f299df78e428aa8e57dfd4b9c9aeb65099211ed2
</html>
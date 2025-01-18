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
				</div>
			</div>
			
		</div>
		
		<?php include 'footer.php';?>

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
				}
			});
    	</script>
	</body>
</html>
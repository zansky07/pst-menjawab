<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PST Menjawab | Konsultasi</title>
	<link rel="icon" href="/assets/images/logo-pst.png">
	<script src="https://cdn.tailwindcss.com"></script>
	<link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
	<style>
		body {
			font-family: 'Poppins', sans-serif;
			background-image: url('<?= base_url('assets/images/bg-consultation.png') ?>');
		}
	</style>
</head>

<body class="mt-28 md:mt-16">
	<nav>
		<?php include 'header_user.php'; ?>
	</nav>

	<div class="max-w-3xl mx-auto mt-20 p-6 bg-white rounded-lg shadow-lg text-oranye-2 h-[290px]">
		<div class="text-center mb-12">
			<h2 class="text-2xl font-semibold items-center mt-8 mb-5">Bagaimana anda ingin berkonsultasi bersama kami?</h2>
			<div class="flex justify-center space-x-4 items-center min-h-[100px]">
				<a href="https://silastik.bps.go.id" class="bg-orange-100 hover:bg-orange-200 text-orange py-4 px-8 border-b-4 border-orange-300 hover:border-orange-500 rounded w-[300px]">Melalui Chat</a>
				<a href="/consultation/reserve" class="bg-orange-100 hover:bg-orange-200 text-orange py-4 px-8 border-b-4 border-orange-300 hover:border-orange-500 rounded w-[300px]">Melalui Pertemuan Virtual</a>
			</div>
		</div>
	</div>
	<?php include 'footer.php'; ?>
</body>

</html>
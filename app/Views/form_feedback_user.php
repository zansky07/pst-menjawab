<!DOCTYPE html>
<html lang="id">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>PST Menjawab | Survei Kepuasan Konsumen</title>
		<link rel="icon" href="/assets/images/logo-pst.png">
		<script src="https://cdn.tailwindcss.com"></script>
		<link href="<?= base_url('assets/css/styles.css') ?>" rel="stylesheet">
		<link href="<?= base_url('assets/css/form.css') ?>" rel="stylesheet">
	</head>
	<body class="bg-oranye-1 mt-28 md:mt-16">
	
		<?php include 'header_user.php';?>
    
		<!-- Judul di luar kotak -->
		<div class="text-center mt-7 mb-7">
			<h2 class="text-3xl font-bold mb-4 text-gray-800">Survei Kepuasan Konsumen PST Menjawab</h2>
		</div>

		<!-- Kotak Formulir -->
		<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg">
			<form action="/consultation/feedback/submit" method="post">
				<div class="grid grid-cols-1 gap-6">
					<!-- Token -->
					<div>
						<label for="token" class="block text-sm font-medium text-gray-700 mb-1">Token</label>
						<input type="text" id="token" name="token" value="<?= esc($token) ?>" readonly class="block w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
					</div>

					<!-- Kendala -->
					<div>
						<label for="kendala" class="block text-sm font-medium text-gray-700 mb-1">Apakah Anda mengalami kendala saat memakai layanan kami? Jika ya, apa?</label>
						<textarea id="kendala" name="kendala" class="block w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"><?= old('kendala') ?></textarea>
						<?php if (isset($errors['kendala'])): ?>
							<div class="text-red-600 text-sm mt-1"><?= $errors['kendala'] ?></div>
						<?php endif; ?>
					</div>

					<!-- Kemungkinan konsultasi -->
					<div>
						<label for="konsultasi" class="block text-sm font-medium text-gray-700 mb-1">Kemungkinan konsultasi lagi (1-5)?</label>
						<div class="flex space-x-4">
							<?php for ($i = 1; $i <= 5; $i++): ?>
								<label class="flex items-center space-x-2">
									<input 
										type="radio" 
										name="konsultasi" 
										value="<?= $i ?>" 
										class="peer hidden" 
										<?= old('konsultasi') == $i ? 'checked' : '' ?>>
									<div class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-300 peer-checked:bg-orange-500 peer-checked:text-white cursor-pointer">
										<?= $i ?>
									</div>
								</label>
							<?php endfor; ?>
						</div>
						<?php if (isset($errors['konsultasi'])): ?>
							<div class="text-red-600 text-sm mt-1"><?= $errors['konsultasi'] ?></div>
						<?php endif; ?>
					</div>

					<!-- Kepuasan penggunaan website -->
					<div>
						<label for="kepuasan_web" class="block text-sm font-medium text-gray-700 mb-1">Kepuasan penggunaan website (1-5)?</label>
						<div class="flex space-x-4">
							<?php for ($i = 1; $i <= 5; $i++): ?>
								<label class="flex items-center space-x-2">
									<input 
										type="radio" 
										name="kepuasan_web" 
										value="<?= $i ?>" 
										class="peer hidden" 
										<?= old('kepuasan_web') == $i ? 'checked' : '' ?>>
									<div class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-300 peer-checked:bg-orange-500 peer-checked:text-white cursor-pointer">
										<?= $i ?>
									</div>
								</label>
							<?php endfor; ?>
						</div>
						<?php if (isset($errors['kepuasan_web'])): ?>
							<div class="text-red-600 text-sm mt-1"><?= $errors['kepuasan_web'] ?></div>
						<?php endif; ?>
					</div>

					<!-- Terjawab -->
					<div>
						<label for="terjawab" class="block text-sm font-medium text-gray-700 mb-1">Apakah kebutuhan Anda terjawab?</label>
						<select id="terjawab" name="terjawab" class="block w-full p-2 border border-gray-300 rounded-md">
							<option value="" disabled <?= old('terjawab') ? '' : 'selected' ?>>-</option>
							<option value="Ya" <?= old('terjawab') === 'Ya' ? 'selected' : '' ?>>Ya</option>
							<option value="Tidak" <?= old('terjawab') === 'Tidak' ? 'selected' : '' ?>>Tidak</option>
						</select>
						<?php if (isset($errors['terjawab'])): ?>
							<div class="text-red-600 text-sm mt-1"><?= $errors['terjawab'] ?></div>
						<?php endif; ?>
					</div>

					<!-- Kepuasan terhadap layanan -->
					<div>
						<label for="kepuasan" class="block text-sm font-medium text-gray-700 mb-1">Kepuasan terhadap layanan (1-5)?</label>
						<div class="flex space-x-4">
							<?php for ($i = 1; $i <= 5; $i++): ?>
								<label class="flex items-center space-x-2">
									<input 
										type="radio" 
										name="kepuasan" 
										value="<?= $i ?>" 
										class="peer hidden" 
										<?= old('kepuasan') == $i ? 'checked' : '' ?>>
									<div class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-300 peer-checked:bg-orange-500 peer-checked:text-white cursor-pointer">
										<?= $i ?>
									</div>
								</label>
							<?php endfor; ?>
						</div>
						<?php if (isset($errors['kepuasan'])): ?>
							<div class="text-red-600 text-sm mt-1"><?= $errors['kepuasan'] ?></div>
						<?php endif; ?>
					</div>

					<!-- Kritik dan Saran -->
					<div>
						<label for="kritik_saran" class="block text-sm font-medium text-gray-700 mb-1">Kritik dan Saran</label>
						<textarea id="kritik_saran" name="kritik_saran" class="block w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"><?= old('kritik_saran') ?></textarea>
						<?php if (isset($errors['kritik_saran'])): ?>
							<div class="text-red-600 text-sm mt-1"><?= $errors['kritik_saran'] ?></div>
						<?php endif; ?>
					</div>
				</div>

				<!-- Tombol Submit -->
				<div class="mt-6">
					<button type="submit" class="w-full bg-orange-500 text-white py-2 px-4 rounded-md hover:bg-orange-600">Kirim</button>
				</div>
			</form>
		</div>
		
		<?php include 'footer.php';?>
	</body>
</html>
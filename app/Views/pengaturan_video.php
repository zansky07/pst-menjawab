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

        iframe {
			width: 100%;
			max-width: 600px;
			aspect-ratio: 16 / 9;
			border-radius: 10px;
		}
	</style>
</head>

<body class="bg-oranye-1 min-h-screen flex flex-col mt-28 md:mt-16">

	<?php include 'header_admin.php'; ?>

	<!-- Main Content -->
	<main class="flex-1 container mx-auto px-4 py-6">
		<h1 class="text-2xl font-bold text-gray-700 mb-6 text-center">Pengaturan Video di Beranda</h1>

		<!-- Table -->
		<div class="bg-white shadow-md rounded-lg p-6 max-w-2xl mx-auto">
            <!-- Menampilkan link video saat ini -->
			<div class="mb-4">
				<p class="font-semibold text-gray-700 mb-2">Link video saat ini:</p>
				<p class="text-blue-600 break-all" id="currentLink"><?= esc($videoLink ?? 'Belum ada link video') ?></p>
			</div>

            <!-- Form ubah link -->
			<form id="updateVideoForm" method="POST" action="<?= base_url('/admin/settings/video/update') ?>" class="flex gap-2 mb-6">
				<input type="text" name="video_link" id="videoLinkInput"
					class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-orange-400"
					placeholder="Ubah link video" value="<?= esc($videoLink ?? '') ?>" required>

				<button type="submit"
					class="bg-orange-500 text-white font-semibold px-4 py-2 rounded-lg hover:bg-orange-600 transition duration-200">
					Edit
				</button>
			</form>

            <!-- Preview video -->
			<div class="text-center">
				<h2 class="font-semibold text-gray-700 mb-3">Preview Video:</h2>
				<iframe id="videoPreview" 
					src="<?= isset($videoLink) ? esc($videoLink) : '' ?>" 
					title="Video Beranda"
					allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
					allowfullscreen>
				</iframe>
			</div>



			
		</div>
	</main>

	<?php include 'footer.php'; ?>

	<script>
		// Update preview video secara real-time ketika input berubah
		$(document).ready(function () {
            $('#videoLinkInput').on('input', function () {
                const link = $(this).val().trim();
                const embedLink = convertToEmbed(link);
                $('#videoPreview').attr('src', embedLink);
            });

            // Fungsi konversi link ke format embed
            function convertToEmbed(url) {
                if (!url) return '';

                let videoId = '';

                // Format 1: https://www.youtube.com/watch?v=VIDEO_ID
                if (url.includes('watch?v=')) {
                    videoId = url.split('watch?v=')[1];
                    videoId = videoId.split(/[?&]/)[0]; // hapus parameter tambahan
                    return `https://www.youtube.com/embed/${videoId}`;
                }

                // Format 2: https://youtu.be/VIDEO_ID
                if (url.includes('youtu.be/')) {
                    videoId = url.split('youtu.be/')[1];
                    videoId = videoId.split(/[?&]/)[0];
                    return `https://www.youtube.com/embed/${videoId}`;
                }

                // Format 3: https://www.youtube.com/embed/VIDEO_ID (sudah embed)
                if (url.includes('youtube.com/embed/')) {
                    videoId = url.split('youtube.com/embed/')[1];
                    videoId = videoId.split(/[?&]/)[0];
                    return `https://www.youtube.com/embed/${videoId}`;
                }

                // Selain YouTube, biarkan kosong (atau bisa kembalikan aslinya)
                return '';
            }
        });

		// Tampilkan SweetAlert setelah update link
		<?php if (session()->getFlashdata('update_status')): ?>
			const status = "<?= session()->getFlashdata('update_status') ?>"; // 'success' atau 'error'
			const message = "<?= session()->getFlashdata('message') ?>";

			Swal.fire({
				icon: status,
				title: status === 'success' ? 'Berhasil!' : 'Gagal!',
				text: message,
				showConfirmButton: true,
				confirmButtonColor: '#3085d6',
				confirmButtonText: 'OK'
			});
		<?php endif; ?>
	</script>

</body>

</html>

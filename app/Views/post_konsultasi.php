<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Detail Konsultasi Virtual</title>
    <link rel="icon" href="/assets/images/logo-pst.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
    <!-- Add SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const addQuestionButton = document.getElementById('add-question');
            const notulaContainer = document.getElementById('notula-container');
            const uploadButton = document.getElementById('upload-button');
            const fileInput = document.getElementById('file-input');
            const uploadedImage = document.getElementById('uploaded-image');
            const uploadText = document.getElementById('upload-text');
            const uploadSizeText = document.getElementById('upload-size-text');
            const form = document.querySelector('form');

            // Handle form submission with SweetAlert2
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Apakah Anda yakin ingin menyimpan data ini?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#f97316', // orange-500
                    cancelButtonColor: '#6b7280', // gray-500
                    confirmButtonText: 'Ya, Simpan',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

            // Tambahkan pertanyaan baru
            addQuestionButton.addEventListener('click', function(e) {
                e.preventDefault();

                const questionCount = notulaContainer.querySelectorAll('input[name^="pertanyaan"]').length + 1;

                const questionField = document.createElement('input');
                questionField.type = 'text';
                questionField.name = `pertanyaan${questionCount}`;
                questionField.className = 'bg-oranye-1 rounded-md p-2 mb-2 w-full';
                questionField.placeholder = `Pertanyaan ${questionCount}`;

                const answerField = document.createElement('input');
                answerField.type = 'text';
                answerField.name = `jawaban${questionCount}`;
                answerField.className = 'bg-oranye-1 rounded-md p-2 ml-4 mb-2 w-full';
                answerField.placeholder = `Jawaban pertanyaan ${questionCount}`;

                notulaContainer.appendChild(questionField);
                notulaContainer.appendChild(answerField);
            });

            // Upload dan tampilkan gambar dengan validasi
            uploadButton.addEventListener('click', () => {
                fileInput.click();
            });

            fileInput.addEventListener('change', (event) => {
                const file = event.target.files[0];
                if (file) {
                    if (file.size > 2 * 1024 * 1024) {
                        Swal.fire({
                            title: 'Error',
                            text: 'Ukuran gambar harus kurang dari 2MB!',
                            icon: 'error',
                            confirmButtonColor: '#f97316'
                        });
                        fileInput.value = ""; // Reset file input
                    } else {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            uploadedImage.src = e.target.result;
                            uploadedImage.style.display = 'block';
                            uploadText.style.display = 'none';
                            uploadSizeText.style.display = 'none';
                        };
                        reader.readAsDataURL(file);
                    }
                }
            });

            // Hide placeholders if an image is already uploaded
            if (uploadedImage.src.includes('upload.png') === false) {
                uploadText.style.display = 'none';
                uploadSizeText.style.display = 'none';
            }
        });
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-oranye-1 flex flex-col justify-center items-center min-h-screen">
    <?php include 'header_admin.php'; ?>

    <main class="bg-white rounded-lg shadow-lg p-8 w-full max-w-4xl mt-28 mb-28 flex-grow">
        <h1 class="text-2xl font-semibold mb-6">Detail Konsultasi Virtual</h1>
        <form action="/admin/consultation/postConsultation/<?= esc($konsultasi['id']) ?>" method="POST" enctype="multipart/form-data">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Nama Petugas</label>
                        <input type="text" class="bg-oranye-1 rounded-md p-2 w-full"  value="<?= isset($konsultan['nama']) ? esc($konsultan['nama']) : 'Data tidak tersedia'; ?>" readonly>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Nama Konsumen</label>
                        <input type="text" class="bg-oranye-1 rounded-md p-2 w-full" value="<?= esc($konsultasi['nama_konsumen']) ?>" readonly>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Status</label>
                        <input type="text" class="bg-oranye-1 rounded-md p-2 w-full" value="Selesai" readonly>
                    </div>
                    <?php if (!empty($konsultasi['notula'])): ?>
                        <div class="mb-4">

                            <label class="block text-gray-700">Riwayat Notula</label>
                            <textarea class="bg-oranye-1 rounded-md p-2 w-full" readonly><?= htmlspecialchars($konsultasi['notula']) ?></textarea>
                        </div>
                    <?php endif; ?>
                    <div class="mb-4" id="notula-container">
                        <?php if (!empty($konsultasi['notula'])): ?>
                            <label class="block text-gray-700">Notula Baru</label>
                        <?php else: ?>
                            <label class="block text-gray-700">Notula</label>
                        <?php endif; ?>
                        <input type="text" name="pertanyaan1" class="bg-oranye-1 rounded-md p-2 mb-2 w-full" placeholder="Pertanyaan 1" value="<?= old('pertanyaan1', $konsultasi['pertanyaan1'] ?? '') ?>">
                        <input type="text" name="jawaban1" class="bg-oranye-1 rounded-md p-2 ml-4 mb-2 w-full" placeholder="Jawaban pertanyaan 1" value="<?= old('jawaban1', $konsultasi['jawaban1'] ?? '') ?>">
                    </div>
                    <button id="add-question" class="bg-orange-500 text-white rounded-md px-4 py-2">TAMBAH PERTANYAAN</button>
                </div>
                <div class="flex flex-col items-center">
                    <button id="upload-button" type="button" class="bg-orange-500 text-white rounded-md px-4 py-2 mb-4">PILIH GAMBAR</button>
                    <input type="file" id="file-input" name="dokumentasi" class="hidden" accept="image/*" />
                    <div id="image-box" class="bg-oranye-1 rounded-md p-8 flex flex-col items-center justify-center w-full">
                        <img
                            id="uploaded-image"
                            alt="Uploaded image"
                            class="mb-4"
                            src="<?= !empty($konsultasi['dokumentasi'])
                                        ? base_url('/assets/images/dokum/' . $konsultasi['dokumentasi'])
                                        : base_url('/assets/images/upload.png') ?>"
                            style="display: <?= !empty($konsultasi['dokumentasi']) ? 'block' : 'none' ?>; width: 300px; height: auto;" />
                        <p id="upload-text" class="text-center">Upload Image</p>
                        <p id="upload-size-text" class="text-center text-sm">Ukuran gambar harus kurang dari <span class="font-semibold">2MB</span></p>
                    </div>
                </div>
            </div>
            <div class="flex justify-end mt-6 space-x-4">
                <button type="submit" class="bg-orange-500 text-white rounded-md px-4 py-2">SIMPAN</button>
                <a href="/admin/consultation/detail/<?= $konsultasi['id'] ?>" class="bg-orange-500 text-white rounded-md px-4 py-2">KEMBALI</a>
            </div>
        </form>
    </main>
    <?php include 'footer.php'; ?>
</body>

</html>
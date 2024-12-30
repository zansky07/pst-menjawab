<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Detail Konsultasi Virtual</title>
    <link rel="icon" href="/assets/images/logo-pst.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const addQuestionButton = document.getElementById('add-question');
            const notulaContainer = document.getElementById('notula-container');

            const uploadButton = document.getElementById('upload-button');
            const fileInput = document.getElementById('file-input');
            const uploadedImage = document.getElementById('uploaded-image');
            const uploadText = document.getElementById('upload-text');
            const uploadSizeText = document.getElementById('upload-size-text');

            // Tambahkan pertanyaan baru
            addQuestionButton.addEventListener('click', function (e) {
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

            // Upload dan tampilkan gambar
            uploadButton.addEventListener('click', () => {
                fileInput.click();
            });

            fileInput.addEventListener('change', (event) => {
                const file = event.target.files[0];
                if (file) {
                    if (file.size > 2 * 1024 * 1024) {
                        alert('Ukuran gambar harus kurang dari 2MB!');
                        fileInput.value = ""; // Reset file input
                    } else {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            uploadedImage.src = e.target.result; // Update image src
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
</head>

<body class="bg-oranye-1 flex justify-center items-center min-h-screen">
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

    <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-4xl mt-28 mb-28">
        <h1 class="text-2xl font-semibold mb-6">Detail Konsultasi Virtual</h1>
        <form action="/admin/consultation/postConsultation/<?= esc($konsultasi['id']) ?>" method="POST" enctype="multipart/form-data">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Nama Petugas</label>
                        <input type="text" class="bg-oranye-1 rounded-md p-2 w-full" value="<?= esc($konsultan['nama']) ?>" readonly>
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
                    <button id="add-question" class="bg-oranye-2 text-white rounded-md px-4 py-2">TAMBAH PERTANYAAN</button>
                </div>
                <div class="flex flex-col items-center">
                    <button id="upload-button" type="button" class="bg-oranye-2 text-white rounded-md px-4 py-2 mb-4">PILIH GAMBAR</button>
                    <input type="file" id="file-input" name="dokumentasi" class="hidden" accept="image/*" />
                    <div id="image-box" class="bg-oranye-1 rounded-md p-8 flex flex-col items-center justify-center w-full">
                        <img 
                            id="uploaded-image" 
                            alt="Uploaded image" 
                            class="mb-4" 
                            src="<?= !empty($konsultasi['dokumentasi']) 
                                ? base_url('/assets/images/dokum/' . $konsultasi['dokumentasi']) 
                                : base_url('/assets/images/upload.png') ?>" 
                            style="display: <?= !empty($konsultasi['dokumentasi']) ? 'block' : 'none' ?>; width: 300px; height: auto;" 
                        />
                        <p id="upload-text" class="text-center">Upload Image</p>
                        <p id="upload-size-text" class="text-center text-sm">Ukuran gambar harus kurang dari <span class="font-semibold">2MB</span></p>
                    </div>
                </div>
            </div>
            <div class="flex justify-end mt-6 space-x-4">
                <button type="submit" class="bg-oranye-2 text-white rounded-md px-4 py-2" onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini?')">SIMPAN</button>
                <a href="/admin/consultation/detail/<?= $konsultasi['id'] ?>" class="bg-oranye-2 text-white rounded-md px-4 py-2">KEMBALI</a>
            </div>
        </form>
    </div>
</body>

</html>
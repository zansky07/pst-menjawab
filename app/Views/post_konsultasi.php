<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Detail Konsultasi Virtual</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const addQuestionButton = document.getElementById('add-question');
            const notulaContainer = document.getElementById('notula-container');
            const uploadButton = document.getElementById('upload-button');
            const fileInput = document.getElementById('file-input');

            addQuestionButton.addEventListener('click', () => {
                const questionGroup = document.createElement('div');
                questionGroup.classList.add('mb-4');

                const questionLabel = document.createElement('label');
                questionLabel.textContent = 'Pertanyaan';
                questionLabel.classList.add('block', 'text-gray-700', 'mb-1');

                const questionInput = document.createElement('textarea');
                questionInput.classList.add('block', 'w-full', 'mt-1', 'border-gray-300', 'rounded-md', 'shadow-sm');
                questionInput.placeholder = 'Tulis pertanyaan di sini';

                const answerLabel = document.createElement('label');
                answerLabel.textContent = 'Jawaban';
                answerLabel.classList.add('block', 'text-gray-700', 'mt-4', 'mb-1');

                const answerInput = document.createElement('textarea');
                answerInput.classList.add('block', 'w-full', 'mt-1', 'border-gray-300', 'rounded-md', 'shadow-sm');
                answerInput.placeholder = 'Tulis jawaban di sini';

                questionGroup.appendChild(questionLabel);
                questionGroup.appendChild(questionInput);
                questionGroup.appendChild(answerLabel);
                questionGroup.appendChild(answerInput);

                notulaContainer.appendChild(questionGroup);
            });

            uploadButton.addEventListener('click', () => {
                fileInput.click();
            });

            fileInput.addEventListener('change', (event) => {
                const file = event.target.files[0];
                if (file && file.size > 2 * 1024 * 1024) {
                    alert('Ukuran gambar harus kurang dari 2MB!');
                    fileInput.value = ""; // Reset file input
                } else {
                    alert('Gambar berhasil dipilih!');
                }
            });
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
                                    <a href="a/dmin/settings/consultant" class="text-sm hover:bg-gray-100 text-gray-700 block px-4 py-2">Konsultan</a>
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
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <div class="mb-4">
                    <label class="block text-gray-700">Nama Petugas</label>
                    <div class="bg-oranye-1 rounded-md p-2">Lala</div>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Nama Konsumen</label>
                    <div class="bg-oranye-1 rounded-md p-2">Lily</div>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Status</label>
                    <select class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                        <option>Selesai</option>
                    </select>
                </div>
                <div class="mb-4" id="notula-container">
                    <label class="block text-gray-700">Notula</label>
                    <div class="bg-oranye-1 rounded-md p-2 mb-2">Pertanyaan 1</div>
                    <div class="bg-oranye-1 rounded-md p-2 ml-4 mb-2">Jawaban pertanyaan 1</div>
                    <div class="bg-oranye-1 rounded-md p-2 mb-2">Pertanyaan 2</div>
                    <div class="bg-oranye-1 rounded-md p-2 ml-4 mb-2">Jawaban pertanyaan 2</div>
                </div>
                <button id="add-question" class="bg-oranye-2 text-white rounded-md px-4 py-2">TAMBAH PERTANYAAN</button>
            </div>
            <div class="flex flex-col items-center">
                <button id="upload-button" class="bg-oranye-2 text-white rounded-md px-4 py-2 mb-4">PILIH GAMBAR</button>
                <input type="file" id="file-input" class="hidden" accept="image/*" />
                <div class="bg-oranye-1 rounded-md p-8 flex flex-col items-center justify-center w-full">
                    <img alt="Upload icon" class="mb-4" height="100" src="<?= base_url('assets/images/upload.png') ?>" width="100" />
                    <p class="text-center">Upload Image</p>
                    <p class="text-center text-sm">Ukuran gambar harus kurang dari <span class="font-semibold">2MB</span></p>
                </div>
            </div>
        </div>
        <div class="flex justify-end mt-6 space-x-4">
            <button class="bg-oranye-2 text-white rounded-md px-4 py-2">SIMPAN</button>
            <button class="bg-oranye-2 text-white rounded-md px-4 py-2">KEMBALI</button>
            <button class="bg-oranye-2 text-white rounded-md px-4 py-2">EKSPOR PDF</button>
        </div>
    </div>
</body>

</html>
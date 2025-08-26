<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
    <title>Tambah Keyword</title>
    <link rel="icon" href="/assets/images/logo-pst.png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f2f1;
        }
    </style>
</head>

<body>
    <?php include 'header_admin.php';?>
    
    <div class="max-w-xl lg:max-w-3xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md" style="margin-top: 100px;">
        <h1 class="text-2xl font-bold mb-6">Tambah Keyword</h1>
        <?php if (session()->getFlashdata('errors')): ?>
            <div style="color: red;">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <p><?= esc($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form id="addForm" action="<?= base_url('/admin/manage/keyword/store') ?>" method="POST">
            <?= csrf_field() ?>
            <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <label class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Keyword</label>
                <input type="text" class="w-full px-3 py-2 bg-orange-100 border border-orange-300 rounded-md"
                    name="keyword"  id="keyword" placeholder="Masukkan Keyword" value="<?= old('keyword') ?>"  required>
            </div>
            <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <label class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Link tabel</label>
                <input type="text" class="w-full px-3 py-2 border bg-orange-100 border-orange-300 rounded-md"
                    name="link" id="link" placeholder="Masukkan URL" value="<?= old('link') ?>"  required>
            </div>
            <br>
            <div class="flex justify-end space-x-4">
                <a href="/admin/settings/keyword" id="kembali" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600">Kembali</a>
                <button type="submit" class="bg-orange-500 text-white py-2 px-4 rounded-md hover:bg-orange-600">Simpan </button>
            </div>
        </form>
    </div>
    
    <?php include 'footer.php';?>
    <script>
        document.getElementById('addForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(event.target);

            Swal.fire({
                title: 'Apakah data sudah benar?',
                text: "Pastikan semua data yang Anda masukkan sudah sesuai!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, kirim!',
                cancelButtonText: 'Periksa lagi'
            }).then((result) => {

                if (result.isConfirmed) {
                    fetch(event.target.action, {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: data.message,
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    window.location.href = '/admin/settings/keyword';
                                });
                            } else {
                                let errorMessages = Object.values(data.errors).join('<br>');
                                Swal.fire({
                                    title: 'Gagal!',
                                    html: errorMessages,
                                    icon: 'error',
                                    confirmButtonText: 'Perbaiki'
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Terjadi kesalahan server.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        });
                }
            });


        });
    </script>
</body>

</html>
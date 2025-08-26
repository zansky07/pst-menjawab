<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="/assets/images/logo-pst.png">
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    </style>
    <title>Detail Keyword</title>
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

    <?php include 'header_admin.php'; ?>

    <div class="max-w-xl lg:max-w-3xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md" style="margin-top: 100px;">
        <h1 class="text-2xl font-bold mb-6">Detail Keyword</h1>
        <form id="updateForm" action="<?= base_url('/admin/manage/keyword/update/' . $keyword['id']) ?>" method="POST">
        <?= csrf_field() ?>
        <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <label class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Keyword</label>
            <input type="text" class="w-full px-3 py-2 bg-orange-100 border border-orange-300 rounded-md"
                name="keyword" value="<?= esc($keyword['keyword']) ?>" required>
        </div>
        <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <label class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Link Tabel</label>
            <input type="text" class="w-full px-3 py-2 border bg-orange-100 border-orange-300 rounded-md"
                name="link" value="<?= esc($keyword['link']) ?>" required>
        </div>
        <br>
        <div class="flex justify-end space-x-4">
            <a href="/admin/settings/keyword" id="kembali" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600">Kembali</a>
            <button type="submit" class="bg-orange-500 text-white py-2 px-4 rounded-md hover:bg-orange-600">Edit </button>
        </div>
        </form>
    </div>
    <?php include 'footer.php'; ?>

    <script>
         document.getElementById('updateForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(event.target);

            Swal.fire({
                title: 'Apakah anda yakin ingin mengubah data?',
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
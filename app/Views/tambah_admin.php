<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
    <title>Tambah Admin</title>
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
        <h1 class="text-2xl font-bold mb-6">Tambah Admin</h1>
        <?php if (session()->getFlashdata('errors')): ?>
            <div style="color: red;">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <p><?= esc($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form id="addForm" action="<?= base_url('/admin/manage/store') ?>" method="POST">
            <?= csrf_field() ?>
            <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <label class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Username</label>
                <input type="text" class="w-full px-3 py-2 bg-orange-100 border border-orange-300 rounded-md"
                    name="username" value="<?= old('username') ?>" maxlength="20" required>
            </div>
            <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <label class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Nama</label>
                <input type="text" class="w-full px-3 py-2 border bg-orange-100 border-orange-300 rounded-md"
                    name="nama" value="<?= old('nama') ?>" maxlength="20" required>
            </div>
            <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <label
                    class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Email</label>
                <input type="email" class="w-full px-3 py-2 bg-orange-100 border border-orange-300 rounded-md"
                    name="email" value="<?= old('email') ?>" maxlength="50" required>
            </div>
            <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <label
                    class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Password</label>
                <input type="password" class="w-full px-3 py-2 bg-orange-100 border border-orange-300 rounded-md"
                    name="password" required>
            </div>
            <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <label
                    class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Whatsapp</label>
                <input type="text" class="w-full px-3 py-2 bg-orange-100 border border-orange-300 rounded-md"
                    name="whatsapp" value="<?= old('whatsapp') ?>" maxlength="20" required>
            </div>
            <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <label class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Role</label>
                <select name="role" class="w-full px-3 py-2 bg-orange-500 text-white border border-orange-300 rounded-md">
                    <option value="admin" <?= old('role') == 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="superadmin" <?= old('role') == 'superadmin' ? 'selected' : '' ?>>Superadmin</option>
                </select>
            </div>
            <br>
            <div class="flex justify-end space-x-4">
                <a href="/admin/settings/admin" id="kembali" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600">Kembali</a>
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
                                    window.location.href = '/admin/settings/admin';
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
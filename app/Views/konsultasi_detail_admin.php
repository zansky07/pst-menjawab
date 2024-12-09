<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Konsultasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-orange-100">
    <div class="max-w-xl lg:max-w-3xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6">Detail</h1>
        <form action="/admin/consultation/detail/update/<?= $konsultasi['id'] ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <label class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Nama
                    Konsumen</label>
                <input type="text" class="w-full px-3 py-2 bg-orange-100 border border-orange-300 rounded-md"
                    value="<?= esc($konsultasi['nama_konsumen']) ?>" readonly>
            </div>
            <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <label class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Alamat
                    Email</label>
                <input type="email" class="w-full px-3 py-2 border bg-orange-100 border-orange-300 rounded-md"
                    value="<?= esc($konsultasi['email_konsumen']) ?>" readonly>
            </div>
            <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <label
                    class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Topik</label>
                <input type="text" class="w-full px-3 py-2 bg-orange-100 border border-orange-300 rounded-md"
                    value="<?= esc($konsultasi['topik']) ?>" readonly>
            </div>
            <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <label
                    class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Kategori</label>
                <input type="text" class="w-full px-3 py-2 bg-orange-100 border border-orange-300 rounded-md"
                    value="<?= esc($konsultasi['kategori']) ?>" readonly>
            </div>
            <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <label
                    class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Lingkup</label>
                <input type="text" class="w-full px-3 py-2 bg-orange-100 border border-orange-300 rounded-md"
                    value="<?= esc($konsultasi['lingkup']) ?>" readonly>
            </div>
            <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <label
                    class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Deskripsi</label>
                <textarea class="w-full px-3 py-2 bg-orange-100 border border-orange-300 rounded-md"
                    readonly><?= esc($konsultasi['deskripsi']) ?></textarea>
            </div>
            <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <label
                    class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Status</label>
                <select name="status_konsultasi"
                    class="w-full px-3 py-2 bg-orange-500 text-white border border-orange-300 rounded-md">
                    <?php $status_konsultasies = ['Pending', 'Disetujui', 'Ditolak', 'Selesai'];
                    foreach ($status_konsultasies as $status_konsultasi) {
                        $selected = ($status_konsultasi == $konsultasi['status_konsultasi']) ? 'selected' : '';
                        echo "<option value=\"$status_konsultasi\" $selected>$status_konsultasi</option>";
                    } ?>
                </select>
            </div>
            <button type="submit"
                class="w-full bg-orange-500 text-white py-2 rounded-md hover:bg-orange-600">Simpan</button>
            <?php if ($konsultasi['status_konsultasi'] === 'Disetujui'): ?>
                <a href="/admin/consultation/schedule/<?= $konsultasi['id'] ?>" class="schedule-button">Jadwalkan
                    Konsultasi</a>
            <?php endif; ?>
            <a href="/admin/dashboard" class="block text-center mt-4 text-red-500">Kembali</a>
        </form>
    </div>
</body>

</html>
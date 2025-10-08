<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PST Menjawab | Status Reservasi</title>
    <link rel="icon" href="/assets/images/logo-pst.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/form.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>

    <!-- Tambahkan CSP untuk perlindungan ekstra -->
    <meta http-equiv="Content-Security-Policy" content="default-src 'self' https://cdn.tailwindcss.com https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; img-src 'self'; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdn.jsdelivr.net; script-src 'self' https://cdn.tailwindcss.com https://cdn.jsdelivr.net;">
</head>

<body class="bg-oranye-1 mt-28 md:mt-16">
    <?php include 'header_user.php'; ?>

    <div class="max-w-lg mx-auto rounded-lg shadow-lg mt-20">
        <form action="/consultation/status" method="get">
            <!-- Token CSRF -->
            <?= csrf_field() ?>

            <div class="flex items-center mb-4">
                <input
                    type="text"
                    id="token"
                    name="token"
                    class="bg-white flex-grow p-2 border border-gray-300 rounded-l-md"
                    placeholder="Masukkan Token Anda"
                    value="<?= esc(old('token')) ?>"
                    required>
                <button
                    type="submit"
                    class="bg-orange-500 text-white py-2 px-4 rounded-r-md hover:bg-orange-600">
                    Cari
                </button>
            </div>
        </form>
    </div>

    <div class="max-w-lg mx-auto rounded-lg shadow-lg mt-10">
        <?php if (session()->getFlashdata('error')): ?>
            <div class="mb-4 p-2 bg-red-100 text-red-700 rounded">
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php endif; ?>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>

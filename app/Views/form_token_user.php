<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PST Menjawab | Status Reservasi</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link href="<?= base_url('assets/css/form.css') ?>" rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
    </head>
    <body class="bg-orange-100">
        <div class="max-w-lg mx-auto rounded-lg shadow-lg mt-10">
            <form action="/consultation/status" method="post">
                <div class="flex items-center mb-4">
                    <input 
                        type="text" 
                        id="token" 
                        name="token" 
                        class="bg-white flex-grow p-2 border border-gray-300 rounded-l-md" 
                        placeholder="Masukkan Token Anda" 
                        value="<?= old('token') ? esc(old('token')) : '' ?>" 
                        required>
                    <button type="submit" class="bg-orange-500 text-white py-2 px-4 rounded-r-md hover:bg-orange-600">Cari</button>
                </div>

            </form>
        </div>

        <div class="max-w-lg mx-auto rounded-lg shadow-lg mt-10">
                <?php if (session()->getFlashdata('error')): ?> 
                    <div class="mb-4 p-2 bg-red-100 text-red-700 rounded"> 
                        <?= session()->getFlashdata('error') ?> 
                    </div> 
                <?php endif; ?>
        </div>
        
    </body>
</html>

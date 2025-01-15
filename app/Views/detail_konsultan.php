<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Detail Konsultan</title>
        <link rel="icon" href="/assets/images/logo-pst.png">
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">`
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f9f2f1;
            }
        </style>
    </head>
    <body>

        <?php include 'header_admin.php';?>

        <div class="max-w-xl lg:max-w-3xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md" style="margin-top: 100px;">
            <h1 class="text-2xl font-bold mb-6">Detail Konsultan</h1>
                <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <label class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Nama</label>
                    <input type="text" class="w-full px-3 py-2 border bg-orange-100 border-orange-300 rounded-md"
                    name="nama" value="<?= esc($konsultan['nama']) ?>" readonly>
                </div>
                <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <label
                        class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Email</label>
                    <input type="email" class="w-full px-3 py-2 bg-orange-100 border border-orange-300 rounded-md"
                    name="email" value="<?= esc($konsultan['email']) ?>" readonly>
                </div>
                <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <label
                        class="block text-gray-700 font-bold mb-2 md:mb-0 md:col-span-1 md:flex md:items-center">Whatsapp</label>
                    <input type="text" class="w-full px-3 py-2 bg-orange-100 border border-orange-300 rounded-md"
                    name="whatsapp"  value="<?= esc($konsultan['whatsapp']) ?>" readonly>
                </div>
                <br>
                <div class="flex justify-end space-x-4">
                    <a href="/admin/settings/consultant" id="kembali" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600">Kembali</a>
                    <!-- <button type="submit" class="bg-orange-500 text-white py-2 px-4 rounded-md hover:bg-orange-600">Edit </button> -->
                </div>
            </form>
        </div>

        <?php include 'footer.php';?>

        <script>
                document.getElementById('filterBtn').addEventListener('click', function() {
                    document.getElementById('filterModal').classList.remove('hidden');
                });
                document.getElementById('closeModalBtn').addEventListener('click', function() {
                    document.getElementById('filterModal').classList.add('hidden');
                });
            </script>
    </body>
</html>
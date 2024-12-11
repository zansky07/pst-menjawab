<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
    <style>
        .form-container {
            z-index: 10;
        }
        #footer {
            z-index: 5;
        }
    </style>
</head>
<body class="bg-orange-100 flex flex-col min-h-screen relative">
    <div class="flex-grow flex items-center justify-center form-container">
        <div class="w-full max-w-md">
            <div class="bg-white shadow-md rounded-lg p-6 mt-20">
                <div class="text-center">
                    <a href="/">
                        <img src="/assets/images/logo-pst.png" alt="Logo" class="h-10 w-10 mx-auto mb-2">
                    </a>
                    <h2 class="text-2xl font-bold text-gray-700 mb-6">Login</h2>
                    <?php if (session()->getFlashdata('error')): ?>
                        <p style="color: red;"><?= session()->getFlashdata('error') ?></p>
                    <?php endif; ?>
                </div>
                <form action="/admin/login/submit" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-4">
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                        <input type="text" id="username" name="username" 
                            class="bg-orange-100 w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-600 focus:border-orange-500" 
                            placeholder="Enter your username" required>
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" id="password" name="password" 
                            class="bg-orange-100 w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-600 focus:border-orange-500" 
                            placeholder="Enter your password" required>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" 
                            class="bg-orange-600 hover:bg-orange-800 text-white font-medium py-2 px-6 rounded-lg transition duration-200">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="relative mt-10" id="footer">
        <img src="/assets/images/footer.png" alt="footer" class="w-full">
        <div class="absolute inset-0 flex flex-col items-center justify-end text-white text-center px-5 text-lg pb-12">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center w-full max-w-6xl mb-8 space-y-6 md:space-y-0 md:space-x-8">
                <div class="w-full md:w-1/3 text-left">
                    <div class="flex items-center space-x-4">
                        <img src="/assets/images/logo-pst.png" alt="Logo" class="h-12 w-12">
                        <h3 class="text-xl font-semibold">Badan Pusat Statistik Provinsi DKI Jakarta</h3>
                    </div>
                    <p class="mt-4 text-base">
                        Jl. Salemba Tengah No. 36-38 Paseban Senen Jakarta Pusat<br>
                        <span>Phone (021) 31928493</span><br>
                        <span>Fax. (021) 3152004</span><br>
                        <span>E-mail: bps3100@bps.go.id</span>
                    </p>
                </div>
                <div class="w-full md:w-1/3 text-left">
                    <h4 class="text-xl font-semibold">Website Lainnya:</h4>
                    <ul class="list-none text-base">
                        <li><a href="https://www.bps.go.id" class="underline">Website BPS Indonesia</a></li>
                        <li><a href="https://jakarta.bps.go.id" class="underline">Website BPS Provinsi DKI Jakarta</a></li>
                        <li><a href="https://pst.bps.go.id" class="underline">Website Pelayanan Statistik Terpadu</a></li>
                        <li><a href="https://silastik.bps.go.id" class="underline">Website SILASTIK</a></li>
                    </ul>
                </div>
                <div class="w-full md:w-1/3 text-left">
                    <h4 class="text-xl font-semibold">Sosial Media:</h4>
                    <ul class="list-none text-base">
                        <li><a href="https://www.facebook.com/bpsdkijakarta/" class="underline">Facebook</a></li>
                        <li><a href="https://x.com/bpsdkijakarta/" class="underline">Twitter</a></li>
                        <li><a href="https://www.instagram.com/bpsdkijakarta/" class="underline">Instagram</a></li>
                        <li><a href="https://www.youtube.com/c/BPSDKI" class="underline">YouTube</a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-6 text-sm">
                &copy; 2024 Badan Pusat Statistik Provinsi DKI Jakarta. All rights reserved.
            </div>
        </div>
    </div>
</body>
</html>

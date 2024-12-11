<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com">  </script>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">`
</head>
<body class="bg-orange-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md">
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="text-center">
                <img src="logo.png" alt="Logo" class="w-20 mx-auto mb-4">
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
        <footer class="text-center mt-6 text-sm text-gray-500">
            &copy; 2024 Your Company. All rights reserved.
        </footer>
</body>
</html>

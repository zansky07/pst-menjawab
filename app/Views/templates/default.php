<!-- app/Views/templates/default.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PST Menjawab BPS Provinsi DKI Jakarta</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body class="bg-orange-100">
    <!-- Header/Navbar -->
    <nav class="bg-orange-100 shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <img class="h-8 w-auto" src="/images/logo.png" alt="Logo">
                    </div>
                    <div class="hidden md:ml-6 md:flex md:space-x-8">
                        <a href="/admin/dashboard" class="inline-flex items-center px-1 pt-1 text-gray-900">Dashboard</a>
                        <a href="/admin/statistics" class="inline-flex items-center px-1 pt-1 text-gray-500 hover:text-gray-900">Statistik</a>
                        <a href="/admin/settings" class="inline-flex items-center px-1 pt-1 text-gray-500 hover:text-gray-900">Pengaturan</a>
                    </div>
                </div>
                <div class="flex items-center">
                    <a href="/admin/logout" class="text-gray-500 hover:text-gray-900">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-orange-100">
            <?= $this->renderSection('content') ?>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-orange-100">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 bg-orange-100">
            <p class="text-center text-gray-500 text-sm">
                © 2024 BPS Provinsi DKI Jakarta. All rights reserved.
            </p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>

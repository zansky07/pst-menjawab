<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Admin dan Konsultan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-orange-100 min-h-screen flex flex-col">
    <!-- Header -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-wrap justify-between h-16 items-center">
                <div class="flex items-center">
                    <img src="/images/logo.png" alt="Logo" class="h-8 w-auto">
                    <span class="ml-2 text-gray-900 font-medium text-sm md:text-base">
                        PST Menjawab BPS Provinsi DKI Jakarta
                    </span>
                </div>
                <div class="flex items-center space-x-4 mt-2 md:mt-0">
                    <a class="nav-link text-sm md:text-base hover:text-orange-500" href="/admin/dashboard">Dashboard</a>
                    <a class="nav-link text-sm md:text-base hover:text-orange-500" href="/admin/statistics">Statistik</a>
                    
                    <!-- Dropdown Pengaturan -->
                    <div class="relative group">
                        <button 
                            class="nav-link flex items-center space-x-1 text-sm md:text-base hover:text-orange-500 transition duration-200">
                            <span>Pengaturan</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" 
                                    d="M5.23 7.21a.75.75 0 011.06 0L10 10.92l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 010-1.06z" 
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <!-- Dropdown Menu -->
                        <div 
                            class="absolute hidden group-hover:block right-0 mt-0 bg-white border border-gray-200 rounded-lg shadow-lg w-40 z-10">
                            <a href="/admin/settings/admin" 
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100 text-sm md:text-base">Admin</a>
                            <a href="/admin/settings/consultant" 
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100 text-sm md:text-base">Konsultan</a>
                        </div>
                    </div>
                    <a class="nav-link text-sm md:text-base hover:text-orange-500" href="/admin/logout">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-1 container mx-auto px-4 py-6">
        <div class="flex flex-wrap justify-between items-center mb-4">
            <h1 class="text-xl md:text-2xl font-bold text-gray-700">Daftar Konsultan</h1>
            <a href="/admin/consultant/add" 
                class="bg-orange-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-orange-600 transition duration-200 text-sm md:text-base">
                Tambah Konsultan
            </a>
        </div>

        <!-- Table -->
        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="w-full">
                <thead class="bg-orange-600 text-center">
                    <tr class="text-white text-sm md:text-base">
                        <th class="py-3 px-4">Nama</th>
                        <th class="py-3 px-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-left">
                    <?php if (!empty($konsultans) && is_array($konsultans)): ?>
                        <?php foreach ($konsultans as $konsultan): ?>
                            <tr class="border-b">
                                <td class="py-3 px-4 text-sm md:text-base"><?= esc($konsultan['nama']) ?></td>
                                <td class="py-3 px-4 text-center">
                                    <a href="/admin/consultant/detail/<?= $konsultan['id'] ?>" 
                                        class="bg-green-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-green-600 transition duration-200 text-sm md:text-base">
                                        Detail
                                    </a>
                                    <a onclick="confirmDelete('/admin/consultant/delete/<?= $konsultan['id'] ?>')" 
                                        class="bg-red-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-red-600 transition duration-200 ml-2 text-sm md:text-base">
                                        Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2" class="py-3 px-4 text-center text-sm md:text-base">Tidak ada data.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-200 text-center py-4">
        <p class="text-xs md:text-sm text-gray-600">&copy; 2024 Your Company. All rights reserved.</p>
    </footer>

    <script>
        // Fungsi untuk konfirmasi penghapusan
        function confirmDelete(url) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }
    </script>
</body>
</html>

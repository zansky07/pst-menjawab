<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PST Menjawab | Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f2f1;
        }
    </style>
</head>
<body class="bg-oranye-1 mt-28 md:mt-16">
<nav class="bg-white shadow shadow-gray-300 fixed top-0 left-0 w-full px-8 z-50">
			<div class="md:h-16 h-28 mx-auto md:px-4 container flex items-center justify-between flex-wrap md:flex-nowrap">
				<div class="flex items-center space-x-4">
					<img src="/assets/images/logo-pst.png" alt="Logo" class="h-10 w-10">
					<span class="text-gray-800 font-semibold text-sm md:text-base"> PST Menjawab BPS Provinsi DKI Jakarta </span>
				</div>
				<div class="text-gray-500 order-3 w-full md:w-auto md:order-2">
					<ul class="flex font-semibold items-center justify-between space-x-4">
						<li class="hover:text-indigo-400">
							<a href="/admin/dashboard">Dashboard</a>
						</li>
						<li class="hover:text-indigo-400">
							<a href="/admin/statistics">Statistik</a>
						</li>
						<li class="relative">
							<button id="dropdownNavbarLink" class="text-gray-700 hover:bg-gray-50 md:hover:bg-transparent py-2 md:hover:text-blue-700 flex items-center"> Pengaturan <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
								</svg>
							</button>
							<div id="dropdownNavbar" class="hidden absolute bg-white text-base z-10 list-none divide-y divide-gray-100 rounded shadow mt-2 w-44">
								<ul class="py-1">
									<li>
										<a href="admin/settings" class="text-sm hover:bg-gray-100 text-gray-700 block px-4 py-2">Admin</a>
									</li>
									<li>
										<a href="admin/settings" class="text-sm hover:bg-gray-100 text-gray-700 block px-4 py-2">Konsultan</a>
									</li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
				<div class="order-2 md:order-3">
					<button class="px-4 py-2 bg-oranye-3 hover:bg-oranye-4 text-white rounded-xl flex items-center gap-2">
						<span>
							<a href="/admin/logout">Keluar</a>
						</span>
					</button>
				</div>
			</div>
		</nav>

    <div class="container mx-auto p-6">
        <?php if (session()->getFlashdata('message')): ?>
            <p class="text-green-500"><?= session()->getFlashdata('message') ?></p>
        <?php endif; ?>

        <!-- Filter Button -->
        <div class="flex justify-end mb-4">
            <button id="filterBtn" class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded-full">Filter</button>
        </div>

        <!-- Filter Modal -->
        <div id="filterModal" class="fixed inset-0 hidden bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                <h2 class="text-2xl font-bold mb-4">Filter</h2>
                <form action="/admin/dashboard/filter" method="post" id="filterForm">
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select id="status" name="status" class="block w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none">
                            <option value="">All</option>
                            <option value="Sedang diproses">Sedang diproses</option>
                            <option value="Disetujui">Disetujui</option>
                            <option value="Ditolak">Ditolak</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" id="closeModalBtn" class="bg-gray-500 text-white py-2 px-4 rounded-full transition duration-300 hover:bg-gray-600 mr-2">Close</button>
                        <button type="submit" class="bg-orange-500 text-white py-2 px-4 rounded-full transition duration-300 hover:bg-orange-600">Apply</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="table-container">
                <table class="min-w-full bg-white">
                    <thead class="bg-orange-600 text-white">
                        <tr>
                            <th class="py-3 px-5 text-lg">Token</th>
                            <th class="py-3 px-5 text-lg">Topik</th>
                            <th class="py-3 px-5 text-lg">Status</th>
                            <th class="py-3 px-5 text-lg">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($requests) && is_array($requests)): ?>
                            <?php foreach ($requests as $request): ?>
                                <tr class="border-b">
                                    <td class="py-2 px-4"><?= esc($request['token_konsultasi']) ?></td>
                                    <td class="py-2 px-4"><?= esc($request['topik']) ?></td>
                                    <td class="py-2 px-4"><?= esc($request['status_konsultasi']) ?></td>
                                    <td class="py-2 px-4">
                                        <div class="flex justify-around">
                                            <a href="/admin/consultation/detail/<?= $request['id'] ?>" class="bg-green-500 text-white py-1 px-2 rounded-full w-full text-center mx-1 text-sm transition duration-300 hover:bg-green-600">Detail</a>
                                            <a href="/admin/consultation/delete/<?= $request['id'] ?>" class="bg-red-500 text-white py-1 px-2 rounded-full w-full text-center mx-1 text-sm transition duration-300 hover:bg-red-600">Hapus</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="py-2 px-4">Tidak ada data.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-4 bg-white border-t flex justify-center items-center">
                <div class="flex justify-center items-center space-x-2">
                    <?php if ($pager): ?>
                        <?= $pager->links('default', 'tailwind_full') ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="relative">
			<img src="/assets/images/footer.png" alt="footer" class="w-full">
			<div class="absolute inset-0 flex flex-col items-center justify-end text-white text-center px-5 text-lg pb-12">
				<div class="flex justify-between items-center w-full max-w-6xl mb-8 space-x-8">>
					<div class="w-1/3 text-left">
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
					<div class="w-1/3 text-left">
						<h4 class="text-xl font-semibold">Website Lainnya:</h4>
						<ul class="list-none text-base">
							<li><a href="https://www.bps.go.id" class="underline">Website BPS Indonesia</a></li>
							<li><a href="https://jakarta.bps.go.id" class="underline">Website BPS Provinsi DKI Jakarta</a></li>
							<li><a href="https://pst.bps.go.id" class="underline">Website Pelayanan Statistik Terpadu</a></li>
							<li><a href="https://silastik.bps.go.id" class="underline">Website SILASTIK</a></li>
						</ul>
					</div>
					<div class="w-1/3 text-left">
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

    <script>
        document.getElementById('dropdownNavbarLink').addEventListener('click', function() {
			const dropdown = document.getElementById('dropdownNavbar');
			dropdown.classList.toggle('hidden');
		});
        document.getElementById('filterBtn').addEventListener('click', function() {
            document.getElementById('filterModal').classList.remove('hidden');
        });

        document.getElementById('closeModalBtn').addEventListener('click', function() {
            document.getElementById('filterModal').classList.add('hidden');
        });
    </script>
</body>
</html>

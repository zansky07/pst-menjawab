<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Admin dan Konsultan</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f2f1;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            padding: 20px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f04e30;
            color: #fff;
        }
        .btn {
            padding: 5px 10px;
            border: none;
            color: #fff;
            cursor: pointer;
            border-radius: 4px;
        }
        .btn-detail {
            background-color: #28a745;
        }
        .btn-delete {
            background-color: #dc3545;
        }
        .btn:hover {
            opacity: 0.8;
        }
        .section {
            margin-top: 40px;
        }
        .btn-add {
            background-color: #007bff;
            margin-bottom: 10px;
        }
    </style>
</head>
<body class="mt-28 md:mt-16  bg-oranye-1" >
<nav class="bg-white shadow shadow-gray-300 fixed top-0 left-0 w-full px-8 z-50">
			<div class="md:h-16 h-28 mx-auto md:px-4 container flex items-center justify-between flex-wrap md:flex-nowrap">
				<div class="flex items-center space-x-4">
					<img src="/assets/images/logo-pst.png" alt="Logo" class="h-10 w-10">
					<span class="text-gray-800 font-semibold text-sm md:text-base"> PST Menjawab BPS Provinsi DKI Jakarta </span>
				</div>
				<div class="text-oranye-4 order-3 w-full md:w-auto md:order-2">
					<ul class="flex font-semibold items-center justify-between space-x-4">
						<li class="hover:text-oranye-2">
							<a href="/admin/dashboard">Dashboard</a>
						</li>
						<li class="hover:text-oranye-2">
							<a href="/admin/statistics">Statistik</a>
						</li>
						<li class="relative">
							<button id="dropdownNavbarLink" class="text-hover:bg-oranye-4 md:hover:bg-transparent py-2 md:hover:text-oranye-2 flex items-center"> Pengaturan <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
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
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/dashboard">Dashboard</a>
                        </li>    
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/statistics">Statistik</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/settings">Pengaturan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/logout">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <?php if (session()->getFlashdata('message')): ?>
                <p style="color: green;"><?= session()->getFlashdata('message') ?></p>
        <?php endif; ?>
        <h1 class="header">Daftar Admin</h1>
        <a href="/admin/manage/add" class="btn btn-add">Tambah Admin</a>
        <table>
            <thead>
                <tr>
                    <th>Nama Admin</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($admins) && is_array($admins)): ?>
                    <?php foreach ($admins as $admin): ?>
                        <tr>
                            <td><?= esc($admin['nama']) ?></td>
                            <td>
                                <a href="/admin/manage/detail/<?= $admin['id'] ?>" class="btn btn-detail">Detail</a>
                                <a href="/admin/manage/delete/<?= $admin['id'] ?>" class="btn btn-delete">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2">Tidak ada data admin.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        
        <div class="section">
            <h1 class="header">Daftar Konsultan</h1>
            <a href="/admin/consultant/add" class="btn btn-add">Tambah Konsultan</a>
            <table>
                <thead>
                    <tr>
                        <th>Nama Konsultan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($konsultans) && is_array($konsultans)): ?>
                        <?php foreach ($konsultans as $konsultan): ?>
                            <tr>
                                <td><?= esc($konsultan['nama']) ?></td>
                                <td>
                                    <a href="/admin/consultant/detail/<?= $konsultan['id'] ?>" class="btn btn-detail">Detail</a>
                                    <a href="/admin/consultant/delete/<?= $konsultan['id'] ?>" class="btn btn-delete">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2">Tidak ada data konsultan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="relative" id="footer">
			<img src="/assets/images/footer.png" alt="footer" class="w-full">
			<div class="absolute inset-0 flex flex-col items-center justify-end text-white text-center px-5 text-lg pb-12">
				<div class="flex justify-between items-center w-full max-w-6xl mb-8 space-x-8">> <div class="w-1/3 text-left">
						<div class="flex items-center space-x-4">
							<img src="/assets/images/logo-pst.png" alt="Logo" class="h-12 w-12">
							<h3 class="text-xl font-semibold">Badan Pusat Statistik Provinsi DKI Jakarta</h3>
						</div>
						<p class="mt-4 text-base">Jl. Salemba Tengah No. 36-38 Paseban Senen Jakarta Pusat <br>
							<span>Phone (021) 31928493</span>
							<br>
							<span>Fax. (021) 3152004</span>
							<br>
							<span>E-mail: bps3100@bps.go.id</span>
						</p>
					</div>
					<div class="w-1/3 text-left">
						<h4 class="text-xl font-semibold">Website Lainnya:</h4>
						<ul class="list-none text-base">
							<li>
								<a href="https://www.bps.go.id" class="underline">Website BPS Indonesia</a>
							</li>
							<li>
								<a href="https://jakarta.bps.go.id" class="underline">Website BPS Provinsi DKI Jakarta</a>
							</li>
							<li>
								<a href="https://pst.bps.go.id" class="underline">Website Pelayanan Statistik Terpadu</a>
							</li>
							<li>
								<a href="https://silastik.bps.go.id" class="underline">Website SILASTIK</a>
							</li>
						</ul>
					</div>
					<div class="w-1/3 text-left">
						<h4 class="text-xl font-semibold">Sosial Media:</h4>
						<ul class="list-none text-base">
							<li>
								<a href="https://www.facebook.com/bpsdkijakarta/" class="underline">Facebook</a>
							</li>
							<li>
								<a href="https://x.com/bpsdkijakarta/" class="underline">Twitter</a>
							</li>
							<li>
								<a href="https://www.instagram.com/bpsdkijakarta/" class="underline">Instagram</a>
							</li>
							<li>
								<a href="https://www.youtube.com/c/BPSDKI" class="underline">YouTube</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="mt-6 text-sm"> &copy; 2024 Badan Pusat Statistik Provinsi DKI Jakarta. All rights reserved. </div>
			</div>
		</div>
</body>
</html>

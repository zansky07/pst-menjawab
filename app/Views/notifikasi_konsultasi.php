<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirim Notifikasi</title>
    <link rel="icon" href="/assets/images/logo-pst.png">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>

<style>
    @media (max-width: 768px) {

        /* Gaya CSS untuk perangkat seluler */
        .space-y-4 {
            display: flex;
            flex-direction: column;
        }

        .space-y-4>div {
            margin-bottom: 1rem;
        }

        .flex {
            flex-direction: column;
        }

        .flex>input {
            margin-bottom: 0.5rem;
        }

        .flex>button {
            width: 100%;
            margin-top: 0.5rem;
            margin-bottom: 1rem;
        }

        .justify-end {
            justify-content: center;
            flex-direction: column;
            align-items: stretch;
        }

        .justify-end>* {
            margin-bottom: 1rem;
        }

        .space-x-4>* {
            margin-bottom: 1rem;
            /* Tambahkan margin bawah pada tombol */
        }
    }
</style>

<body class="bg-oranye-1 mt-28 md:mt-16" >
    <div class="flex overflow-hidden flex-col pt-8 ">
        <div class="flex z-10 flex-col px-10 w-full max-md:px-5 max-md:max-w-full">
            <!-- Header/Navbar -->
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
										<a href="/admin/settings/admin" class="text-sm hover:bg-gray-100 text-gray-700 block px-4 py-2">Admin</a>
									</li>
									<li>
										<a href="/admin/settings/consultant" class="text-sm hover:bg-gray-100 text-gray-700 block px-4 py-2">Konsultan</a>
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

            <body class="bg-oranye-1">
                <div class="max-w-7xl mx-auto py-10 px-4">
                    <div class="bg-white rounded-lg shadow-lg p-8">
                        <h2 class="text-2xl font-bold mb-6">Kirim Notifikasi</h2>

                        <form action="<?= base_url('admin/consultation/notification/send/' . $konsultasi['id']) ?>"
                            method="post">
                            <input type="hidden" name="konsultasi_id" value="<?= $konsultasi['id'] ?>">
                            <input type="hidden" name="recipient" value="konsumen">
                            <input type="hidden" name="notification_type" value="both">

                            <!-- Konsultan Section -->
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Nama Konsultan</label>
                                    <input type="text"
                                        value="<?= isset($konsultan['nama']) ? esc($konsultan['nama']) : '' ?>"
                                        class="w-full border border-gray-300 rounded-md px-4 py-2 bg-oranye-1" readonly>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-2">Alamat Email
                                            Konsultan</label>
                                        <div class="flex gap-2">
                                            <input type="email"
                                                value="<?= isset($konsultan['email']) ? esc($konsultan['email']) : '' ?>"
                                                class="flex-1 border border-gray-300 rounded-md px-4 py-2 bg-oranye-1"
                                                readonly>
                                            <button type="button"
                                                class="bg-orange-500 text-white px-4 py-2 rounded-md hover:bg-orange-600">
                                                Kirim Notifikasi Email
                                            </button>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-gray-700 font-medium mb-2">Nomor WA Konsultan</label>
                                        <div class="flex gap-2">
                                            <input type="text"
                                                value="<?= isset($konsultan['whatsapp']) ? esc($konsultan['whatsapp']) : '' ?>"
                                                class="flex-1 border border-gray-300 rounded-md px-4 py-2 bg-oranye-1"
                                                readonly>
                                            <button type="button"
                                                class="bg-orange-500 text-white px-4 py-2 rounded-md hover:bg-orange-600">
                                                Kirim Notifikasi WhatsApp
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Link Zoom</label>
                                <input type="text"
                                    value="<?= isset($konsultasi['link_zoom']) ? esc($konsultasi['link_zoom']) : '' ?>"
                                    class="w-full border border-gray-300 rounded-md px-4 py-2 bg-oranye-1" readonly>
                            </div>

                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Jadwal Konsultasi</label>
                                <input type="text"
                                    value="<?= isset($konsultasi['jadwal_konsultasi']) ? esc($konsultasi['jadwal_konsultasi']) : '' ?>"
                                    class="w-full border border-gray-300 rounded-md px-4 py-2 bg-oranye-1" readonly>
                            </div>

                            <br>

                            <!-- Action Buttons -->
                            <div class="flex justify-end space-x-1">
                                <a href="<?= base_url('admin/consultation/detail/' . $konsultasi['id']) ?>"
                                    class="bg-gray-700 text-white px-6 py-3 rounded-md font-semibold hover:bg-gray-800 text-center">
                                    Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
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
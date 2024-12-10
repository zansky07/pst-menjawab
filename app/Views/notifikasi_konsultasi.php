<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirim Notifikasi</title>

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

<body>
    <div class="flex overflow-hidden flex-col pt-8 bg-oranye-1">
        <div class="flex z-10 flex-col px-10 w-full max-md:px-5 max-md:max-w-full">
            <!-- Header/Navbar -->
            <nav class="flex flex-wrap gap-5 justify-between py-2 pr-20 pl-9 max-w-full text-xl bg-white bg-opacity-80 rounded-[50px] w-[1358px] max-md:px-5 max-md:mr-0.5 max-md:flex-col max-md:items-center"
                role="navigation" aria-label="Main Navigation">
                <div class="flex gap-5 text-black max-md:flex-col max-md:items-center">
                    <img src="/assets/images/logo-pst.png" class="object-contain shrink-0 aspect-[0.8] w-[43px]"
                        alt="BPS Logo" />
                    <div class="flex-auto my-auto max-md:text-center">PST Menjawab BPS Provinsi DKI Jakarta</div>
                </div>
                <div
                    class="flex gap-10 my-auto whitespace-nowrap max-md:flex-col max-md:items-center max-md:gap-4 max-md:mt-4">
                    <a href="/admin/dashboard"
                        class="text-black hover:text-red-400 focus:outline-none focus:ring-2 focus:ring-red-400 rounded-md"
                        tabindex="0">Dashboard</a>
                    <a href="/admin/statistics"
                        class="text-black hover:text-red-400 focus:outline-none focus:ring-2 focus:ring-red-400 rounded-md"
                        tabindex="0">Statistik</a>
                    <a href="/admin/settings"
                        class="text-black hover:text-red-400 focus:outline-none focus:ring-2 focus:ring-red-400 rounded-md"
                        tabindex="0">Pengaturan</a>
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

                            <!-- Konsumen Section -->
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Nama Konsumen</label>
                                    <input type="text"
                                        value="<?= isset($konsultasi['nama_konsumen']) ? esc($konsultasi['nama_konsumen']) : '' ?>"
                                        class="w-full border border-gray-300 rounded-md px-4 py-2 bg-oranye-1" readonly>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-2">Alamat Email
                                            Konsumen</label>
                                        <div class="flex gap-2">
                                            <input type="email"
                                                value="<?= isset($konsultasi['email_konsumen']) ? esc($konsultasi['email_konsumen']) : '' ?>"
                                                class="flex-1 border border-gray-300 rounded-md px-4 py-2 bg-oranye-1"
                                                readonly>
                                            <button type="button"
                                                class="bg-orange-500 text-white px-4 py-2 rounded-md hover:bg-orange-600">
                                                Kirim Notifikasi Email
                                            </button>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-gray-700 font-medium mb-2">Nomor WA Konsumen</label>
                                        <div class="flex gap-2">
                                            <input type="text"
                                                value="<?= isset($konsultasi['no_wa_konsumen']) ? esc($konsultasi['no_wa_konsumen']) : '' ?>"
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
                                <button type="submit" href="<?= base_url('admin/dashboard') ?>"
                                    class="bg-orange-500 text-white px-6 py-3 rounded-md font-semibold hover:bg-orange-700 text-center">
                                    Simpan
                                </button>
                                <a href="<?= base_url('admin/consultation/schedule/' . $konsultasi['id']) ?>"
                                    class="bg-gray-700 text-white px-6 py-3 rounded-md font-semibold hover:bg-gray-800 text-center">
                                    Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
    </div>

    <footer class="bg-oranye-1 mt-10">
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
    </footer>
</body>

</html>
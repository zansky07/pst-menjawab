<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PST Menjawab | Survei Kepuasan Konsumen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="<?= base_url('assets/css/styles.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/form.css') ?>" rel="stylesheet">
</head>
<body class="bg-oranye-1 mt-28 md:mt-16">
        <nav class="bg-white shadow shadow-gray-300 fixed top-0 left-0 w-full px-8 z-50">
			<div class="md:h-16 h-28 mx-auto md:px-4 container flex items-center justify-between flex-wrap md:flex-nowrap">
				<div class="flex items-center space-x-4">
					<img src="/assets/images/logo-pst.png" alt="Logo" class="h-10 w-10">
					<span class="text-gray-800 hover:text-oranye-2 font-semibold text-sm md:text-base"><a href="/"> PST Menjawab BPS Provinsi DKI Jakarta </a></span>
				</div>
				<div class="text-oranye-4 order-3 w-full md:w-auto md:order-2">
					<ul class="flex font-semibold items-center justify-between space-x-4">
						<li class="hover:text-oranye-2">
							<a href="/consultation">Konsultasi</a>
						</li>
						<li class="hover:text-oranye-2">
							<a href="/chatbot">Chatbot</a>
						</li>
						<li class="hover:text-oranye-2">
							<a href="/consultation/checkReservation">Cek Reservasi</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
    <!-- Judul di luar kotak -->
    <div class="text-center mt-7 mb-7">
        <h2 class="text-3xl font-bold mb-4 text-gray-800">Survei Kepuasan Konsumen PST Menjawab</h2>
    </div>

    <!-- Kotak Formulir -->
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <form action="/consultation/feedback/submit" method="post">
            <?php if (session()->getFlashdata('error')): ?> 
                <div class="mb-4 p-2 bg-red-100 text-red-700 rounded"> 
                    <?= session()->getFlashdata('error') ?> 
                </div> 
            <?php endif; ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Token -->
                <div>
                    <label for="token" class="block text-sm font-medium text-gray-700 mb-1">Token</label>
                    <input type="text" id="token" name="token" value="<?= esc($token) ?>" readonly class="block w-full p-2 border border-gray-300 rounded-md bg-gray-100">
                </div>

                <!-- Kendala -->
                <div class="md:col-span-2">
                    <label for="kendala" class="block text-sm font-medium text-gray-700 mb-1">Apakah Anda mengalami kendala saat memakai layanan kami? Jika ya, apa?</label>
                    <textarea id="kendala" name="kendala" class="block w-full p-2 border border-gray-300 rounded-md h-24"></textarea>
                </div>

                <!-- Konsultasi -->
                <div>
                    <label for="konsultasi" class="block text-sm font-medium text-gray-700 mb-1">Kemungkinan konsultasi lagi (1-10)?</label>
                    <input type="number" id="konsultasi" name="konsultasi" min="1" max="10" required class="block w-full p-2 border border-gray-300 rounded-md">
                </div>

                <!-- Kesulitan -->
                <div>
                    <label for="kesulitan" class="block text-sm font-medium text-gray-700 mb-1">Kesulitan penggunaan website (1-10)?</label>
                    <input type="number" id="kesulitan" name="kesulitan" min="1" max="10" required class="block w-full p-2 border border-gray-300 rounded-md">
                </div>

                <!-- Terjawab -->
                <div>
                    <label for="terjawab" class="block text-sm font-medium text-gray-700 mb-1">Apakah kebutuhan Anda terjawab?</label>
                    <select id="terjawab" name="terjawab" required class="block w-full p-2 border border-gray-300 rounded-md">
                        <option value="Ya">Ya</option>
                        <option value="Tidak">Tidak</option>
                    </select>
                </div>

                <!-- Kepuasan -->
                <div>
                    <label for="kepuasan" class="block text-sm font-medium text-gray-700 mb-1">Kepuasan terhadap layanan (1-10)?</label>
                    <input type="number" id="kepuasan" name="kepuasan" min="1" max="10" required class="block w-full p-2 border border-gray-300 rounded-md">
                </div>

                <!-- Kritik dan Saran -->
                <div class="md:col-span-2">
                    <label for="kritik_saran" class="block text-sm font-medium text-gray-700 mb-1">Kritik dan Saran</label>
                    <textarea id="kritik_saran" name="kritik_saran" class="block w-full p-2 border border-gray-300 rounded-md h-24"></textarea>
                </div>
            </div>

            <!-- Tombol Submit -->
            <div class="mt-6">
                <button type="submit" class="w-full bg-orange-500 text-white py-2 px-4 rounded-md hover:bg-orange-600">Kirim</button>
            </div>
        </form>
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

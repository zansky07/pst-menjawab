<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PST Menjawab | Status Reservasi</title>
		<link rel="icon" href="/assets/images/logo-pst.png">
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link href="<?= base_url('assets/css/form.css') ?>" rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
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
        <div class="max-w-lg mx-auto rounded-lg shadow-lg mt-20">
            <form action="/consultation/status" method="get">
                <div class="flex items-center mb-4">
                    <input 
                        type="text" 
                        id="token" 
                        name="token" 
                        class="bg-white flex-grow p-2 border border-gray-300 rounded-l-md" 
                        placeholder="Masukkan Token Anda" 
                        value="<?= old('token') ? esc(old('token')) : '' ?>" 
                        required>
                    <button type="submit" class="bg-orange-500 text-white py-2 px-4 rounded-r-md hover:bg-orange-600">Cari</button>
                </div>

            </form>
        </div>

        <div class="max-w-lg mx-auto rounded-lg shadow-lg mt-10">
                <?php if (session()->getFlashdata('error')): ?> 
                    <div class="mb-4 p-2 bg-red-100 text-red-700 rounded"> 
                        <?= session()->getFlashdata('error') ?> 
                    </div> 
                <?php endif; ?>
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

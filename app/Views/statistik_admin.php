<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistik Admin</title>
    `<script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">`
</head>
<body>
    <div class="flex overflow-hidden flex-col pt-8 bg-oranye-1">
        <div class="flex z-10 flex-col px-10 w-full max-md:px-5 max-md:max-w-full">
            <nav class="flex flex-wrap gap-5 justify-between py-2 pr-20 pl-9 max-w-full text-xl bg-white bg-opacity-80 rounded-[50px] w-[1358px] max-md:px-5 max-md:mr-0.5" role="navigation" aria-label="Main Navigation">
                <div class="flex gap-5 text-black">
                    <img src="/assets/logo-pst.png" class="object-contain shrink-0 aspect-[0.8] w-[43px]" alt="BPS Logo" />
                    <div class="flex-auto my-auto">PST Menjawab BPS Provinsi DKI Jakarta</div>
                </div>
                <div class="flex gap-10 my-auto whitespace-nowrap">
                    <a href="/admin/dashboard" class="text-black hover:text-red-400 focus:outline-none focus:ring-2 focus:ring-red-400 rounded-md" tabindex="0">Dashboard</a>
                    <a href="/admin/statistics" class="text-red-400 hover:text-red-500 focus:outline-none focus:ring-2 focus:ring-red-400 rounded-md" tabindex="0">Statistik</a>
                    <a href="/admin/settings" class="text-stone-900 hover:text-red-400 focus:outline-none focus:ring-2 focus:ring-red-400 rounded-md" tabindex="0">Pengaturan</a>
                </div>
            </nav>

            <button class="self-start px-6 py-2.5 mt-5 ml-14 text-base font-bold text-center text-white bg-oranye-3 rounded-3xl hover:bg-oranye-4 focus:outline-none focus:ring-2 focus:ring-orange-500 max-md:px-5 max-md:ml-2.5" aria-label="Filter">
                Filter
            </button>

            <div class="self-end mt-5 w-full max-w-[1315px] max-md:max-w-full">
                <div class="flex gap-5 max-md:flex-col">
                    <section class="flex flex-col w-6/12 max-md:ml-0 max-md:w-full" aria-labelledby="statistics-title">
                        <div class="flex flex-wrap grow gap-px px-7 py-1.5 w-full text-center text-black bg-white max-md:px-5 max-md:mt-7">
                            <div class="flex flex-col self-end mt-20 text-xl whitespace-nowrap max-md:hidden max-md:mt-10" aria-hidden="true">
                                <div>50</div>
                                <div class="mt-4">40</div>
                                <div class="mt-5">30</div>
                                <div class="mt-8">20</div>
                                <div class="flex flex-col px-0.5 mt-7">
                                    <div>10</div>
                                    <div class="self-start mt-6">0</div>
                                </div>
                            </div>
                            <div class="shrink-0 my-auto w-0.5 border border-black border-solid h-[282px]" role="presentation"></div>
                            <div class="flex flex-col max-md:max-w-full">
                                <h2 id="statistics-title" class="self-center text-xl">Statistik Jumlah Permintaan</h2>
                                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/7277c30e68c9fff3ab31bf51371958f87b034e71c5ee5d59377ac5ed0af70863?apiKey=e9ddb2361bfb44708a9699ec1fe1fd57&" class="object-contain mt-16 w-full rounded-none aspect-[2.35] max-md:mt-10 max-md:max-w-full" alt="Grafik statistik jumlah permintaan dari Januari 2024 hingga September 2024" />
                                <div class="flex flex-wrap gap-5 justify-between ml-3 text-xs max-md:mr-1.5 max-md:max-w-full">
                                    <div>Januari<br />2024</div>
                                    <div>September 2024</div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="flex flex-col ml-5 w-6/12 max-md:ml-0 max-md:w-full" aria-label="Statistik Summary">
                        <div class="flex flex-col w-full max-md:mt-7 max-md:max-w-full">
                            <div class="max-md:max-w-full">
                                <div class="flex gap-5 max-md:flex-col">
                                    <div class="flex flex-col w-6/12 max-md:ml-0 max-md:w-full">
                                        <div class="flex flex-col px-9 pt-6 pb-11 w-full font-bold text-center text-white bg-oranye-2 rounded-[40px] max-md:px-5 max-md:mt-3">
                                            <h3 class="text-2xl">Jumlah Pengunjung</h3>
                                            <div class="self-center mt-11 text-6xl max-md:mt-10 max-md:text-4xl" aria-label="120 pengunjung">120</div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col ml-5 w-6/12 max-md:ml-0 max-md:w-full">
                                        <div class="flex flex-col grow px-10 pt-6 pb-12 mt-1 w-full font-bold text-center text-white bg-oranye-2 rounded-[40px] max-md:px-5 max-md:mt-4">
                                            <h3 class="text-2xl">Jumlah Permintaan Konsultasi Online</h3>
                                            <div class="self-center mt-5 text-6xl max-md:text-4xl" aria-label="100 permintaan">100</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2 max-md:max-w-full">
                                <div class="flex gap-5 max-md:flex-col">
                                    <div class="flex flex-col w-6/12 max-md:ml-0 max-md:w-full">
                                        <div class="flex flex-col grow px-10 pt-6 pb-12 w-full font-bold text-center text-white bg-oranye-2 rounded-[40px] max-md:px-5 max-md:mt-3.5">
                                            <h3 class="text-2xl">Jumlah Permintaan yang disetujui</h3>
                                            <div class="self-center mt-2.5 text-6xl max-md:text-4xl" aria-label="55 permintaan disetujui">55</div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col ml-5 w-6/12 max-md:ml-0 max-md:w-full">
                                        <div class="flex flex-col grow px-12 pt-5 pb-14 w-full font-bold text-center text-white bg-oranye-2 rounded-[40px] max-md:px-5 max-md:mt-3.5">
                                            <h3 class="text-2xl">Jumlah Permintaan yang ditolak</h3>
                                            <div class="self-center mt-2.5 text-6xl max-md:text-4xl" aria-label="10 permintaan ditolak">10</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <button class="self-start px-5 py-2.5 mt-8 ml-11 text-base font-bold text-center text-white bg-green-500 rounded-2xl hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-700 max-md:ml-2.5" aria-label="Export data">
                Export
            </button>

            <div class="flex flex-col self-end mt-4 w-full text-sm leading-none rounded border-2 border-solid border-zinc-100 max-w-[1310px] min-h-[368px] text-zinc-900 max-md:mr-1.5 max-md:max-w-full" role="table" aria-label="Daftar Permintaan">
                <div class="flex flex-wrap justify-center w-full leading-6 text-center text-white whitespace-nowrap bg-oranye-2 rounded max-md:max-w-full" role="row">
                    <div class="flex-1 shrink p-4 h-full min-w-[240px]" role="columnheader">Token</div>
                    <div class="flex-1 shrink p-4 h-full min-w-[240px]" role="columnheader">Topik</div>
                    <div class="flex-1 shrink p-4 h-full min-w-[240px]" role="columnheader">Peminat</div>
                    <div class="flex-1 shrink p-4 h-full min-w-[240px]" role="columnheader">Tanggal</div>
                </div>
                <div class="overflow-x-auto max-w-full">
                    <div class="flex flex-col text-center gap-5 py-5 text-sm leading-6 max-md:mr-1.5" role="rowgroup">
                        <!-- Dynamic content rows -->
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</body>
</html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>

<body class="bg-oranye-1 flex flex-col items-center justify-center min-h-screen p-4">
    <div class="w-full max-w-4xl">
        <div class="flex justify-between mb-4">
            <button class="bg-white text-black py-2 px-4 rounded-full" onclick="window.location.href='/';">Kembali</button>
            <button class="bg-white text-black py-2 px-4 rounded-full" onclick="window.location.href='/chatbot';">Obrolan Baru</button>
        </div>
        <div class="bg-white flex-1 ml-4 p-6 rounded-lg h-12 flex items-center justify-center text-center mt-8 mb-8">Topik yang diajukan</div>

        <div class="space-y-4">
            <div class="flex items-start">
                <div class="bg-white w-12 h-12 rounded-full"></div>
                <div class="bg-white flex-1 ml-4 p-4 rounded-lg">Pesan dari pengguna pertama yang cukup panjang untuk menunjukkan bahwa bubble chat akan membesar sesuai dengan panjang teks.</div>
            </div>
            <div class="flex items-start justify-end">
                <div class="bg-white flex-1 mr-4 p-4 rounded-lg text-right">Balasan dari pengguna kedua yang juga cukup panjang untuk menunjukkan bahwa bubble chat akan membesar sesuai dengan panjang teks.</div>
                <div class="bg-white w-12 h-12 rounded-full"></div>
            </div>
            <div class="flex items-start">
                <div class="bg-white w-12 h-12 rounded-full"></div>
                <div class="bg-white flex-1 ml-4 p-4 rounded-lg">Pesan lain dari pengguna pertama.</div>
            </div>
            <div class="flex items-start justify-end">
                <div class="bg-white flex-1 mr-4 p-4 rounded-lg text-right">Balasan lain dari pengguna kedua.</div>
                <div class="bg-white w-12 h-12 rounded-full"></div>
            </div>
            <div class="flex items-start">
                <div class="bg-white w-12 h-12 rounded-full"></div>
                <div class="bg-white flex-1 ml-4 p-4 rounded-lg">Pesan terakhir dari pengguna pertama.</div>
            </div>
        </div>
        <div class="flex items-start mt-4">
            <div class="bg-white flex-1 ml-4 p-4 rounded-lg h-12 flex items-center"></div>
            <button class="bg-white text-black py-2 px-10 ml-4 rounded-lg h-12 " onclick="window.location.href=' ';">Kirim</button>
        </div>


    </div>
</body>

</html>
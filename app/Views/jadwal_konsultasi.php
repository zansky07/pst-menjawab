<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Konsultasi</title>
    <link rel="icon" href="/assets/images/logo-pst.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<style>
    /* Custom Flatpickr Theme */
    .flatpickr-day.selected,
    .flatpickr-day.startRange,
    .flatpickr-day.endRange,
    .flatpickr-day.selected.inRange,
    .flatpickr-day.startRange.inRange,
    .flatpickr-day.endRange.inRange,
    .flatpickr-day.selected:focus,
    .flatpickr-day.startRange:focus,
    .flatpickr-day.endRange:focus,
    .flatpickr-day.selected:hover,
    .flatpickr-day.startRange:hover,
    .flatpickr-day.endRange:hover,
    .flatpickr-day.selected.prevMonthDay,
    .flatpickr-day.startRange.prevMonthDay,
    .flatpickr-day.endRange.prevMonthDay,
    .flatpickr-day.selected.nextMonthDay,
    .flatpickr-day.startRange.nextMonthDay,
    .flatpickr-day.endRange.nextMonthDay {
        background: #E76F51;
        border-color: #E76F51;
        color: #fff;
    }

    .flatpickr-day.inRange,
    .flatpickr-day.prevMonthDay.inRange,
    .flatpickr-day.nextMonthDay.inRange,
    .flatpickr-day:hover,
    .flatpickr-day.prevMonthDay:hover,
    .flatpickr-day.nextMonthDay:hover,
    .flatpickr-day:focus,
    .flatpickr-day.prevMonthDay:focus,
    .flatpickr-day.nextMonthDay:focus {
        background: #fce8e4;
        border-color: #fce8e4;
        color: #E76F51;
    }

    .flatpickr-day.today {
        border-color: #E76F51;
    }

    .flatpickr-day.today:hover,
    .flatpickr-day.today:focus {
        border-color: #E76F51;
        background: #E76F51;
        color: #fff;
    }

    /* Custom styling untuk header calendar */
    .flatpickr-months .flatpickr-month {
        background: #E76F51;
    }

    .flatpickr-months .flatpickr-prev-month:hover svg,
    .flatpickr-months .flatpickr-next-month:hover svg {
        fill: #fce8e4;
    }

    .flatpickr-months .flatpickr-prev-month svg,
    .flatpickr-months .flatpickr-next-month svg {
        fill: #fff;
    }

    .flatpickr-month {
        color: #fff;
        /* Warna teks bulan menjadi putih */
    }

    .flatpickr-current-month {
        background: #E76F51 !important;
        color: white !important;
    }

    .flatpickr-current-month .flatpickr-monthDropdown-months {
        background: #E76F51 !important;
        color: white !important;
    }

    .flatpickr-current-month input.cur-year {
        background: #E76F51 !important;
        color: white !important;
    }

    .flatpickr-months .flatpickr-prev-month,
    .flatpickr-months .flatpickr-next-month {
        color: white !important;
    }

    .flatpickr-months .flatpickr-prev-month svg,
    .flatpickr-months .flatpickr-next-month svg {
        fill: white !important;
    }

    .flatpickr-current-month .flatpickr-monthDropdown-months:hover {
        background: #E76F51 !important;
    }

    .numInputWrapper span {
        border-color: white !important;
    }

    .numInputWrapper span:after {
        border-top-color: white !important;
    }

    .numInputWrapper span.arrowUp:after {
        border-bottom-color: white !important;
    }

    .numInputWrapper span.arrowDown:after {
        border-top-color: white !important;
    }

    /* Custom styling untuk time picker */
    .flatpickr-time input:hover,
    .flatpickr-time .flatpickr-am-pm:hover,
    .flatpickr-time input:focus,
    .flatpickr-time .flatpickr-am-pm:focus {
        background: #fce8e4;
    }

    .flatpickr-time .numInputWrapper span.arrowUp:after {
        border-bottom-color: #E76F51;
    }

    .flatpickr-time .numInputWrapper span.arrowDown:after {
        border-top-color: #E76F51;
    }

    .flatpickr-monthDropdown-months {
        background: #E76F51;
        /* Warna latar default dropdown */
        color: white;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Assuming the format of jadwal_konsultasi is 'YYYY-MM-DD HH:mm:ss'
        const jadwalKonsultasi = '<?= $konsultasi['jadwal_konsultasi'] ?>';
        if (jadwalKonsultasi) {
            const date = new Date(jadwalKonsultasi);

            // Extract date and time components
            const dateValue = date.toISOString().split('T')[0]; // Format: YYYY-MM-DD
            const timeValue = date.toTimeString().split(' ')[0].substring(0, 5); // Format: HH:mm

            // Set the date and time pickers with these values
            document.getElementById('datePicker').value = dateValue;
            document.getElementById('timePicker').value = timeValue;
        }
    });
</script>

<body class="mt-28 md:mt-16  bg-oranye-1">
    <div class="flex overflow-hidden flex-col pt-8">
        <div class="flex z-10 flex-col px-10 w-full max-md:px-5 max-md:max-w-full">
            <nav class="bg-white shadow shadow-gray-300 fixed top-0 left-0 w-full px-8 z-50">
                <div
                    class="md:h-16 h-28 mx-auto md:px-4 container flex items-center justify-between flex-wrap md:flex-nowrap">
                    <div class="flex items-center space-x-4">
                        <img src="/assets/images/logo-pst.png" alt="Logo" class="h-10 w-10">
                        <span class="text-gray-800 font-semibold text-sm md:text-base"> PST Menjawab BPS Provinsi DKI
                            Jakarta </span>
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
                                <button id="dropdownNavbarLink"
                                    class="text-hover:bg-oranye-4 md:hover:bg-transparent py-2 md:hover:text-oranye-2 flex items-center">
                                    Pengaturan <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                                <div id="dropdownNavbar"
                                    class="hidden absolute bg-white text-base z-10 list-none divide-y divide-gray-100 rounded shadow mt-2 w-44">
                                    <ul class="py-1">
                                        <li>
                                            <a href="admin/settings/admin"
                                                class="text-sm hover:bg-gray-100 text-gray-700 block px-4 py-2">Admin</a>
                                        </li>
                                        <li>
                                            <a href="admin/settings/consultant"
                                                class="text-sm hover:bg-gray-100 text-gray-700 block px-4 py-2">Konsultan</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="order-2 md:order-3">
                        <button
                            class="px-4 py-2 bg-oranye-3 hover:bg-oranye-4 text-white rounded-xl flex items-center gap-2">
                            <span>
                                <a href="/admin/logout">Keluar</a>
                            </span>
                        </button>
                    </div>
                </div>
            </nav>


            <!-- Main Content -->
            <main>
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="min-h-screen bg-oranye-1 mt-28 md:mt-16">
                        <div class="max-w-4xl mx-auto py-12 px-4">
                            <div class="bg-white rounded-lg shadow-lg p-6">
                                <h2 class="text-2xl font-bold text-center mb-8">Jadwalkan Konsultasi</h2>
                                <form action="/admin/consultation/schedule/store" method="post" class="space-y-6">
                                    <!-- Hidden input remains the same -->
                                    <input type="hidden" name="konsultasi_id" value="<?= $konsultasi['id'] ?>">

                                    <!-- Date and Time Picker -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Tanggal
                                                Konsultasi</label>
                                            <input type="text" id="datePicker" name="jadwal_konsultasi"
                                                class="mt-1 block w-full rounded-lg border border-gray-400 px-3 py-2 focus:outline-none focus:border-gray-500 bg-oranye-1"
                                                value="<?= isset($konsultasi['tanggal_konsultasi']) ? $konsultasi['tanggal_konsultasi'] : '' ?>"
                                                readonly>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Waktu
                                                Konsultasi</label>
                                            <div class="flex items-center">
                                                <input type="text" id="timePicker" name="waktu_konsultasi"
                                                    class="mt-1 block w-full rounded-lg border border-gray-400 px-3 py-2 focus:outline-none focus:border-gray-500 bg-oranye-1"
                                                    value="<?= isset($konsultasi['waktu_konsultasi']) ? $konsultasi['waktu_konsultasi'] : '' ?>"
                                                    readonly>
                                                <span class="ml-2 mt-1 text-sm font-medium text-gray-700">WIB</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Link Zoom -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Link Zoom</label>
                                        <input type="text" name="link_zoom"
                                            class="mt-1 block w-full rounded-lg border border-gray-400 px-3 py-2 focus:outline-none focus:border-gray-500 bg-oranye-1"
                                            value="<?= $konsultasi['link_zoom'] ?>"
                                            required>
                                    </div>

                                    <!-- Petugas Dropdown -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Petugas</label>
                                        <div class="relative">
                                            <select name="konsultan_id" class="mt-1 block w-full rounded-lg border border-gray-400 px-3 py-2 focus:outline-none focus:border-gray-500 appearance-none bg-oranye-1 pr-10 cursor-pointer" required>
                                                <?php foreach ($konsultan as $k): ?>
                                                    <option value="<?= $k['id'] ?>" <?= isset($konsultasi['konsultan_id']) && $konsultasi['konsultan_id'] == $k['id'] ? 'selected' : '' ?>>
                                                        <?= $k['nama'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="absolute inset-y-0 right-0 flex items-center px-2 mt-1 pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="flex justify-end space-x-1">
                                        <a href="<?= base_url('admin/consultation/detail/' . $konsultasi['id']) ?>"
                                            class="bg-gray-700 text-white px-6 py-3 rounded-md font-semibold hover:bg-gray-800 text-center">
                                            Kembali
                                        </a>
                                        <button type="submit" id="submitButton" class="bg-orange-500 text-white px-6 py-2 rounded-md font-semibold hover:bg-orange-600 transition-colors duration-200">
                                            Simpan
                                        </button>
                                        <script>
                                            document.getElementById('submitButton').addEventListener('click', function(event) {
                                                const confirmation = confirm('Apakah Anda yakin ingin menyimpan perubahan?');
                                                if (!confirmation) {
                                                    event.preventDefault(); // Prevent form submission if not confirmed
                                                }
                                            });
                                        </script>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <div>
                <br><br><br><br><br><br><br><br><br><br>
            </div>
            <footer class="relative w-full mt-20">
                <!-- Gambar footer2 di atas kontainer bg-oranye-2 -->
                <div class="absolute inset-x-0 top-1 -translate-y-full w-full z-20">
                    <img src="/assets/images/footer2.png" alt="footer" class="w-full object-cover">
                </div>
                <!-- Kontainer dengan latar belakang oranye -->
                <div class="relative bg-oranye-2 text-white overflow-hidden pt-20 z-10">
                    <!-- Footer Content -->
                    <div class="container mx-auto px-6 py-12 flex flex-col md:flex-row justify-between space-y-8 md:space-y-0">
                        <!-- Informasi Utama -->
                        <div class="md:w-1/3 flex flex-col space-y-4">
                            <div class="flex items-center space-x-4">
                                <div>
                                    <img src="/assets/images/logo-pst.png" alt="Logo" class="h-12 w-12">
                                </div>
                                <h3 class="text-lg md:text-xl font-semibold leading-tight"> Badan Pusat Statistik Provinsi DKI Jakarta </h3>
                            </div>
                            <p class="text-sm md:text-base leading-relaxed"> Jl. Salemba Tengah No. 36-38 Paseban Senen Jakarta Pusat <br>
                                <span>Phone: (021) 31928493</span>
                                <br>
                                <span>Fax: (021) 3152004</span>
                                <br>
                                <span>E-mail: bps3100@bps.go.id</span>
                            </p>
                        </div>
                        <!-- Website Lainnya -->
                        <div class="md:w-1/3">
                            <h4 class="text-lg md:text-xl font-semibold mb-4">Website Lainnya:</h4>
                            <ul class="space-y-2 text-sm md:text-base">
                                <li>
                                    <a href="https://www.bps.go.id" class="underline hover:text-gray-300">Website BPS Indonesia</a>
                                </li>
                                <li>
                                    <a href="https://jakarta.bps.go.id" class="underline hover:text-gray-300">Website BPS Provinsi DKI Jakarta</a>
                                </li>
                                <li>
                                    <a href="https://pst.bps.go.id" class="underline hover:text-gray-300">Website Pelayanan Statistik Terpadu</a>
                                </li>
                                <li>
                                    <a href="https://silastik.bps.go.id" class="underline hover:text-gray-300">Website SILASTIK</a>
                                </li>
                            </ul>
                        </div>
                        <!-- Sosial Media -->
                        <div class="md:w-1/3">
                            <h4 class="text-lg md:text-xl font-semibold mb-4">Sosial Media:</h4>
                            <ul class="space-y-2 text-sm md:text-base">
                                <li>
                                    <a href="https://www.facebook.com/bpsdkijakarta/" class="underline hover:text-gray-300">Facebook</a>
                                </li>
                                <li>
                                    <a href="https://x.com/bpsdkijakarta/" class="underline hover:text-gray-300">Twitter</a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/bpsdkijakarta/" class="underline hover:text-gray-300">Instagram</a>
                                </li>
                                <li>
                                    <a href="https://www.youtube.com/c/BPSDKI" class="underline hover:text-gray-300">YouTube</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Copyright -->
                    <div class="relative text-center text-xs md:text-sm mt-4 pb-4"> &copy; 2024 Badan Pusat Statistik Provinsi DKI Jakarta. All rights reserved. </div>
                </div>
            </footer>

            <!-- Scripts -->
            <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
            <script>
                // Date Picker
                flatpickr("#datePicker", {
                    dateFormat: "Y-m-d", // Format: Mon, Nov 29
                    defaultDate: "<?= isset($konsultasi['tanggal_konsultasi']) ? $konsultasi['tanggal_konsultasi'] : 'today' ?>",
                    minDate: "today",
                    disable: [
                        function(date) {
                            return (date.getDay() === 0 || date.getDay() === 6);
                        }
                    ],
                    onChange: function(selectedDates, dateStr) {
                        document.querySelector(".flatpickr-current-month").style.background = "#E76F51";
                    },
                    onReady: function() {
                        document.querySelector(".flatpickr-current-month").style.background = "#E76F51";
                    }
                });

                // Time Picker
                flatpickr("#timePicker", {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                    minTime: "07:00",
                    maxTime: "23:59",
                    minuteIncrement: 1,
                    time_24hr: true,
                    defaultDate: "<?= isset($konsultasi['waktu_konsultasi']) ? $konsultasi['waktu_konsultasi'] : '07:00' ?>",
                    onChange: function(selectedDates, dateStr) {
                        // Custom handling if needed
                    },
                    onOpen: function() {
                        document.querySelector("#timePicker").parentElement.classList.add("time-picker-custom");
                    },
                    onClose: function() {
                        document.querySelector("#timePicker").parentElement.classList.remove("time-picker-custom");
                    }
                });
            </script>

</body>

</html>
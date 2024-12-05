<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Konsultasi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
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



<body class="bg-pink-50">
    <!-- Header/Navbar -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <img src="/images/logo.png" alt="Logo" class="h-8 w-auto">
                    <span class="ml-2 text-gray-900 font-medium">PST Menjawab BPS Provinsi DKI Jakarta</span>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="/dashboard" class="text-gray-900">Dashboard</a>
                    <a href="/statistik" class="text-gray-900">Statistik</a>
                    <a href="/pengaturan" class="text-gray-900">Pengaturan</a>
                </div>
            </div>
        </div>
    </nav>


    <!-- Main Content -->
    <main class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-pink-50">
            <div class="min-h-screen bg-pink-50">
                <div class="max-w-4xl mx-auto py-12 px-4">
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <h2 class="text-2xl font-bold text-center mb-8">Jadwalkan Konsultasi</h2>
                        <form action="/admin/consultation/schedule/store" method="post" class="space-y-6">
                            <!-- Hidden input to pass the consultation ID -->
                            <input type="hidden" name="konsultasi_id" value="<?= $konsultasi['id'] ?>">

                            <!-- Date and Time Picker -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Tanggal Konsultasi</label>
                                    <input type="text" id="datePicker" name="jadwal_konsultasi"
                                        class="mt-1 block w-full rounded-lg border border-gray-400 px-3 py-2 focus:outline-none focus:border-gray-500 bg-pink-50"
                                        readonly>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Waktu Konsultasi</label>
                                    <input type="text" id="timePicker" name="waktu_konsultasi"
                                        class="mt-1 block w-full rounded-lg border border-gray-400 px-3 py-2 focus:outline-none focus:border-gray-500 bg-pink-50"
                                        readonly>
                                </div>
                            </div>

                            <!-- Link Zoom -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Link Zoom</label>
                                <input type="text" name="link_zoom"
                                    class="mt-1 block w-full rounded-lg border border-gray-400 px-3 py-2 focus:outline-none focus:border-gray-500 bg-pink-50"
                                    required>
                            </div>

                            <!-- Petugas Dropdown -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Petugas</label>
                                <select name="konsultan_id"
                                    class="mt-1 block w-full rounded-lg border border-gray-400 px-3 py-2 focus:outline-none focus:border-gray-500 appearance-none bg-pink-50">
                                    required>
                                    <option value="">Pilih Petugas</option>
                                    <?php foreach ($konsultan as $k): ?>
                                        <option value="<?= $k['id'] ?>"><?= $k['nama'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit"
                                    class="bg-orange-500 text-white px-6 py-2 rounded-md hover:bg-orange-600 transition-colors duration-200">
                                    Selanjutnya
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-pink-50">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 bg-pink-50">
            <p class="text-center text-gray-500 text-sm">
                © 2024 BPS Provinsi DKI Jakarta. All rights reserved.
            </p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        // Date Picker
        flatpickr("#datePicker", {
            dateFormat: "D, M d", // Format: Mon, Nov 29
            defaultDate: "today",
            minDate: "today",
            disable: [
                function (date) {
                    return (date.getDay() === 0 || date.getDay() === 6);
                }
            ],
            onChange: function (selectedDates, dateStr) {
                document.querySelector(".flatpickr-current-month").style.background = "#E76F51";
            },
            onReady: function () {
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
            defaultDate: "07:00",
            onChange: function (selectedDates, dateStr) {
                // Custom handling if needed
            },
            onOpen: function () {
                document.querySelector("#timePicker").parentElement.classList.add("time-picker-custom");
            },
            onClose: function () {
                document.querySelector("#timePicker").parentElement.classList.remove("time-picker-custom");
            }
        });
    </script>

</body>

</html>
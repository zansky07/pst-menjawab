<!-- Header -->
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
            <button class="px-4 py-2 bg-oranye-3 hover:bg-oranye-2 text-white rounded-xl flex items-center gap-2">
                <span>
                    <a href="/admin/logout">Keluar</a>
                </span>
            </button>
        </div>
    </div>
</nav>
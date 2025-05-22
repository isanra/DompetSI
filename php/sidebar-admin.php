<!-- Navbar -->
<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 rounded-b-4xl">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start rtl:justify-end">
        <button
          data-drawer-target="logo-sidebar"
          data-drawer-toggle="logo-sidebar"
          aria-controls="logo-sidebar"
          type="button"
          class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
        >
          <span class="sr-only">Open sidebar</span>
          <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
            <path
              clip-rule="evenodd"
              fill-rule="evenodd"
              d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"
            ></path>
          </svg>
        </button>
        <a href="" class="flex ms-2 md:me-24">
          <img src="/assets/img/logo.png" class="h-10 me-3" alt="Logo" />
          <span class="self-center text-2xl font-bold sm:text-3xl whitespace-nowrap">
            Dompet<span class="text-amber-600">SI</span>
          </span>
        </a>
      </div>
    </div>
  </div>
</nav>

<!-- Sidebar -->
<aside
  id="logo-sidebar"
  class="fixed top-0 left-0 z-40 w-64 md:mt-25 rounded-tr-5xl h-screen pt-20 md:pt-5 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 shadow-2xl"
  aria-label="Sidebar"
>
  <div class="h-full px-3 pb-4 overflow-y-auto">
    <ul class="space-y-2 font-semibold text-xl">
      <li>
        <a href="/dist/admin/QBS.php" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
          <i class="fa-solid fa-users"></i>
          <span class="ms-3">Santri QBS</span>
        </a>
      </li>
      <li>
        <a href="/dist/admin/FQ.php" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
          <i class="fa-solid fa-users"></i>
          <span class="ms-3">Santri FQ</span>
        </a>
      </li>
      <li>
        <a href="/dist/admin/Riwayat.php" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
          <i class="fa-solid fa-money-bill-transfer"></i>
          <span class="flex-1 ms-3 whitespace-nowrap">Riwayat Transaksi</span>
        </a>
      </li>
      <li>
        <a href="/index.php" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
          <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3" />
          </svg>
          <span class="flex-1 ms-3 whitespace-nowrap">Keluar</span>
        </a>
      </li>
    </ul>
  </div>
</aside>



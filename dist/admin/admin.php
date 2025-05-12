<?php
require_once '../../connection.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['kategori'] != 'admin') {
  // Jika pengguna tidak terautentikasi atau bukan admin, arahkan ke halaman login
  header("Location: /index.php");
  exit();
}

$keyword = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM santri";
if (!empty($keyword)) {
    $sql .= " WHERE nama LIKE '%" . $conn->real_escape_string($keyword) . "%'";
}
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="/src/output.css" rel="stylesheet" />
  </head>

  <body class="bg-gray-100 md:overflow-hidden">
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 rounded-b-4xl">
      <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
          <div class="flex items-center justify-start rtl:justify-end">
            <button
              data-drawer-target="logo-sidebar"
              data-drawer-toggle="logo-sidebar"
              aria-controls="logo-sidebar"
              type="button"
              class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
            >
              <span class="sr-only">Open sidebar</span>
              <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path
                  clip-rule="evenodd"
                  fill-rule="evenodd"
                  d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"
                ></path>
              </svg>
            </button>
            <a href="" class="flex ms-2 md:me-24">
              <img src="/assets/img/logo.png" class="h-10 me-3" alt="FlowBite Logo" />
              <span class="self-center text-2xl font-bold sm:text-3xl whitespace-nowrap dark:text-white">Dompet<span class="text-emerald-600">SI</span> </span>
            </a>
          </div>
        </div>
      </div>
    </nav>

    <aside
      id="logo-sidebar"
      class="fixed top-0 left-0 z-40 w-64 md:mt-25 rounded-tr-5xl h-screen pt-20 md:pt-5 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700 shadow-2xl"
      aria-label="Sidebar"
    >
      <div class="h-full px-3 pb-4 overflow-y-auto">
        <ul class="space-y-2 font-semibold text-xl">
          <li>
            <a href="/dist/admin/QBS.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
              <span><i class="fa-solid fa-users"></i></span>
              <span class="ms-3">santri QBS</span>
            </a>
          </li>
          <li>
            <a href="/dist/admin/FQ.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
              <span><i class="fa-solid fa-users"></i></span>
              <span class="ms-3">santri FQ</span>
            </a>
          </li>
          <li class="">
            <a href="/dist/admin/Riwayat.html" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
              <span><i class="fa-solid fa-money-bill-transfer"></i></span>
              <span class="flex-1 ms-3 whitespace-nowrap">Riwayat transaksi</span>
            </a>
          </li>

          <li>
            <a href="../logout.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
              <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3" />
              </svg>
              <span class="flex-1 ms-3 whitespace-nowrap">Keluar</span>
            </a>
          </li>
        </ul>
      </div>
    </aside>
    <div class="flex-1 md:p-6 sm:ml-64 mt-10">
      <div class="container hero-admin mx-auto mt-10 max-w-3xl p-4 sm:p-2">
        <div class="relative w-full">
          <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-500"></i>
          </div>
      </div>

  <h1 class="text-3xl font-bold mb-6">Data Santri</h1>

  <form method="GET" class="mb-2 flex items-center">

  <input type="text" name="search" placeholder="Cari nama santri..." value="<?= htmlspecialchars($keyword); ?>" class="search-hero w-full p-3 pl-10 rounded-3xl border border-gray-400 shadow-md shadow-gray-600 mb-2" />
  </form>

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
    <?php if ($result && $result->num_rows > 0): ?>
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="bg-white p-4 rounded-xl shadow-md flex items-center space-x-4">
          <img src="<?= htmlspecialchars($row['foto']) ?>" alt="Foto <?= htmlspecialchars($row['nama']) ?>"
            class="w-16 h-16 rounded-full object-cover" />
          <div>
            <div class="text-xl font-semibold"><?= htmlspecialchars($row['nama']) ?></div>
            <div class="text-gray-600"><?= htmlspecialchars($row['kelas']) ?></div>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p class="text-gray-700">Data santri tidak ditemukan.</p>
    <?php endif; ?>
  </div>

</body>
</html>
<?php $conn->close(); ?>

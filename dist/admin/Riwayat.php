<?php
session_start();

// Pastikan santri_id sudah diset di session saat login
if (!isset($_SESSION['santri_id'])) {
    header('Location: ../../php/login.php');
    exit;
}
$santri_id = (int) $_SESSION['santri_id'];

require_once __DIR__ . '/../../php/conn.php';

// Ambil riwayat transaksi sekaligus nama & kelas santri
$sql = "
    SELECT 
      r.jumlah,
      r.tipe,
      r.keterangan,
      r.tanggal,
      s.nama,
      s.kelas
    FROM riwayat AS r
    JOIN santri  AS s ON r.santri_id = s.id
    WHERE r.santri_id = ?
    ORDER BY r.tanggal DESC
";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die('Prepare gagal: ' . $conn->error);
}
$stmt->bind_param('i', $santri_id);
$stmt->execute();
$result = $stmt->get_result();

$riwayat = [];
while ($row = $result->fetch_assoc()) {
    $riwayat[] = $row;
}

$stmt->close();
$conn->close();
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
              <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                <path clip-rule="evenodd" fill-rule="evenodd"
                  d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"
                ></path>
              </svg>
            </button>
            <a href="" class="flex ms-2 md:me-24">
              <img src="/assets/img/logo.png" class="h-10 me-3" alt="FlowBite Logo" />
              <span class="self-center text-2xl font-bold sm:text-3xl whitespace-nowrap dark:text-white">
                Dompet<span class="text-emerald-600">SI</span>
              </span>
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
          <li>
            <a href="/dist/admin/Riwayat.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
              <span><i class="fa-solid fa-money-bill-transfer"></i></span>
              <span class="flex-1 ms-3 whitespace-nowrap">Riwayat transaksi</span>
            </a>
          </li>
          <li>
            <a href="/dist/Masuk.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
              <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3"
                />
              </svg>
              <span class="flex-1 ms-3 whitespace-nowrap">Keluar</span>
            </a>
          </li>
        </ul>
      </div>
    </aside>

    <div class="flex-1 p-6 sm:ml-64 mt-20">
      <div class="md:bg-white md:p-6 md:shadow-md shadow-gray-300 rounded-tl-5xl rounded-lg">
        <div class="grid grid-cols-1 gap-2">
          <h4 class="text-3xl pt-5 text-gray-600 md:ps-4 font-bold mb-10">Riwayat Transaksi</h4>
          <div class="flex flex-col h-screen md:p-4">

            <!-- Header Pilihan Tanggal -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center bg-gray-100 md:py-3 md:px-6 p-3 text-gray-700 font-bold text-lg rounded-lg shadow-md mb-10">
              <span>Riwayat Transaksi </span>
              <input type="date" id="dateInput" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 mt-2 md:mt-0 w-full md:w-auto" />
            </div>

            <?php if (empty($riwayat)): ?>
              <p class="text-center text-gray-500 mt-10">Belum ada riwayat transaksi.</p>
            <?php else: ?>
              <?php foreach ($riwayat as $trx): 
                $isIn   = strtolower($trx['tipe']) === 'masuk';
                $iconBg = $isIn ? 'bg-emerald-100 lg:bg-emerald-600' : 'bg-amber-100 lg:bg-amber-600';
                $iconCl = $isIn ? 'fa-download text-emerald-600 lg:text-white' : 'fa-upload text-amber-600 lg:text-white';
                $txtCl  = $isIn ? 'text-emerald-600' : 'text-amber-600';
                $waktu  = date('d/m/Y • H:i', strtotime($trx['tanggal']));
              ?>
                <!-- Container Riwayat -->
                <div class="relative flex md:flex-row flex-col items-start md:items-center justify-between bg-white shadow-md md:p-4 p-3 rounded-lg mb-5">
                  
                  <div class="flex items-center w-full md:w-auto">
                    <div class="md:w-12 w-15 h-15 md:h-12 flex items-center justify-center rounded-full <?= $iconBg ?>">
                      <i class="fa-solid <?= $iconCl ?> text-2xl"></i>
                    </div>
                    <div class="ml-3">
                      <h3 class="text-lg md:text-xl font-bold text-gray-800"><?= htmlspecialchars($trx['nama'], ENT_QUOTES) ?></h3>
                      <p class="text-sm text-gray-500">Kelas: <?= htmlspecialchars($trx['kelas'], ENT_QUOTES) ?></p>
                      <p class="text-xs text-gray-400"><?= $waktu ?></p>
                    </div>
                  </div>

                  <div class="hidden md:flex absolute left-1/2 transform -translate-x-1/2 text-gray-600 font-semibold text-xl">
                    <?= htmlspecialchars($trx['tipe'], ENT_QUOTES) ?> Saldo
                  </div>

                  <div class="flex w-full md:w-auto justify-between md:justify-end mt-3 md:mt-0">
                    <div class="text-gray-600 font-semibold text-lg md:hidden">
                      <?= htmlspecialchars($trx['tipe'] . ' Saldo', ENT_QUOTES) ?>
                    </div>
                    <div class="<?= $txtCl ?> font-bold text-lg md:text-2xl">
                      <?= ($isIn ? '+' : '-') ?>Rp <?= number_format($trx['jumlah'], 0, ',', '.') ?>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>

          </div>
        </div>
      </div>
    </div>
  </body>
  <script src="/assets/js/parent.js"></script>
</html>
                
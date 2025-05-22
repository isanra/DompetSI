<?php
session_start();

// Pastikan santri_id sudah diset di session saat login
if (!isset($_SESSION['santri_id'])) {
    header('Location: ../../php/login.php');
    exit;
}
$santri_id = $_SESSION['santri_id'];

require_once __DIR__ . '/../../php/conn.php'; 

// Siapkan dan jalankan query
$sql  = "SELECT jumlah, tipe, keterangan, tanggal
         FROM riwayat
         WHERE santri_id = ?
         ORDER BY tanggal DESC";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die('Prepare failed: ' . $conn->error);
}
$stmt->bind_param('i', $santri_id);
$stmt->execute();
$result = $stmt->get_result();

// Ambil semua data ke array
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

  <body class="bg-gray-100 lg:overflow-hidden">
    <?php require_once('../../php/sidebar-parent.php'); ?>
    <nav>
      <!-- Mobile Navbar: hanya tampil di HP -->
      <div class="pt-4 ps-4">
        <div class="flex items-center gap-3">
          <!-- Tombol Keluar -->
          <a href="/dist/parent/profil.php">
            <button class="text-2xl font-bold text-gray-500">
              <i class="fa-solid fa-arrow-left"></i>
            </button>
          </a>
          <!-- Judul Riwayat -->
          <h4 class="text-lg lg:text-3xl ps-3 lg:hidden text-gray-600 font-bold">Riwayat Transaksi</h4>
        </div>
      </div>
    </nav>

    

    <div class="flex-1 px-6 py-0 lg:p-6 sm:ml-64 mt-8">
      <div>
        <div class="lg:bg-white lg:p-6 lg:shadow-lg lg:shadow-gray-300 rounded-tl-5xl rounded-lg">
          <div class="grid grid-cols-1 gap-2">
            <h4 class="text-lg lg:text-3xl lg:pt-5 pt-0 text-gray-600 ps-4 font-bold mb-5 lg:mb-10 hidden lg:inline-block">Riwayat Transaksi</h4>
            <div class="flex flex-col h-screen">
              <div class="container-riwayat flex-grow overflow-auto scrollbar-hide">
  <?php if (empty($riwayat)): ?>
    <p class="text-center text-gray-500 mt-10">Belum ada riwayat transaksi.</p>
  <?php else: ?>
    <?php
      // DEBUG: comment out setelah tahu value-nya
      // echo '<pre>'; print_r(array_unique(array_column($riwayat, 'tipe'))); echo '</pre>';
    ?>
    <?php foreach ($riwayat as $trx): ?>
      <?php
        // Kalau bukan persis "Pemasukan", anggap keluaran
        $isIn   = ($trx['tipe'] === 'masuk');
        $iconBg = $isIn
                 ? 'bg-emerald-100 lg:bg-emerald-600'
                 : 'bg-amber-100 lg:bg-amber-600';
        $iconCl = $isIn
                 ? 'fa-download text-emerald-600 lg:text-white'
                 : 'fa-upload text-amber-600 lg:text-white';
        $txtCl  = $isIn
                 ? 'text-emerald-600'
                 : 'text-amber-600';
      ?>
      <div class="flex items-center bg-white shadow-lg lg:shadow-lg rounded-lg px-4 pb-2 lg:p-4 mb-3">
        <div class="lg:w-12 w-15 h-15 lg:h-12 flex items-center justify-center rounded-full <?= $iconBg ?>">
          <i class="fa-solid <?= $iconCl ?> text-2xl"></i>
        </div>
        <div class="flex-1 ml-3 mt-5 lg:mt-0">
          <h3 class="text-lg lg:text-2xl font-bold text-gray-800">
            <?= htmlspecialchars($trx['tipe'], ENT_QUOTES) ?>
          </h3>
          <h3 class="text-md font-semibold <?= $txtCl ?> mb-2 lg:hidden">
            <?= ($isIn ? '+' : '-') ?>Rp <?= number_format($trx['jumlah'],0,',','.') ?>
          </h3>
          <p class="text-sm text-gray-500">
            <?= date('d/m/Y • H:i', strtotime($trx['tanggal'])) ?>
          </p>
        </div>
        <h3 class="hidden lg:block text-lg lg:text-2xl font-semibold <?= $txtCl ?>">
          <?= ($isIn ? '+' : '-') ?>Rp <?= number_format($trx['jumlah'],0,',','.') ?>
        </h3>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>


            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="/assets/js/parent.js"></script>
  </body>
</html>

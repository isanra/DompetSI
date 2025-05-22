<?php
session_start();
if (!isset($_SESSION['santri_id'])) {
    header('Location: ../masuk/index.php');
    exit;
}
include '../../php/conn.php';

$santri_id = (int) $_SESSION['santri_id'];

// Ambil data profil dan saldo
$stmt = $conn->prepare("
    SELECT 
      s.nis,
      s.nama,
      s.kelas,
      s.tgl_lahir,
      s.kampus,
      s.foto,
      COALESCE(sd.total_saldo, 0) AS total_saldo
    FROM santri AS s
    LEFT JOIN saldo AS sd
      ON sd.santri_id = s.id
    WHERE s.id = ?
    LIMIT 1
");
$stmt->bind_param('i', $santri_id);
$stmt->execute();
$profil = $stmt->get_result()->fetch_assoc();
if (!$profil) {
    die('Data santri tidak ditemukan.');
}

// Ambil riwayat transaksi
$stmt2 = $conn->prepare("
    SELECT id, jumlah, tipe, keterangan, tanggal
    FROM riwayat
    WHERE santri_id = ?
    ORDER BY tanggal DESC
    LIMIT 2
");
$stmt2->bind_param('i', $santri_id);
$stmt2->execute();
$riwayat = $stmt2->get_result();
// Ubah menjadi array agar mudah di‐loop
$riwayatList = [];
while ($row = $riwayat->fetch_assoc()) {
    $riwayatList[] = $row;
}

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
      <div class="flex items-center justify-between p-4 px-2 lg:hidden">
        <!-- Kiri: Foto + Info -->
        <div class="flex items-center">
          <img
            src="../../php/foto/<?= htmlspecialchars($profil['foto'] ?: 'default.jpg', ENT_QUOTES, 'UTF-8') ?>"
            alt="Foto Orang"
            class="w-18 h-18 rounded-full mr-4 shadow-sm "
          />
          <div>
           
            <h3 class="text-xl font-bold"><?= htmlspecialchars($profil['nama'])?></h3>
            <p class="text-sm text-white bg-amber-600 rounded-2xl p-1 px-3 inline">Kelas <?= htmlspecialchars($profil['kelas'])?> Pondok</p>
          </div>
        </div>

        <!-- Kanan: Tombol setting dengan Background Bullet -->
        <!-- Tombol Logout -->
        <button onclick="toggleModal(true)"
          class="flex items-center justify-center text-xl font-bold text-amber-600 hover:text-amber-500 relative rounded-full w-10 h-10 border border-gray-300">
          <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3" />
          </svg>
        </button>


        <!-- Modal Konfirmasi Logout -->
        
        <div id="logoutModal"
            class="fixed inset-0 z-50 bg-black bg-opacity-50 items-center justify-center hidden">
          <div class="bg-white p-6 rounded-2xl shadow-xl text-center w-[90%] max-w-md mx-auto">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Yakin ingin keluar?</h2>
            <p class="text-gray-600 mb-6">Kamu akan keluar dari akun ini dan kembali ke halaman login.</p>
            <div class="flex justify-center gap-4">
              <button onclick="logout()" class="bg-amber-600 hover:bg-amber-500 text-white px-4 py-2 rounded-full font-medium">Keluar</button>
              <button onclick="toggleModal(false)" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-full font-medium">Batal</button>
            </div>
          </div>
        </div>


        <script>
          function toggleModal(show) {
            const modal = document.getElementById('logoutModal');
            if (show) {
              modal.classList.remove('hidden');
              modal.classList.add('flex');
            } else {
              modal.classList.remove('flex');
              modal.classList.add('hidden');
            }
          }

          function logout() {
            window.location.href = "../../php/logout.php";
          }
        </script>





      </div>
    </nav>
    

    

    <div class="flex-1 p-6 lg:ml-64">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:mt-20">
        <!-- Div Profil + Saldo -->
        <div class="lg:col-span-2 flex flex-col gap-6">
          <div class="relative lg:bg-white p-6 lg:shadow-lg rounded-lg rounded-tl-5xl items-center h-30 lg:h-auto hidden lg:flex">
            

            <!-- Konten utama -->
            <img
              src="../../php/foto/<?= htmlspecialchars($profil['foto'])?>"
              alt="Foto Orang"
              class="w-25 h-auto rounded-full mr-4 shadow-lg border"
            />
            <div>
              <h3 class="text-2xl lg:text-5xl font-bold"><?= htmlspecialchars($profil['nama'])?></h3>
              <p class="text-lg lg:text-xl text-gray-600">Kelas <?= htmlspecialchars($profil['kelas'])?> Pondok</p>
            </div>
          </div>

          <div class="p-6 shadow-lg lg:shadow-md shadow-amber-700 rounded-3xl lg:rounded-xl flex flex-col justify-center relative overflow-hidden bg-gradient-to-r from-amber-700 via-amber-600 to-amber-500">
            <!-- Lingkaran 1 -->
            <div class="absolute -bottom-12 lg:-bottom-64 -right-8 lg:-right-32 w-32 lg:w-96 h-32 lg:h-96 border-8 border-white rounded-full opacity-30"></div>

            <!-- Lingkaran 2 -->
            <div class="absolute -bottom-20 lg:-bottom-40 -right-16 lg:-right-12 w-48 lg:w-60 h-48 lg:h-60 border-8 border-white rounded-full opacity-20"></div>

            <!-- Konten utama -->
            <p class="text-xl text-gray-100 p-0">Saldo</p>
            <h3 class="text-3xl lg:text-5xl font-bold flex items-center text-white">
              Rp <?= htmlspecialchars(number_format($profil['total_saldo'], 0, ',', '.')) ?>

              <a href="/dist/Parent/transaksi.php" class="ms-3">
                <i class="fa-solid fa-plus bg-white text-lg lg:text-xl p-2 mb-2 lg:mb-3 rounded-full text-amber-600 shadow-sm shadow-white"></i>
              </a>
            </h3>
          </div>
        </div>
        <!-- Div Riwayat -->
        <div class="lg:bg-white lg:p-6 lg:shadow-lg rounded-lg lg:col-span-1 mt-8 lg:mt-0">
          <!-- Header + Tombol Selengkapnya (hanya untuk mobile) -->
          <div class="flex items-center justify-between mb-2 lg:mb-5 lg:block">
            <h4 class="text-lg font-bold lg:font-bold lg:p-4 lg:bg-amber-600 text-black lg:text-white py-1 rounded-lg lg:shadow-sm lg:shadow-amber-600">Riwayat Transaksi</h4>
            <!-- Tombol Selengkapnya (mobile only) -->
            <a href="/dist/Parent/Riwayat.php" class="text-amber-600 hover:underline font-semibold text-md md:block lg:hidden">Lihat Semua </a>
          </div>

          <!-- Card 1 -->
          <?php if (empty($riwayatList)): ?>
  <p class="text-center text-gray-500 mt-6">Belum ada riwayat transaksi.</p>
<?php else: ?>
  <?php foreach ($riwayatList as $trx): ?>
    <?php
      // Tentukan styling berdasarkan tipe
      $isIn   = strtolower($trx['tipe']) === 'masuk' || strtolower($trx['tipe']) === 'pemasukan';
      $iconBg = $isIn ? 'bg-emerald-100' : 'bg-amber-100';
      $iconCl = $isIn ? 'fa-download text-emerald-600' : 'fa-upload text-amber-600';
      $txtCl  = $isIn ? 'text-emerald-600' : 'text-amber-600';

      // Format tanda dan angka
      $sign   = $isIn ? '+' : '-';
      $jumlah = 'Rp ' . number_format($trx['jumlah'], 0, ',', '.');
      $waktu  = date('d/m/Y • H:i', strtotime($trx['tanggal']));
    ?>
    <div class="flex items-center mb-3">
      <div class="w-15 h-15 flex items-center justify-center rounded-full <?= $iconBg ?>">
        <i class="fa-solid <?= $iconCl ?> text-2xl"></i>
      </div>
      <div class="flex-1 ml-3 mt-5 lg:mt-0">
        <h3 class="text-lg lg:text-xl font-bold text-gray-800">
          <?= htmlspecialchars($trx['tipe'], ENT_QUOTES) ?>
        </h3>
        <h3 class="text-lg font-semibold <?= $txtCl ?> mb-2">
          <?= $sign . $jumlah ?>
        </h3>
        <p class="text-lg text-gray-500"><?= $waktu ?></p>
      </div>
    </div>
  <?php endforeach; ?>
<?php endif; ?>


         
        </div>
      </div>
    </div>
  </body>
  <script src="/assets/js/parent.js"></script>
</html>

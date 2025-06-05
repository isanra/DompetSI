<?php
session_start();
include_once '../../php/conn.php';

$pesan = "";
$saldo = 0;

// Ambil NIS dari URL
if (!isset($_GET['nis'])) {
  echo "❌ NIS tidak ditemukan.";
  exit;
}
$nis = $_GET['nis'];

// Ambil data santri berdasarkan NIS
$stmt = $conn->prepare("SELECT id, nama, kelas, foto FROM santri WHERE nis = ?");
$stmt->bind_param("s", $nis);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
  echo "❌ Data santri dengan NIS tersebut tidak ditemukan.";
  exit;
}
$row = $result->fetch_assoc();
$santri_id = $row['id'];

// Ambil saldo berdasarkan ID santri
$stmtSaldo = $conn->prepare("SELECT total_saldo FROM saldo WHERE santri_id = ?");
$stmtSaldo->bind_param("i", $santri_id);
$stmtSaldo->execute();
$resultSaldo = $stmtSaldo->get_result();
if ($saldoRow = $resultSaldo->fetch_assoc()) {
  $saldo = $saldoRow['total_saldo'];
}
$stmtSaldo->close();

// Proses pengajuan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $jumlah = isset($_POST['jumlah']) ? intval(preg_replace("/[^0-9]/", "", $_POST['jumlah'])) : 0;
  $keterangan = isset($_POST['keterangan']) ? trim($_POST['keterangan']) : '';

  if ($jumlah <= 0) {
    $pesan = "❌ Jumlah tidak boleh kosong atau nol.";
  } elseif ($jumlah > $saldo) {
    $pesan = "❌ Jumlah pengajuan melebihi saldo tersedia.";
  } else {
    $tipe = 'keluar';
    if ($keterangan === '') {
      $keterangan = 'Pengajuan pengurangan saldo oleh santri';
    }

    $insert = $conn->prepare("INSERT INTO riwayat (santri_id, jumlah, tipe, keterangan, tanggal) VALUES (?, ?, ?, ?, NOW())");
    $insert->bind_param("iiss", $santri_id, $jumlah, $tipe, $keterangan);
    if ($insert->execute()) {
      // Update saldo
      $newSaldo = $saldo - $jumlah;
      $updateSaldo = $conn->prepare("UPDATE saldo SET total_saldo = ? WHERE santri_id = ?");
      $updateSaldo->bind_param("ii", $newSaldo, $santri_id);
      if ($updateSaldo->execute()) {
        // Setelah berhasil insert dan update saldo, redirect ke halaman yang sama untuk reload
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit;
      } else {
        $pesan = "❌ Pengajuan berhasil tapi gagal update saldo.";
      }
      $updateSaldo->close();
    } else {
      $pesan = "❌ Gagal mengajukan, silakan coba lagi.";
    }
    $insert->close();
  }
}

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
    <?php require_once('../../php/sidebar-admin.php'); ?>

    <div class="flex-1 p-6 sm:ml-64">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-20">
        <!-- Div Profil + Saldo -->
        <div class="lg:col-span-2 flex flex-col gap-6">
          <div class="lg:bg-white p-6 lg:shadow-md rounded-lg rounded-tl-5xl flex items-center h-30 lg:h-auto">
            <img
              src="../../php/foto/<?= htmlspecialchars($row['foto']) ?>"
              alt="Foto <?= htmlspecialchars($row['nama']) ?>"
              class="w-25 sm:w-30 h-auto rounded-full mr-4 shadow-md border"
            />
            <div>
              <h3 class="text-2xl lg:text-5xl font-bold">
                <?= htmlspecialchars($row['nama']) ?>
              </h3>
              <p class="text-sm lg:text-xl text-gray-600">
                Kelas <?= htmlspecialchars($row['kelas']) ?> Pondok
              </p>
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
              Rp <?= htmlspecialchars(number_format($saldo, 0, ',', '.')) ?>
            </h3>
          </div>
        </div>

        <!-- Form Pengajuan -->
        <div class="lg:bg-white lg:p-6 lg:shadow-md rounded-lg lg:col-span-1 lg:mt-0 mt-10">
            <h4 class="text-lg font-bold text-black mb-4">Pengajuan Pengambilan Duit</h4>

            <?php if ($pesan): ?>
              <div class="bg-<?php echo strpos($pesan, '❌') === 0 ? 'red' : 'green'; ?>-100 border border-<?php echo strpos($pesan, '❌') === 0 ? 'red' : 'green'; ?>-400 text-<?php echo strpos($pesan, '❌') === 0 ? 'red' : 'green'; ?>-700 px-4 py-3 rounded relative mb-4">
                <?= $pesan ?>
              </div>
            <?php endif; ?>

            <form method="post" class="bg-white  p-4 shadow-sm space-y-4">
              <!-- Jumlah -->
              <div>
                <label class="block text-gray-700 font-medium">Jumlah Uang</label>
                <div class="mt-2 flex flex-wrap gap-2">
                  <!-- Tombol preset nominal (optional) -->
                </div>

                <input 
                  type="number" 
                  id="jumlahLainnya" 
                  name="jumlahLainnya" 
                  class="mt-2 w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-amber-500 transition" 
                  placeholder="Lainnya..." 
                  oninput="document.getElementById('jumlah').value = this.value" 
                />
                <input type="hidden" id="jumlah" name="jumlah" required />
              </div>

              <!-- Keterangan -->
              <div>
                <label for="Keterangan" class="block text-gray-700 font-medium">Keterangan Pengajuan</label>
                <textarea 
                  name="keterangan" 
                  id="Keterangan" 
                  class="mt-2 w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-amber-500 transition" 
                  rows="3" 
                  placeholder="Masukkan keterangan pengajuan..."
                ></textarea>
              </div>

              <!-- Tombol Submit -->
              <button 
                type="submit" 
                class="bg-amber-600 hover:bg-amber-700 text-white font-semibold py-2 rounded-lg w-full transition duration-200"
              >
                Ajukan
              </button>
            </form>
          </div>

      </div>
    </div>

    <script src="/assets/js/parent.js"></script>
    <script src="/assets/js/admin.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const sidebar = document.getElementById("logo-sidebar");
        const toggleBtn = document.querySelector("[data-drawer-toggle='logo-sidebar']");

        toggleBtn?.addEventListener("click", function () {
          sidebar.classList.toggle("-translate-x-full");
          sidebar.classList.toggle("translate-x-0");
        });
      });

      function selectAmount(amount, btn) {
        document.getElementById('jumlah').value = amount;
        document.getElementById('jumlahLainnya').value = "";
      }
    </script>
  </body>
</html>
